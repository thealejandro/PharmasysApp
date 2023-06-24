<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Usuario que realiza el registro de la compra
            $table->foreignId('buyer_id')->constrained('users'); // Usuario que realizó la compra
            $table->foreignId('provider_id')->nullable()->constrained('providers'); // Proveedor de la factura
            $table->string('invoice_number')->nullable(); // Número de factura o código único interno
            $table->date('invoice_date')->nullable(); // Fecha de la factura de compra
            $table->date('entry_date')->nullable(); // Fecha de ingreso de la factura de compra
            $table->boolean('is_accountable')->default(true); // Indica si es una factura de compra contable
            $table->decimal('amount', 10, 2); // Monto de la factura
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['provider_id']);
        });
        Schema::dropIfExists('purchases');
    }
};
