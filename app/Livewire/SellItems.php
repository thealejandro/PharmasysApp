<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use WireUi\Traits\Actions;

class SellItems extends Component
{
    use Actions;

    public $listProducts = [];
    public $total = 0;
    public $nitClient = "";
    public $nameClient = "";
    public $addressClient = "";
    public $saleId = 0;


    // public function mount()
    // {
    //     // Aquí puedes obtener los productos seleccionados
    //     // y almacenarlos en la propiedad $selectedProducts
    //     $this->listProducts = [];

    //     $this->nitClient;
    //     $this->nameClient;
    //     $this->addressClient;
    // }

    #[On('productAdded')]
    public function addItem($product)
    {
        $presentations = base64_decode($product["presentaciones"]);
        $presentations = json_decode($presentations, true);
        $itemCode = $product["codigo"] + rand(1, 1000);

        // Método para almacenar los productos seleccionados en la propiedad $selectedProducts
        // del componente Livewire "sell-items" (en el formulario de venta) y en el componente Livewire "choose-items-modal" (en el formulario de búsqueda de productos)
        // para que se muestren los productos seleccionados en ambos formularios.
        // El método se ejecuta cada vez que se emita el evento "productAdded" desde el componente "choose-items-modal".

        // if (isset($this->listProducts[$itemCode]) ) {
        //     $this->listProducts[$itemCode]['quantity']++;
        //     $this->listProducts[$itemCode]['total'] = $this->listProducts[$itemCode]['price'] * $this->listProducts[$itemCode]['quantity'];
        // } else {
            $this->listProducts[$itemCode] = [
                'code' => $itemCode, // Código único para cada producto seleccionado, para poder eliminarlo posteriormente
                'id' => $product["codigo"],
                'name' => $product["categoria"] . ' - ' . $product["producto"] . ' - ' . $product["marca"],
                'presentation' => $presentations,
                'price' => $product["precio"],
                'quantity' => 1,
                'total' => $product["precio"]
            ];
        // }

        $this->total = round(array_sum(array_column($this->listProducts, 'total')), 2);
    }

    public function removeItem($itemCode)
    {
        // Método para eliminar un producto de la propiedad $selectedProducts
        unset($this->listProducts[$itemCode]);

        $this->total = round(array_sum(array_column($this->listProducts, 'total')), 2);
    }

    public function vender()
    {
        // Aquí puedes implementar la lógica para realizar la venta,
        // utilizando los productos seleccionados ($this->selectedProducts)
        // y cualquier otra acción necesaria.

        // Por ejemplo, podrías mostrar un mensaje de éxito o error.

        if (count($this->listProducts) > 0) {
            $this->notification()->success(
                $title = 'Success',
                $description = 'Sale completed successfully',
            );
        }


        // También podrías emitir un evento para comunicarte con el componente "choose-items-modal".
        // $this->emit('ventaRealizada');
    }

    public function cancelSale()
    {
        // Método para cancelar la venta y limpiar los productos seleccionados
        $this->listProducts = [];
        $this->total = 0;
        $this->nitClient = "";
        $this->nameClient = "";
        $this->addressClient = "";
    }

    public function saveSale()
    {
        if (count($this->listProducts) > 0) {
            $products = [];
            foreach ($this->listProducts as $product) {
                $products[$this->saleId] = [
                    'id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'total' => $product['total']
                ];
            }

            $data = [
                'nit' => $this->nitClient,
                'name' => $this->nameClient,
                'address' => $this->addressClient,
                'products' => $products
            ];

            // $response = Http::post('http://');
            // $response = $response->object();

            // if ($response->status == 'error') {
            //     session()->flash('errorSaveSale', '¡Error al guardar la venta!');
            // }

            // $this->saleId = $response->saleId;

            session()->flash('successSaveSale', '¡Venta guardada con éxito!');



            // Método para guardar la venta y limpiar los productos seleccionados
            $this->saleId = 0;
            $this->listProducts = [];
            $this->total = 0;
            $this->nitClient = "";
            $this->nameClient = "";
            $this->addressClient = "";
        } else {
            session()->flash('notProductsSale', '¡No hay productos seleccionados!');
        }
    }

    public function buscarCliente()
    {
        // Método para depurar el NIT del cliente en tiempo real (cada vez que se modifique el campo) y actualizar el valor del NIT depurado en la propiedad $nitClient
        // del componente Livewire "sell-items" (en el formulario de venta) y en el componente Livewire "choose-items-modal" (en el formulario de búsqueda de productos)
        // para que se muestre el NIT depurado en ambos formularios.
        // El método se ejecuta cada vez que se modifique el campo. El método se ejecuta cada vez que se modifique el campo.
        // El método se ejecuta cada vez que se modifique el campo.

        // Depurar el valor del NIT del cliente (en tiempo real

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

