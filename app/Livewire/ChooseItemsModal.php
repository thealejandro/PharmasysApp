<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Items;
use Illuminate\Support\Facades\Http;

class ChooseItemsModal extends Component
{
    public $searchTerm = '';
    public $filteredProducts = [];
    public $listItems = [];

    public function render()
    {
        $this->searchTerm = trim($this->searchTerm);

        if (empty($this->searchTerm)) {
            $this->filteredProducts = [];
        } else {

            $searchTerm = Http::get('http://34.125.94.119/nawokpaydev/vender/busqueda.php?idtienda=1&cadena=' . $this->searchTerm);
            $this->filteredProducts = $searchTerm->json();
        }

        foreach ($this->filteredProducts as $product) {
            $this->listItems[$product["codigo"]] = $product;
        };

        return view('livewire.choose-items-modal', [
            'filteredProducts' => $this->filteredProducts
        ]);
    }

    public function addProduct($itemCode)
    {
        // Emitir el evento "selectedProducts" en el componente padre "SellItems" y pasar los productos seleccionados
        $item = $this->listItems[$itemCode];
        $this->dispatch('productAdded', $item);
    }
}

