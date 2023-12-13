<?php

namespace App\Livewire\Market\Seller\Sale;

use Livewire\Component;

class TableItem extends Component
{
    public $product;
    public $quantity = 1;
    public $quantityTotal = 0;
    public $price = 0;
    public $subtotal = 0;
    public $presentationId = 0;
    private $presentations = [];


    public function mount($product, $key)
    {
        $this->product = $product;
        $this->presentationId = $product["presentation"][0]["idpresentacion"];
        $this->presentations = $product["presentation"];
        $this->quantityTotal = $product["presentation"][0]["cantidad"];
        $this->price = $product["presentation"][0]["precio"];
        $this->subtotal = $this->quantity * $this->price;
    }

    public function updatedPresentationId()
    {
        foreach ($this->presentations as $presentation) {
            if ($presentation["idpresentacion"] !== $this->presentationId) {
                $this->quantityTotal = $presentation["cantidad"];
                $this->price = $presentation["precio"];
                $this->subtotal = $this->quantity * $this->price;
            } else {
                $this->quantityTotal = $presentation["cantidad"];
                $this->price = $presentation["precio"];
                $this->subtotal = $this->quantity * $this->price;
            }
        }
    }

    public function updatedQuantity()
    {
        $this->subtotal = $this->quantity * $this->price;
    }

    public function removeItem($itemCode)
    {
        // Emitir el evento "selectedProducts" en el componente padre "SellItems" y pasar los productos seleccionados
        $this->dispatch('removeItem', $itemCode);
    }

    public function render()
    {
        return view('livewire..market.seller.sale.table-item');
    }

    public function updated($propertyName)
    {
        // $this->validateOnly($propertyName, [
        //     'quantity' => 'required|numeric|min:1',
        //     'price' => 'required|numeric|min:1',
        //     'presentationId' => 'required|numeric|min:0',
        // ]);

        $this->quantity = $this->quantity;
        $this->presentationId = $this->presentationId;
        $this->subtotal = $this->quantity * $this->price;

        $this->updatedPresentationId();
        $this->updatedQuantity();
    }
}
