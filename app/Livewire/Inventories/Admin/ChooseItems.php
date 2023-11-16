<?php

namespace App\Livewire\Inventories\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChooseItems extends Component
{

    public $items = [];
    public $search = '';
    public $listProducts = [];
    public $selectedBranch = null;


    public function mount()
    {
        // $this->items = "Get all items from database";
    }

    public function searchItems()
    {
        trim($this->search);
        if (strlen($this->search) > 0) {
            $this->getProducts($this->search);
        } else {
            session()->flash('noTextSearch', 'Ingrese un valor para buscar o pulse el botón "Mostrar todos"');
        }
    }

    public function showAllItems()
    {
        $this->getProducts(true);
    }

    private function getProducts(bool $all = false, string $search = "")
    {
        if ($all) {
            $this->listProducts = Http::get('http://' . env('API_IP') . '/nawokpaydev/inventario/busqueda.php?idtienda=1')->json(); // Get all products from API Nawok Pay
        }

        if (!$all && strlen($search) > 0) {
            $this->listProducts = Http::get('http://' . env('API_IP') . '/nawokpaydev/inventario/busqueda.php?idtienda=1&cadena=' . $search)->json(); // Get products from API Nawok Pay
        }

        if (isset($this->listProducts) && count($this->listProducts) > 0) {
            foreach ($this->listProducts as $item) {
                $this->items[$item["idinventario"]] = $item;
            }
        } else {
            session()->flash('noItems', 'No se encontraron productos');
        }
    }

    public function selectItem($item)
    {
        $currentEditItem = $this->items[$item];
        $this->dispatch('itemEdit', $currentEditItem);
    }

    public function selectBranch($branch)
    {
        $this->selectedBranch = $branch;
    }

    public function render()
    {
        return view('livewire.inventories.admin.choose-items');
    }
}
