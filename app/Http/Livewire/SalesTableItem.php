<?php

namespace App\Http\Livewire;

use App\Models\StoreItemsInventories;
use Livewire\Component;

class SalesTableItem extends Component
{
    public $item;
    public $quantity = 1;
    public $price = 0;
    public $subTotal = 0;
    public $isBadQuantity = false;
    public $isOutOfStock = false;

    protected $rules = [
        'item.store_items_inventories_id' => 'required',
        'item.itemID' => 'required',
        'item.name' => 'required',
        'item.quantity_countable' => 'required',
        'item.quantity_uncountable' => 'required',
        'item.article_data' => 'required'
    ];

    public function mount()
    {
        $this->price = $this->item->article_data['presentations'][0]['price'];
        $this->subTotal = $this->quantity * $this->price;
    }

    public function render()
    {
        return view('components.sales-table-item');
    }

    /**
     * Runs after any update to the Livewire component's data (Using wire:model, not directly inside PHP)
     */
    public function updated()
    {
        $this->quantity = intval($this->quantity);
        $this->price = floatval($this->price);

        $stock = StoreItemsInventories::selectRaw('(quantity_countable + quantity_uncountable) as stock')
            ->where('id', $this->item->store_items_inventories_id)
            ->first()
            ->stock ?? 0;

        $this->isBadQuantity = $this->quantity <= 0;
        $this->isOutOfStock =  $stock <= 0 || $this->quantity > $stock;

        $this->subTotal = $this->quantity *  $this->price;

        $this->update();
    }

    public function delete()
    {
        $this->emitUp('item-deleted', [
            'id' => $this->item->store_items_inventories_id,
            'quantity' => $this->quantity,
            'subTotal' => $this->subTotal
        ]);
    }

    public function update()
    {
        $this->emitUp('item-updated', [
            'id' => $this->item->store_items_inventories_id,
            'quantity' => $this->quantity,
            'subTotal' => $this->subTotal
        ]);
    }
}
