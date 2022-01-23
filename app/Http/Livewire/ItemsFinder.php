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

        $this->query = trim($this->query);

        if (empty($this->query)) {
            return view('components.items-finder', ['items' => []]);
        }

        $this->items = StoreItemsInventories::selectRaw(
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
            ->where('store_id', $this->seller->store_id)
            ->having('name', 'like', "%{$this->query}%")
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
    public function addItem($id, $zeroStock, $price, $units)
    {
        if (!$zeroStock) {
            $this->emit('item-added', [
                'id' => $id,
                'quantity' => 1,
                'subTotal' => $price,
                'units' => $units,
                'presentationKey' => 0
            ]);
        }
    }
}
