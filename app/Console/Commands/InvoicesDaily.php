<?php

namespace App\Console\Commands;

use App\Http\Controllers\SoapFELController;
use App\Models\FelInvoices;
use App\Models\ItemsInvoiceDay;
use App\Models\Stores;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Facturacion automatica de "Clientes Varios" (FEL).
 *
 * Extrae las ventas del dia del sistema origen (conexion `pharmaWeb`), las carga
 * en items_invoice_days (TRUNCATE + INSERT) y emite un DTE por tienda ante la SAT
 * reutilizando SoapFELController (la MISMA logica del boton manual), inyectando la
 * fecha de emision para no depender de Auth ni de la variable FEL_DATE de Heroku.
 *
 * Seguridad:
 *  - `--dry-run` arma el XML del DTE pero NO emite ante la SAT (para validar).
 *  - Idempotencia: no re-emite si ya existe un DTE para esa tienda+fecha (tabla fel_invoices),
 *    y limpia items_invoice_days por tienda tras emitir con exito.
 *  - Lock para evitar corridas simultaneas/dobles de la misma fecha.
 */
class InvoicesDaily extends Command
{
    protected $signature = 'invoices:daily
        {date? : Fecha a facturar (Y-m-d). Por defecto: hoy en America/Guatemala}
        {--dry-run : Extrae, carga y arma el XML del DTE, pero NO emite ante la SAT}
        {--time= : Hora de emision HH:MM:SS (por defecto, la hora actual)}
        {--no-reload : No re-extrae del origen; factura lo que ya esta en items_invoice_days}
        {--cf-limit=2499 : Limite (exclusivo) en GTQ por factura CF/Clientes Varios; se divide en varias facturas para no alcanzar Q2,500 (la SAT rechaza desde ese monto)}';

    protected $description = 'Extrae las ventas del dia del origen, las carga en items_invoice_days y emite los DTE de Clientes Varios ante la SAT (FEL).';

