<?php

namespace App\Http\Livewire;

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
     * ]
     */
    public function itemUpdated($itemStructure)
    {
        $this->itemsStructure = array_map(function ($i) use ($itemStructure) {
            if ($i['id'] === $itemStructure['id']) {
                return [
                    'id' => $itemStructure['id'],
                    'quantity' => $itemStructure['quantity'],
                    'subTotal' => $itemStructure['subTotal']
                ];
            }
            return $i;
        }, $this->itemsStructure);
    }
}
