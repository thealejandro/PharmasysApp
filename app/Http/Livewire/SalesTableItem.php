<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesTableItem extends Component
{
    public $item;
    public $quantity = 1;
    public $price = 0;
    public $subTotal = 0;

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
        $this->subTotal = $this->quantity * $this->price;
        return view('components.sales-table-item');
    }
}
