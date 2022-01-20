<?php

namespace App\Http\Livewire;

use App\Models\StoreItemsInventories;
use Livewire\Component;

class SalesTable extends Component
{
    public $itemIds = [];
    protected $items = [];

    protected  $listeners = [
        'item-added' => 'itemAdded'
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
            ->whereIn('store_items_inventories.id', $this->itemIds)
            ->get();

        return view('components.sales-table', [
            'items' => $this->items
        ]);
    }

    public function itemAdded($id)
    {
        $this->itemIds[] = $id;
    }
}
