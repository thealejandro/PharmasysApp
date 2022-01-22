<?php

namespace App\Http\Livewire;

use App\Models\Items;
use App\Models\SalesRecord;
use App\Models\Sellers;
use App\Models\StoreItemsInventories;
use Livewire\Component;

class SalesTable extends Component
{
    public $itemsStructure = [];
    protected $items = [];

    protected  $listeners = [
        'item-added' => 'itemAdded',
        'item-deleted' => 'itemDeleted',
        'item-updated' => 'itemUpdated',
    ];

    public function render()
    {
        $this->items =  StoreItemsInventories::select(
            'store_items_inventories.id as store_items_inventories_id',
            'items.itemID',
            'items.name',
            'quantity_countable',
            'quantity_uncountable',
            'article_data'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->whereIn('store_items_inventories.id', array_map(fn ($e) => $e['id'], $this->itemsStructure))
            ->get();

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
        $ids = array_map(fn ($i) => $i['id'], $this->itemsStructure);
        if (!in_array($itemStructure['id'], $ids)) {
            $this->itemsStructure[] = $itemStructure;
        }
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
            return $i['id'] !== $itemStructure['id'];
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
            if ($i['id'] === $itemStructure['id']) {
                return [
                    'id' => $itemStructure['id'],
                    'quantity' => $itemStructure['quantity'],
                    'subTotal' => $itemStructure['subTotal'],
                    'units' => $itemStructure['units'],
                    'presentationKey' => $itemStructure['presentationKey']
                ];
            }
            return $i;
        }, $this->itemsStructure);
    }

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
                'quantity' => $unitQuantity,
                'quantity_countable' => $quantity_countable,
                'quantity_uncountable' => $quantity_uncountable,
                'discount' => 0,
                'presentation' => $presentation,
                'dataRegister' => [
                    'price_sale' => $presentation['price'],
                    'price_purchase' => $itemInventory->article_data['price_purchase']
                ]
            ];
        }
        dd($saleItems);

        //     SalesRecord::insert([
        //         'saleID' => '?',
        //         'seller_id' => $seller->id,
        //         'store_id' => $seller->store_id,
        //         'has_invoice' => false,
        //         'sale_details' => '',
        //         'created_at' => now()
        //     ]);
    }
}
