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
            article_data,
            items.generic'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->join('categories', 'categories.categoryID', 'items.category_id')
            ->join('laboratories', 'laboratories.laboratoryID', 'items.laboratory_id')
            ->where('store_id', $this->seller->store_id)
            ->where(function ($query) {
                $query->orWhere('items.name', 'like', "%{$this->query}%");
                $query->orWhere('categories.name', 'like', "%{$this->query}%");
                $query->orWhere('laboratories.name', 'like', "%{$this->query}%");
                $query->orWhere('items.itemID', $this->query);
            })
            ->get();

        $others = StoreItemsInventories::selectRaw(
            'stores.name as store,
            (quantity_countable + quantity_uncountable) as stock,
            items.itemID'
        )
            ->join('items', 'items.itemID', 'store_items_inventories.itemID')
            ->join('categories', 'categories.categoryID', 'items.category_id')
            ->join('laboratories', 'laboratories.laboratoryID', 'items.laboratory_id')
            ->join('stores', 'stores.storeID', 'store_items_inventories.store_id')
            ->where('store_id', '<>', $this->seller->store_id)
            ->where(function ($query) {
                $query->orWhere('items.name', 'like', "%{$this->query}%");
                $query->orWhere('categories.name', 'like', "%{$this->query}%");
                $query->orWhere('laboratories.name', 'like', "%{$this->query}%");
                $query->orWhere('items.itemID', $this->query);
            })
            ->get();

        foreach ($this->items as $item) {
            $stores = [];
            foreach ($others as $other) {
                if ($other->itemID === $item->itemID) {
                    $stores[] = $other;
                }
            }
            $item->others = $stores;
        }

        return view('components.items-finder', [
            'items' => $this->items
        ]);
    }

    /**
     * @param int $id 'store_items_inventories'.'id'
     * @param boolean $zeroStock Determines if stock is 0
     * @param int|float $price The price of item
     */
    public function addItem($id, $zeroStock, $price, $units, $name)
    {
        if (!$zeroStock) {
            $this->emit('item-added', [
                'id' => $id,
                'quantity' => 1,
                'subTotal' => $price,
                'units' => $units,
                'presentationKey' => 0,
                'name' => $name
            ]);
        }
    }
}
