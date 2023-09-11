<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Items;
use Illuminate\Support\Facades\Http;

class SellItems extends Component
{
    public $listProducts = [];
    public $total = 0;
    public $nitClient = "";
    public $nameClient = "";
    public $addressClient = "";

    protected $listeners = ['productAdded' => 'selectedProducts'];

    // public function mount()
    // {
    //     // Aquí puedes obtener los productos seleccionados
    //     // y almacenarlos en la propiedad $selectedProducts
    //     $this->listProducts = [];

    //     $this->nitClient;
    //     $this->nameClient;
    //     $this->addressClient;
    // }

    public function selectedProducts($products)
    {
        // Obtener el producto seleccionado según el ID
        $item = $products;

        $this->listProducts[] += $item;
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

    public function buscarCliente()
    {
        // Método para depurar el NIT del cliente en tiempo real (cada vez que se modifique el campo) y actualizar el valor del NIT depurado en la propiedad $nitClient
        // del componente Livewire "sell-items" (en el formulario de venta) y en el componente Livewire "choose-items-modal" (en el formulario de búsqueda de productos)
        // para que se muestre el NIT depurado en ambos formularios.
        // El método se ejecuta cada vez que se modifique el campo. El método se ejecuta cada vez que se modifique el campo.
        // El método se ejecuta cada vez que se modifique el campo.

        //   dd($this->nitClient); // Depurar el valor del NIT del cliente (en tiempo real

        $nit = $this->nitClient;

        $nit = trim($nit); // Eliminar espacios en blanco en cualquier posición

        // Eliminar puntos (.) si hay caracteres diferentes a un punto o si es diferente a un único punto
        if (preg_match('/[^.]/', $nit) || $nit !== '.') {
            $nit = str_replace('.', '', $nit);
        }

        $nit = str_replace('_', '', $nit); // Eliminar guiones (altos o bajos) en la ante penúltima posición
        $nit = preg_replace('/k$/', 'K', $nit); // Reemplazar "k" minúscula por "K" mayúscula en la última posición

        // Reemplazar "C/F" o "CONSUMIDOR FINAL" por "CF" en mayúsculas
        $nit = preg_replace('/C\/F|CONSUMIDOR FINAL/i', 'CF', $nit);

        $pattern = '/^((?:[0-9]+|[0-9]+K|CF))$/'; // Expresión regular para validar el formato del NIT

        if (!preg_match($pattern, $nit)) {
            $this->nitClient = ''; // Si el formato no es válido, limpiar el campo
            $this->addressClient = '';
            $this->nameClient = '';
        } else {
            $this->nitClient = $nit; // Actualizar el valor del NIT depurado

            $verifyNIT = Http::get('http://34.125.94.119/nawokpay/vender/consultarnit.php?code=developer&nit=' . $this->nitClient . '&idtienda=1');
            $verifyNIT = $verifyNIT->object();
            $verifyNIT = $verifyNIT[0];

            if (!isset($verifyNIT->nit)) {
                $this->nitClient = '';
                $this->addressClient = '';
                $this->nameClient = '';
            }

            $this->nitClient = $verifyNIT->nit;
            $this->addressClient = $verifyNIT->direccion;
            $this->nameClient = $verifyNIT->nombre;
        }
    }

    public function render()
    {
        return view('livewire.sell-items', [
            'selectedProducts' => $this->listProducts
        ]);
    }
}

