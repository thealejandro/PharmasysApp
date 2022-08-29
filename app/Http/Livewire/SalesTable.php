<?php

namespace App\Http\Livewire;

//require PrintPOS::class;

use App\Http\Controllers\ItemsInvoiceDayController;
use App\Http\Controllers\PrintPOS;
use App\Http\Controllers\SoapFELController;
use App\Models\FelInvoices;
use App\Models\Items;
use App\Models\ItemsInvoiceDay;
use App\Models\SalesRecord;
use App\Models\Sellers;
use App\Models\StoreItemsInventories;
use App\Models\Stores;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class SalesTable extends Component
{
    public $itemsStructure = [];
    public $items;
    public $invoiceGenerate = false;
    public $invoiceNIT = 'CF';
    public $invoiceName = 'Consumidor Final';
    public $invoiceAddress = 'Ciudad';

    protected  $listeners = [
        'item-added' => 'itemAdded',
        'item-deleted' => 'itemDeleted',
        'item-updated' => 'itemUpdated',
    ];

    public function mount()
    {
        $this->items = [];
    }

    protected $rules = [
        'items.*.store_items_inventories_id' => 'required',
        'items.*.itemID' => 'required',
        'items.*.name' => 'required',
        'items.*.quantity_countable' => 'required',
        'items.*.quantity_uncountable' => 'required',
        'items.*.article_data' => 'required',
        'items.*.identifier' => 'required',
    ];

    public function render()
    {
        $this->items = array_map(fn ($i) => new StoreItemsInventories($i), $this->items);

        return view('components.sales-table', [
            'items' => $this->items
        ]);
    }
    /**
     * @param array $itemStrcutre the itemStructure follow the next pattern:
     * [
     *  'id' => int,
     *  'quantity' => int,
     *  'subTotal' => number,
     *  'units' => int,
     *  'presentationKey' => int,
     * ]
     */
    public function itemAdded($itemStructure)
    {
        $newItem = StoreItemsInventories::selectRaw(
            'store_items_inventories.id as store_items_inventories_id,
                items.itemID,
                CONCAT(categories.name," - ",items.name," - ",laboratories.name) as name,
                quantity_countable,
                quantity_uncountable,
                article_data'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->join('categories', 'categories.categoryID', 'items.category_id')
            ->join('laboratories', 'laboratories.laboratoryID', 'items.laboratory_id')
            ->where('store_items_inventories.id', $itemStructure['id'])
            ->first();

        $newItem->identifier = $itemStructure['id'] * count($this->itemsStructure);

        $this->items[] = $newItem->toArray();
        $this->itemsStructure[] = array_merge($itemStructure, ['identifier' => $newItem->identifier]);
    }

    /**
     * @param array $itemStrcutre the itemStructure follow the next pattern:
     * [
     *  'id' => int,
     *  'quantity' => int,
     *  'subTotal' => number,
     *  'units' => int
     *  'presentationKey' => int,
     * ]
     */
    public function itemDeleted($itemStructure)
    {
        $this->itemsStructure = array_filter($this->itemsStructure, function ($i) use ($itemStructure) {
            return $i['identifier'] !== $itemStructure['identifier'];
        });

        $this->items = array_filter($this->items, function ($i) use ($itemStructure) {
            return $i['identifier'] !== $itemStructure['identifier'];
        });
    }

    /**
     * @param array $itemStrcutre the itemStructure follow the next pattern:
     * [
     *  'id' => int,
     *  'quantity' => int,
     *  'subTotal' => number,
     *  'units' => int,
     *  'presentationKey' => int,
     * ]
     */
    public function itemUpdated($itemStructure)
    {
        $this->itemsStructure = array_map(function ($i) use ($itemStructure) {
            return $i['identifier'] === $itemStructure['identifier'] ? $itemStructure : $i;
        }, $this->itemsStructure);
    }

    /**
     * Sell items
     * @throws Exception
     * @throws \Throwable
     */
    public function sell()
    {
            $seller = Sellers::where('user_id', Auth::id())->first();

            $saleItems = [];
            $totalSale = 0;

            foreach ($this->itemsStructure as $itemStructure) {
                $itemInventory = StoreItemsInventories::find($itemStructure['id']);
                $item = Items::where('itemID', $itemInventory->itemID)->first();
                $presentation = $itemInventory->article_data['presentations'][$itemStructure['presentationKey']];

                $unitQuantity = $itemStructure['quantity'] * $itemStructure['units'];
                $quantity_countable = 0;
                $quantity_uncountable = 0;

                if ($itemInventory->quantity_countable >= $itemInventory->quantity_uncountable) {
                    if ($itemInventory->quantity_countable >= $unitQuantity) {
                        $quantity_countable = $unitQuantity;
                    } else {
                        $quantity_countable = $itemInventory->quantity_countable;
                        $quantity_uncountable = $unitQuantity - $itemInventory->quantity_countable;
                    }
                } else {
                    if ($itemInventory->quantity_uncountable >= $unitQuantity) {
                        $quantity_uncountable = $unitQuantity;
                    } else {
                        $quantity_uncountable = $itemInventory->quantity_uncountable;
                        $quantity_countable = $unitQuantity - $itemInventory->quantity_uncountable;
                    }
                }

                $saleItems[] = [
                    'itemID'               => $item->itemID,
                    'name'                 => $itemStructure['name'],
                    'quantity'             => $itemStructure['quantity'],
                    'quantity_countable'   => $quantity_countable,
                    'quantity_uncountable' => $quantity_uncountable,
                    'unit_quantity'        => $unitQuantity,
                    'discount'             => 0,
                    'total'                => $itemStructure['subTotal'],
                    'iva'                  => ($item->generic === 1) ? true : false,
                    'expiry_date'          => $itemInventory->article_data['expiry_date'],
                    'presentation'         => $presentation,
                    'dataRegister'         => [
                        'price_sale'     => $presentation['price'],
                        'price_purchase' => $itemInventory->article_data['price_purchase']
                    ]
                ];

                $totalSale += $itemStructure['subTotal'];
            }

            $lastSaleID = SalesRecord::withTrashed()->orderBy('saleID', 'desc')->first();
            $saleID = (isset($lastSaleID->saleID)) ? $lastSaleID->saleID + 1 : 1;

            if ($this->invoiceGenerate === TRUE) {
                $soapFELController = new SoapFELController();

                $storeData = Stores::where('storeID', $seller->store_id)->first();

                $request = new Request(['invoiceData'   => (object)[
                    'nit'     => $this->invoiceNIT,
                    'name'    => $this->invoiceName,
                    'address' => $this->invoiceAddress
                ],
                                        'totalSale'     => $totalSale,
                                        'saleID'        => $saleID,
                                        'seller_id'     => $seller->id,
                                        'storeData'     => json_decode($storeData->dataFEL),
                                        'storeId'       => $storeData->id,
                                        'sellerId'      => $seller->id,
                                        'has_invoice'   => $this->invoiceGenerate,
                                        'sale_details'  => $saleItems,
                                        'certifierName' => getenv("FEL_CERTIFICADOR"),
                                        'certifierNIT'  => getenv("FEL_CERTIFICADOR_NIT"),
                                        'emisorNIT'     => getenv("FEL_NIT"),
                                        'emisorName'    => getenv("FEL_NAME_ISSUER")]);

                $dteCertificate = $soapFELController->certificateDTE($request);

                // dd($dteCertificate);
//                $this->dispatchBrowserEvent("SKL", ["ksl" => $dteCertificate]);
            }

            //        $this->dispatchBrowserEvent("requestPrintPOS", ["dataPrintPOS" => ["data" => $request]]);

            // SalesRecord::create([
            //                         'saleID'                                               => $saleID,
            //                         'seller_id'                                            => $seller->id,
            //                         'store_id'                                             => $seller->store_id,
            //                         'has_invoice'                                          => $this->invoiceGenerate === TRUE,
            //                         'sale_details'                                         => json_encode([["items" => $saleItems]]),
            //                         'invoice_details' => (isset($dteCertificate)) ? json_encode($dteCertificate) : NULL,
            //                     ]);

            // $store = Stores::select('id')->where('storeID', $seller->store_id)->latest()->first();
            // FelInvoices::create([
            //     'storeId'=> $store,
            // ]);

            $this->cancel();
    }

    /**
     * Cancel the actual sale
     */
    public function cancel()
    {
        $this->itemsStructure = [];
        $this->items = [];
    }

    public function generateInvoices()
    {
        $stores = Stores::all();

        try {
            foreach ($stores as $key => $store) {
                $currentStore = $store->storeID;

                $itemsCurrentStore = ItemsInvoiceDay::where('storeID', $currentStore)->get();
                $totalSale = 0;

                $saleItems = [];

                foreach ($itemsCurrentStore as $key => $item) {
                    $saleItems[] = [
                        'itemID'               => $item->itemID,
                        'name'                 => $item->name,
                        'quantity'             => $item->quantitySale,
                        // 'quantity_countable'   => $quantity_countable,
                        // 'quantity_uncountable' => $quantity_uncountable,
                        'unit_quantity'        => $item->quantitySale,
                        'discount'             => 0,
                        // 'total'                => $itemStructure['subTotal'],
                        'iva'                  => ($item->generic === 1) ? true : false,
                        // 'expiry_date'          => $itemInventory->article_data['expiry_date'],
                        // 'presentation'         => $presentation,
                        'priceSale'            => $item->priceSale,
                        'dataRegister'         => [
                            'price_sale'     => $item->priceSale,
                            // 'price_purchase' => $itemInventory->article_data['price_purchase']
                        ]
                    ];
                }


                $soapFELController = new SoapFELController();

                    $storeData = $store;

                    $request = new Request(['invoiceData'   => (object)[
                        'nit'     => "CF",
                        'name'    => "CLIENTES VARIOS",
                        'address' => "CIUDAD"
                    ],
                        'totalSale'     => $totalSale,
                        // 'saleID'        => $saleID,
                        // 'seller_id'     => $seller->id,
                        'storeData'     => json_decode($storeData->dataFEL),
                        'storeId'       => $store->id,
                        'sellerId'      => null,
                        'has_invoice'   => $this->invoiceGenerate,
                        'sale_details'  => $saleItems,
                        'certifierName' => getenv("FEL_CERTIFICADOR"),
                        'certifierNIT'  => getenv("FEL_CERTIFICADOR_NIT"),
                        'emisorNIT'     => getenv("FEL_NIT"),
                        'emisorName'    => getenv("FEL_NAME_ISSUER")]);

                    $dteCertificate = $soapFELController->certificateDTE($request);
            }
        }  catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fullData()
    {
        $fels = FelInvoices::all();

        foreach ($fels as $dte) {
            $totalAffection = 0;
            $totallyUnaffected = 0;

            $items = json_decode($dte->invoiceDataItems);

            foreach ($items as $item) {
                if ($item->totalIVA > 0) {
                    $totalAffection += $item->total;
                } else {
                    $totallyUnaffected += $item->total;
                }
            }

            $dte->totalAffection = $totalAffection;
            $dte->totallyUnaffected = $totallyUnaffected;
            $dte->save();
        }
    }
}