    public function handle(): int
    {
        $tz = config('app.timezone');
        $date = $this->argument('date')
            ? Carbon::createFromFormat('Y-m-d', $this->argument('date'), $tz)->startOfDay()
            : Carbon::now($tz)->startOfDay();
        $dry = (bool) $this->option('dry-run');
        $time = $this->option('time') ?: Carbon::now($tz)->format('H:i:s');
        $emissionDateTime = $date->format('Y-m-d') . 'T' . $time; // Y-m-d\TH:i:s para FechaHoraEmision
        $cfLimit = (float) $this->option('cf-limit'); // limite CF: cada factura debe quedar < este monto

        $this->info(sprintf('[invoices:daily] fecha=%s emision=%s %s', $date->toDateString(), $emissionDateTime, $dry ? '(DRY-RUN)' : ''));

        // Evita corridas simultaneas/dobles para la misma fecha.
        $lock = Cache::lock('invoices-daily:' . $date->toDateString(), 900);
        if (! $lock->get()) {
            $this->error('Ya hay una corrida en progreso para esta fecha. Aborto.');
            return self::FAILURE;
        }

        $summary = ['date' => $date->toDateString(), 'dry' => $dry, 'stores' => [], 'errors' => []];

        try {
            // 1) EXTRAER del origen + CARGAR en staging
            if (! $this->option('no-reload')) {
                $rows = $this->extractFromOrigin($date);
                $this->info(sprintf('Extraidas %d filas del origen.', count($rows)));
                if (count($rows) === 0) {
                    $this->warn('No hay ventas facturables para esa fecha. Nada que hacer.');
                    return self::SUCCESS;
                }
                $this->loadIntoStaging($rows);
                $this->info('Cargadas en items_invoice_days (TRUNCATE + INSERT).');
            }

            // 2) FACTURAR por tienda
            $fel = new SoapFELController();
            foreach (Stores::all() as $store) {
                $items = ItemsInvoiceDay::where('storeID', $store->storeID)->get();
                if ($items->isEmpty()) {
                    continue;
                }

                if ($this->alreadyInvoiced($store, $date)) {
                    $this->warn("Tienda {$store->storeID}: ya facturada el {$date->toDateString()}, se omite.");
                    $summary['stores'][] = ['storeID' => $store->storeID, 'status' => 'omitida (ya facturada)', 'items' => $items->count()];
                    continue;
                }

                $saleItems = $this->buildSaleItems($items);
                // Regla SAT: una factura CF/Clientes Varios no puede alcanzar Q2,500.
                // Se divide en varias facturas, cada una por debajo del limite.
                $groups = $this->partitionByCfLimit($saleItems, $cfLimit);
                $storeRow = ['storeID' => $store->storeID, 'items' => $items->count(), 'facturas' => count($groups), 'detalle' => []];
                $storeHadError = false;

                foreach ($groups as $gi => $group) {
                    $n = $gi + 1;
                    $groupTotal = round($this->groupTotal($group), 6);

                    // Un solo item que ya excede el limite no se puede partir por monto: se marca para revision manual.
                    if ($groupTotal >= $cfLimit) {
                        $this->warn("Tienda {$store->storeID} factura {$n}/" . count($groups) . ": un item excede el limite CF (Q{$groupTotal}); requiere manejo manual, NO se emite.");
                        $summary['errors'][] = ['storeID' => $store->storeID, 'factura' => $n, 'error' => "item unico excede limite CF (Q{$groupTotal})"];
                        $storeHadError = true;
                        continue;
                    }

                    $request = $this->buildRequest($store, $group);

                    try {
                        if ($dry) {
                            $xml = $fel->generateXMLtoCertificate($request->invoiceData, $group, 0, json_decode($store->dataFEL), $store->id, null, $emissionDateTime);
                            $dumpDir = storage_path('app/dte-dryrun');
                            if (! is_dir($dumpDir)) {
                                mkdir($dumpDir, 0775, true);
                            }
                            file_put_contents("{$dumpDir}/dte-{$summary['date']}-store{$store->storeID}-{$n}.xml", $xml->xmlDocument);
                            $this->line("Tienda {$store->storeID} factura {$n}/" . count($groups) . ": GranTotal={$xml->dataRegisterInvoice->bigTotal} (DRY-RUN, no emitido)");
                            $storeRow['detalle'][] = ['factura' => $n, 'items' => count($group), 'total' => $xml->dataRegisterInvoice->bigTotal, 'dry' => true];
                            continue;
                        }

                        $result = $fel->certificateDTE($request, $emissionDateTime);

                        if (is_array($result) && isset($result[0]['serialDTE'])) {
                            $serial = $result[0]['serialDTE'] . '-' . $result[0]['numberDTE'];
                            $this->info("Tienda {$store->storeID} factura {$n}/" . count($groups) . ": DTE emitido {$serial} (Q{$groupTotal})");
                            $storeRow['detalle'][] = ['factura' => $n, 'items' => count($group), 'serial' => $serial, 'total' => $groupTotal];
                        } else {
                            $msg = is_string($result) ? $result : json_encode($result);
                            $this->error("Tienda {$store->storeID} factura {$n}: FALLO SAT -> {$msg}");
                            $summary['errors'][] = ['storeID' => $store->storeID, 'factura' => $n, 'error' => $msg];
                            $storeHadError = true;
                        }
                    } catch (Throwable $e) {
                        $this->error("Tienda {$store->storeID} factura {$n}: EXCEPCION -> {$e->getMessage()}");
                        $summary['errors'][] = ['storeID' => $store->storeID, 'factura' => $n, 'error' => $e->getMessage()];
                        $storeHadError = true;
                    }
                }

                // Idempotencia intra-corrida: limpia el staging de la tienda solo si TODAS sus facturas salieron bien.
                if (! $dry && ! $storeHadError) {
                    ItemsInvoiceDay::where('storeID', $store->storeID)->delete();
                }
                $summary['stores'][] = $storeRow;
            }
        } catch (Throwable $e) {
            $summary['errors'][] = ['fatal' => $e->getMessage()];
            Log::error('[invoices:daily] fatal', ['exception' => $e]);
            $this->error('FATAL: ' . $e->getMessage());
        } finally {
            $lock->release();
        }

        $this->notify($summary);

        return empty($summary['errors']) ? self::SUCCESS : self::FAILURE;
    }

    /** Query "Ventas Diarias" parametrizada por rango de fecha [from, from+1). */
    private function extractFromOrigin(Carbon $date): array
    {
        $from = $date->toDateString();
        $to = $date->copy()->addDay()->toDateString();

        $sql = <<<SQL
        SELECT
            fv.sucursal_id                             AS storeID,
            v.producto_id                              AS itemID,
            CONCAT(c.categoria, ' - ', p.nombre, ' - ', ml.nombre) AS name,
            v.cantidad_countable                       AS quantitySale,
            (v.total_countable / v.cantidad_countable) AS priceSale,
            p.producto_generico                        AS generic
        FROM ventas v
        JOIN facturas_ventas fv ON v.factura_id = fv.id
        JOIN productos p        ON v.producto_id = p.id
        JOIN categorias c       ON p.categoria_id = c.id
        JOIN marcas_laboratorios ml ON p.marca_laboratorio_id = ml.id
        WHERE v.deleted_at IS NULL
          AND fv.deleted_at IS NULL
          AND fv.fecha >= ? AND fv.fecha < ?
          AND fv.sucursal_id <> 1
          AND fv.vendedor_id <> 13
          AND v.cantidad_uncountable = 0
        ORDER BY fv.sucursal_id
        SQL;

        return DB::connection('pharmaWeb')->select($sql, [$from, $to]);
    }

