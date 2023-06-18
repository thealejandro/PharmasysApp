<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contacts;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Laboratories;
use App\Models\Providers;
use App\Models\Purchases;
use App\Models\PurchaseBalance;

class DataDBTest extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar categorías
        Categories::create(['name' => 'Electrónica']);
        Categories::create(['name' => 'Ropa']);
        Categories::create(['name' => 'Alimentos']);

        // Insertar marcas
        Laboratories::create(['name' => 'Samsung']);
        Laboratories::create(['name' => 'Nike']);
        Laboratories::create(['name' => "D'Gari"]);

        // Insertar contactos
        Contacts::create(['name' => 'Contacto 1', 'address' => 'Calle Principal', 'phone' => '1234567890', 'email' => 'example@email.com']);
        Contacts::create(['name' => 'Contacto 2', 'address' => 'Calle Secundaria', 'phone' => '1234567890', 'email' => 'example@email.com']);
        Contacts::create(['name' => 'Contacto 3', 'address' => 'Calle Terciaria', 'phone' => '1234567890', 'email' => 'example@email.com']);

        // Insertar proveedores
        Providers::create(['name' => 'Proveedor 1', 'contact_id' => 1]);
        Providers::create(['name' => 'Proveedor 2', 'contact_id' => 2]);
        Providers::create(['name' => 'Proveedor 3', 'contact_id' => 3]);

        // Insertar productos
        Items::create(['barcode' => '1111', 'name' => 'Televisor', 'category_id' => 1, 'laboratory_id' => 1]);
        Items::create(['barcode' => '2222', 'name' => 'Camiseta', 'category_id' => 2, 'laboratory_id' => 2]);
        Items::create(['barcode' => '3333', 'name' => 'Arroz', 'category_id' => 3, 'laboratory_id' => 3]);

        // Insertar compras
        // Purchases::create(['product_id' => 1, 'provider_id' => 1, 'quantity' => 5, 'price' => 1000.00]);
        // Purchases::create(['product_id' => 2, 'provider_id' => 2, 'quantity' => 10, 'price' => 500.00]);
        // Purchases::create(['product_id' => 3, 'provider_id' => 3, 'quantity' => 20, 'price' => 200.00]);

        // Insertar saldos de compras
        // PurchaseBalance::create(['purchase_id' => 1, 'payment_date' => '2023-05-20', 'amount' => 5000.00]);
        // PurchaseBalance::create(['purchase_id' => 2, 'payment_date' => '2023-05-21', 'amount' => 5000.00]);
        // PurchaseBalance::create(['purchase_id' => 3, 'payment_date' => '2023-05-22', 'amount' => 4000.00]);
    }
}
