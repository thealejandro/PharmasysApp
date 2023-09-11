<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Items;
use Illuminate\Support\Facades\Http;

class ChooseItemsModal extends Component
{
    public $searchTerm = '';
    public $filteredProducts = [];

    public function render()
    {
        $this->searchTerm = trim($this->searchTerm);

        if (empty($this->searchTerm)) {
            $this->filteredProducts = [];
        } else {

            $searchTerm = Http::get('http://34.125.94.119/nawokpaydev/vender/busqueda.php?idtienda=1&cadena=' . $this->searchTerm);
            $this->filteredProducts = $searchTerm->json();
        }

        return view('livewire.choose-items-modal', [
            'filteredProducts' => $this->filteredProducts
        ]);
    }

    public function addProduct($productId)
    {
        // Emitir el evento "selectedProducts" en el componente padre "SellItems" y pasar los productos seleccionados
        $this->emit('productAdded', $productId);
    }
}

