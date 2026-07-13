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
        {--no-reload : No re-extrae del origen; factura lo que ya esta en items_invoice_days}';

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
                $request = $this->buildRequest($store, $saleItems);

                try {
                    if ($dry) {
                        $xml = $fel->generateXMLtoCertificate($request->invoiceData, $saleItems, 0, json_decode($store->dataFEL), $store->id, null, $emissionDateTime);
                        $this->line("Tienda {$store->storeID}: XML armado, GranTotal={$xml->dataRegisterInvoice->bigTotal} (DRY-RUN, no emitido)");
                        $summary['stores'][] = ['storeID' => $store->storeID, 'status' => 'dry-run OK', 'items' => $items->count(), 'total' => $xml->dataRegisterInvoice->bigTotal];
                        continue;
                    }

                    $result = $fel->certificateDTE($request, $emissionDateTime);

                    if (is_array($result) && isset($result[0]['serialDTE'])) {
                        $serial = $result[0]['serialDTE'] . '-' . $result[0]['numberDTE'];
                        $this->info("Tienda {$store->storeID}: DTE emitido {$serial}");
                        $summary['stores'][] = ['storeID' => $store->storeID, 'status' => 'emitido', 'serial' => $serial, 'items' => $items->count()];
                        // Idempotencia intra-corrida: limpia lo ya facturado de esta tienda.
                        ItemsInvoiceDay::where('storeID', $store->storeID)->delete();
                    } else {
                        $msg = is_string($result) ? $result : json_encode($result);
                        $this->error("Tienda {$store->storeID}: FALLO SAT -> {$msg}");
                        $summary['errors'][] = ['storeID' => $store->storeID, 'error' => $msg];
                    }
                } catch (Throwable $e) {
                    $this->error("Tienda {$store->storeID}: EXCEPCION -> {$e->getMessage()}");
                    $summary['errors'][] = ['storeID' => $store->storeID, 'error' => $e->getMessage()];
                    // Continuamos con las demas tiendas.
                }
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

        DB::transaction(function () use ($insert) {
            DB::table('items_invoice_days')->truncate();
            foreach (array_chunk($insert, 500) as $chunk) {
                DB::table('items_invoice_days')->insert($chunk);
            }
        });
    }

    /** Idempotencia: ya existe un DTE emitido para esta tienda + fecha? */
    private function alreadyInvoiced(Stores $store, Carbon $date): bool
    {
        return FelInvoices::where('storeId', $store->id)
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(invoiceCertificated, '$.date')) = ?", [$date->toDateString()])
            ->exists();
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
        $emitted = collect($summary['stores'])->where('status', 'emitido')->count();
        $line = sprintf('[invoices:daily] %s -> %d emitidos, %d errores%s', $summary['date'], $emitted, count($summary['errors']), $summary['dry'] ? ' (DRY-RUN)' : '');
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
