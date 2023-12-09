<?php

namespace App\Livewire\Inventories\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use WireUi\Traits\Actions;

class UpdateItems extends Component
{
    use Actions;

    public $item = [];
    public $pricePurchase = 0;
    public $priceSale = 0;
    public $presentations = [];
    public $presentacion = null;
    public $location = [];
    public $expirationDate = '';
    public $stock = 0;
    public $lockButton = true;

    public $dataRaw = [];


    #[On('itemEdit')]
    public function loadData($item)
    {
        $this->item = $item;

        $this->pricePurchase = $item["compra"];
        $this->priceSale = $item["precio"];
        $this->expirationDate = $item["fecha_ven"];
        $this->stock = $item["stock_minimo"];
        $response = Http::get('http://' . env('API_IP') . '/nawokpaydev/inventario/cargarpresentaciones.php?idinventario=1')->json(); // Get all presentations from API Nawok Pay
        foreach ($response as $x) {
            $this->presentations[$x["idpresentacion"]] = $x;
        }

        $this->lockButton = false;

    }

    public function updatePrices()
    {
        $this->validate([
            'pricePurchase' => 'required|numeric',
            'priceSale' => 'required|numeric',
        ]);

        $response = Http::asForm()->post('http://' . env('API_IP') . '/nawokpaydev/inventario/actualizarproducto.php', [
            "idproducto" => $this->item["idproducto"],
            "codigo" => $this->item["codigo"],
            "correlativo" => $this->item["correlativo"],
            "producto" => $this->item["producto"],
            "idcategoria" => $this->item["categoria"],
            "idmarca" => $this->item["idmarca"],
            "imagen" => $this->item["imagen"],
            "productoplano" => $this->item["codigo"] . ' ' . $this->item["correlativo"] . ' ' . $this->item["categoria"] . ' ' . $this->item["producto"] . ' ' . $this->item["marca"],
            "compra" => $this->pricePurchase,
            "minimo" => $this->item["stock_minimo"],
            "fecha" => $this->item["fecha_ven"],
            "cantidad2" => $this->item["cantidad2"],
            "idinventario" => $this->item["idinventario"],
        ]);

        $dataRaw = $response->json();

        // 'precio' => $this->priceSale

        if ($response->ok()) {
            // $this->emit('itemUpdated');
            $this->notification()->success(
                $title = 'Success',
                $description = 'Prices updated successfully',
            );
        }

    }

    public function updatePresentation($presentacion)
    {
        $req = intval($presentacion);
        $this->presentacion = intval($presentacion);

        $this->validate([
            'presentacion' => 'required|numeric',
        ]);

        if (isset($this->presentations[$req])) {
            $matriz = '{
                "1":[
                    "'.$this->presentations[$req]["presentacion"].'",
                    "'.$this->presentations[$req]["cantidad"].'",
                    "'.$this->presentations[$req]["precio"].'",
                    "'.$this->presentations[$req]["prede"].'",
                    "'.$this->presentations[$req]["descuento"].'"
                ]}';

            $matriz = str_replace(" ", "", $matriz);
            $matriz = str_replace("\n", "", $matriz);

            $response = Http::asForm()->post('http://' . env('API_IP') . '/nawokpaydev/inventario/actualizarpresentaciones.php', [
                'matriz' => $matriz,
                'items' => $this->item["idinventario"],
                'idinventario' => $this->item["idinventario"],
            ]);

            if ($response->ok()) {
                // $this->emit('itemUpdated');
                $this->notification()->success(
                    $title = 'Success',
                    $description = 'Presentation updated successfully',
                );
            }

            if ($response->status() == 500) {
                $this->notification()->error(
                    $title = 'Error',
                    $description = 'Error when updating the presentation',
                );
            }

            if ($response->status() == 404) {
                $this->notification()->error(
                    $title = 'Error',
                    $description = 'Error when updating the presentation',
                );
            }

            if ($response->status() == 400) {
                $this->notification()->error(
                    $title = 'Error',
                    $description = 'Error when updating the presentation',
                );
            }

            if ($response->status() == 401) {
                $this->notification()->error(
                    $title = 'Error',
                    $description = 'Error when updating the presentation',
                );
            }
        }


    }

    public function updateLocation()
    {
        $this->validate([
            'location' => 'required',
        ]);

        // $response = Http::post('http://' . env('API_IP') . '/nawokpaydev/inventario/actualizarubicacion.php', [
        //     'idinventario' => $this->item["idinventario"],
        //     'ubicacion' => $this->location,
        // ]);

        // if ($response->ok()) {
        //     $this->emit('itemUpdated');
        // }

        $this->notification()->success(
            $title = 'Success',
            $description = 'Location updated successfully',
        );
    }

    public function updateExpirationDate()
    {
        $this->validate([
            'expirationDate' => 'required|date',
        ]);

        $response = Http::asMultipart()->post('http://' . env('API_IP') . '/nawokpaydev/inventario/actualizarproducto.php', [
            'idproducto' => $this->item["idproducto"],
            'codigo' => $this->item["codigo"],
            'correlativo' => $this->item["correlativo"],
            'producto' => $this->item["producto"],
            'idcategoria' => $this->item["categoria"],
            'idmarca' => $this->item["idmarca"],
            'imagen' => $this->item["imagen"],
            'productoplano' => $this->item["codigo"] . ' ' . $this->item["correlativo"] . ' ' . $this->item["categoria"] . ' ' . $this->item["producto"] . ' ' . $this->item["marca"],
            'compra' => $this->item["compra"],
            'minimo' => $this->item["stock"],
            'fecha' => $this->expirationDate,
            'cantidad2' => $this->item["cantidad2"],
            'idinventario' => $this->item["idinventario"],
        ]);

        if ($response->ok()) {
            // $this->emit('itemUpdated');
            $this->notification()->success(
                $title = 'Success',
                $description = 'Expiration date updated successfully',
            );
        }
    }

    public function updateStock()
    {
        $this->validate([
            'stock' => 'required|numeric',
        ]);

        $response = Http::asMultipart()->post('http://' . env('API_IP') . '/nawokpaydev/inventario/actualizarproducto.php', [
            'idproducto' => $this->item["idproducto"],
            'codigo' => $this->item["codigo"],
            'correlativo' => $this->item["correlativo"],
            'producto' => $this->item["producto"],
            'idcategoria' => $this->item["categoria"],
            'idmarca' => $this->item["idmarca"],
            'imagen' => $this->item["imagen"],
            'productoplano' => $this->item["codigo"] . ' ' . $this->item["correlativo"] . ' ' . $this->item["categoria"] . ' ' . $this->item["producto"] . ' ' . $this->item["marca"],
            'compra' => $this->item["compra"],
            'minimo' => $this->stock,
            'fecha' => $this->item["fecha"],
            'cantidad2' => $this->item["cantidad2"],
            'idinventario' => $this->item["idinventario"],
        ]);

        if ($response->ok()) {
            // $this->emit('itemUpdated');
            $this->notification()->success(
                $title = 'Success',
                $description = 'Stock updated successfully',
            );
        }

    }

    public function render()
    {
        return view('livewire.inventories.admin.update-items');
    }
}
