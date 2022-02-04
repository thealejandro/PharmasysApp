<?php

namespace App\Http\Livewire;

use App\Http\Controllers\SoapFELController;
use App\Models\Items;
use App\Models\SalesRecord;
use App\Models\Sellers;
use App\Models\StoreItemsInventories;
use Illuminate\Http\Request;
use Livewire\Component;

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
     */
    public function sell()
    {
        $seller = Sellers::where('user_id', auth()->user()->id)
            ->first();

        $saleItems = [];

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
                'itemID' => $item->itemID,
                'name' => $itemStructure['name'],
                'quantity' => $itemStructure['quantity'],
                'quantity_countable' => $quantity_countable,
                'quantity_uncountable' => $quantity_uncountable,
                'unit_quantity' => $unitQuantity,
                'discount' => 0,
                'total' => $itemStructure['subTotal'],
                'presentation' => $presentation,
                'dataRegister' => [
                    'price_sale' => $presentation['price'],
                    'price_purchase' => $itemInventory->article_data['price_purchase']
                ]
            ];
        }

        $soapFELController = new SoapFELController();
        $request = new Request(['invoiceData' => (object) [
                                    'nit' => $this->invoiceNIT,
                                    'name' => $this->invoiceName,
                                    'address' => $this->invoiceAddress
                                ],
                                'saleID' => '1',
                                'seller_id' => $seller->id,
                                'store_id' => $seller->store_id,
                                'has_invoice' => $this->invoiceGenerate,
                                'sale_details' => $saleItems]);

        dd($soapFELController->certificateDTE($request));

//        dd([
//            'saleID' => '?',
//            'seller_id' => $seller->id,
//            'store_id' => $seller->store_id,
//            'has_invoice' => false,
//            'sale_details' => $saleItems,
//            'created_at' => now()
//        ]);

        //     SalesRecord::insert([
        //         'saleID' => '?',
        //         'seller_id' => $seller->id,
        //         'store_id' => $seller->store_id,
        //         'has_invoice' => false,
        //         'sale_details' => '',
        //         'created_at' => now()
        //     ]);
    }

    /**
     * Cancel the actual sale
     */
    public function cancel()
    {
        $this->itemsStructure = [];
        $this->items = [];
    }
}
