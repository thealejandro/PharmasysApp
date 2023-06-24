<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Items;

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
            $searchTerm = '%' . $this->searchTerm . '%';

            $this->filteredProducts = Items::
                where('id', 'like', $searchTerm)
                ->orWhere('name', 'like', $searchTerm)
                ->orWhereHas('category', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                })
                ->orWhereHas('laboratory', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                })
                ->get();
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

