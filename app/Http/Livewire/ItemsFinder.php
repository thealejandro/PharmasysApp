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

    public function mount()
    {
        $this->seller = Sellers::where('user_id', auth()->user()->id)
            ->first();
    }

    public function render()
    {
        $this->items = StoreItemsInventories::where('store_id', $this->seller->store_id)
            // ->where('name', 'like', "%{$this->query}%")
            ->limit(25)
            ->get();

        return view('components.items-finder', [
            'items' => $this->items
        ]);
    }
}
