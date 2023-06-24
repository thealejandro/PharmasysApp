<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Items;

class SellItems extends Component
{
    public $listProducts = [];

    protected $listeners = ['productAdded' => 'selectedProducts'];

    // public function mount()
    // {
    //     // Aquí puedes obtener los productos seleccionados
    //     // y almacenarlos en la propiedad $selectedProducts
    //     $this->listProducts = [];
    // }

    public function selectedProducts($products)
    {
        // Obtener el producto seleccionado según el ID
        $item = Items::find($products);

        $this->listProducts[] = $item;

    }

    public function vender()
    {
        // Aquí puedes implementar la lógica para realizar la venta,
        // utilizando los productos seleccionados ($this->selectedProducts)
        // y cualquier otra acción necesaria.

        // Por ejemplo, podrías mostrar un mensaje de éxito o error.
        session()->flash('message', '¡Venta realizada con éxito!');

        // También podrías emitir un evento para comunicarte con el componente "choose-items-modal".
        $this->emit('ventaRealizada');
    }

    public function render()
    {
        return view('livewire.sell-items', [
            'selectedProducts' => $this->listProducts
        ]);
    }
}