    private function loadIntoStaging(array $rows): void
    {
        $now = now();
        $insert = array_map(fn ($r) => [
            'storeID'      => $r->storeID,
            'itemID'       => $r->itemID,
            'name'         => $r->name,
            'quantitySale' => $r->quantitySale,
            'priceSale'    => $r->priceSale,
            'generic'      => $r->generic,
            'created_at'   => $now,
            'updated_at'   => $now,
        ], $rows);

        // Nota: usamos DELETE (DML) y no TRUNCATE (DDL) porque TRUNCATE fuerza un
        // commit implícito en MySQL y rompe la transacción que lo envuelve.
        DB::transaction(function () use ($insert) {
            DB::table('items_invoice_days')->delete();
            foreach (array_chunk($insert, 500) as $chunk) {
                DB::table('items_invoice_days')->insert($chunk);
            }
        });
    }

    /**
     * Idempotencia: ya existe un DTE del LOTE "Clientes Varios" para esta tienda + fecha?
     * Solo cuenta el lote (sellerId IS NULL); las facturas individuales de vendedores
     * (sellerId != null, emitidas en caja) NO deben bloquear la facturación del lote.
     */
    private function alreadyInvoiced(Stores $store, Carbon $date): bool
    {
        return FelInvoices::where('storeId', $store->id)
            ->whereNull('sellerId')
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(invoiceCertificated, '$.date')) = ?", [$date->toDateString()])
            ->exists();
    }

    /** Total de un item tal como lo calcula el XML del DTE: unit_quantity * precio (redondeado a 6). */
    private function itemTotal(array $item): float
    {
        return round(((float) $item['unit_quantity']) * round((float) $item['priceSale'], 6), 6);
    }

    private function groupTotal(array $group): float
    {
        return array_sum(array_map(fn ($it) => $this->itemTotal($it), $group));
    }

    /**
     * Divide los items en grupos (facturas) cuyo total quede POR DEBAJO de $limit,
     * para no romper el tope de facturacion CF/Clientes Varios de la SAT.
     * Llenado greedy en el orden recibido; cierra el grupo antes de alcanzar el limite.
     */
    private function partitionByCfLimit(array $saleItems, float $limit): array
    {
        if ($limit <= 0) {
            return [$saleItems];
        }
        $groups = [];
        $current = [];
        $sum = 0.0;
        foreach ($saleItems as $item) {
            $t = $this->itemTotal($item);
            if (! empty($current) && ($sum + $t) >= $limit) {
                $groups[] = $current;
                $current = [];
                $sum = 0.0;
            }
            $current[] = $item;
            $sum += $t;
        }
        if (! empty($current)) {
            $groups[] = $current;
        }
        return $groups;
    }

    /** Replica EXACTA de SalesTable::generateInvoices() para paridad fiscal con el boton manual. */
    private function buildSaleItems($items): array
    {
        $saleItems = [];
        foreach ($items as $item) {
            $saleItems[] = [
                'itemID'        => $item->itemID,
                'name'          => $item->name,
                'quantity'      => $item->quantitySale,
                'unit_quantity' => $item->quantitySale,
                'discount'      => 0,
                'iva'           => ($item->generic === 1) ? true : false,
                'priceSale'     => $item->priceSale,
                'dataRegister'  => [
                    'price_sale' => $item->priceSale,
                ],
            ];
        }
        return $saleItems;
    }

    private function buildRequest(Stores $store, array $saleItems): Request
    {
        return new Request([
            'invoiceData'   => (object) [
                'nit'     => 'CF',
                'name'    => 'CLIENTES VARIOS',
                'address' => 'CIUDAD',
            ],
            'totalSale'     => 0,
            'storeData'     => json_decode($store->dataFEL),
            'storeId'       => $store->id,
            'sellerId'      => null,
            'has_invoice'   => false,
            'sale_details'  => $saleItems,
            'certifierName' => getenv('FEL_CERTIFICADOR'),
            'certifierNIT'  => getenv('FEL_CERTIFICADOR_NIT'),
            'emisorNIT'     => getenv('FEL_NIT'),
            'emisorName'    => getenv('FEL_NAME_ISSUER'),
        ]);
    }

    private function notify(array $summary): void
    {
        $emitted = 0;
        foreach ($summary['stores'] as $s) {
            foreach ($s['detalle'] ?? [] as $d) {
                if (isset($d['serial'])) {
                    $emitted++;
                }
            }
        }
        $line = sprintf('[invoices:daily] %s -> %d facturas emitidas, %d errores%s', $summary['date'], $emitted, count($summary['errors']), $summary['dry'] ? ' (DRY-RUN)' : '');
        empty($summary['errors']) ? Log::info($line, $summary) : Log::error($line, $summary);

        $to = getenv('INVOICE_NOTIFY_EMAIL');
        if (! $to) {
            return;
        }
        try {
            $body = $line . "\n\n" . json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            Mail::raw($body, fn ($m) => $m->to($to)->subject($line));
        } catch (Throwable $e) {
            Log::warning('[invoices:daily] no se pudo enviar correo: ' . $e->getMessage());
        }
    }
}
