<?php

namespace App\Http\Livewire;

use App\Models\Sellers;
use App\Models\StoreItemsInventories;
use Livewire\Component;

class ItemsFinder extends Component
{

    public $query = '';
    protected $items = [];
    protected $seller;

    public function render()
    {
        $this->seller = Sellers::where('user_id', auth()->user()->id)
            ->first();

        $this->items = StoreItemsInventories::select(
            'store_items_inventories.id as store_items_inventories_id',
            'items.itemID',
            'items.name',
            'quantity_countable',
            'quantity_uncountable',
            'article_data'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->where('store_id', $this->seller->store_id)
            ->where('items.name', 'like', "%{$this->query}%")
            ->limit(10)
            ->get();

        return view('components.items-finder', [
            'items' => $this->items
        ]);
    }

    /**
     * @param int $id 'store_items_inventories'.'id'
     * @param boolean $zeroStock Determines if stock is 0
     * @param int|float $price The price of item
     */
    public function addItem($id, $zeroStock, $price)
    {
        if (!$zeroStock) {
            $this->emit('item-added', [
                'id' => $id,
                'quantity' => 1,
                'subTotal' => $price
            ]);
        }
    }
}
