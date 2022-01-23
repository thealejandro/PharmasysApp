<?php

namespace App\Http\Livewire;

use App\Models\Sellers;
use App\Models\StoreItemsInventories;
use Livewire\Component;

class InventoryTable extends Component
{

    public $query = '';

    public $queryString = ['query' => ['except' => '']];

    public function render()
    {

        $this->query = trim($this->query);

        if (empty($this->query)) {
            return view('components.inventory-table', ['items' => []]);
        }

        $seller = Sellers::where('user_id', auth()->user()->id)
            ->first();

        $items = StoreItemsInventories::selectRaw(
            'items.itemID,
            CONCAT(categories.name," - ",items.name," - ",laboratories.name) as name,
            quantity_countable,
            quantity_uncountable,
            article_data'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->join('categories', 'categories.categoryID', 'items.category_id')
            ->join('laboratories', 'laboratories.laboratoryID', 'items.laboratory_id')
            ->orWhere('items.name', 'like', "%{$this->query}%")
            ->orWhere('categories.name', 'like', "%{$this->query}%")
            ->orWhere('laboratories.name', 'like', "%{$this->query}%")
            ->orWhere('items.itemID', 'like', "%{$this->query}")
            ->where('store_id', $seller->store_id)
            ->get();

        return view('components.inventory-table', [
            'items' => $items,
        ]);
    }
}
