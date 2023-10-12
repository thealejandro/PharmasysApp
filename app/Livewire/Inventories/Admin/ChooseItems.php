<?php

namespace App\Livewire\Inventories\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChooseItems extends Component
{

    public $items = [];
    public $selectedItem = null;
    public $search = '';

    public function mount()
    {
        // $this->items = "Get all items from database";
    }

    public function searchItems()
    {
        $this->items = Http::get('http://34.125.94.119/nawokpaydev/inventario/busqueda.php?idtienda=1&cadena=' . $this->search)->json();
    }

    public function showAllItems()
    {
        $this->items = Http::get('http://34.125.94.119/nawokpaydev/inventario/busqueda.php?idtienda=1')->json();
    }

    public function selectItem($item)
    {
        $this->selectedItem = $item;
    }

    public function render()
    {
        return view('livewire.inventories.admin.choose-items');
    }
}
