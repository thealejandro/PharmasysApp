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
        Schema::create('purchase_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->cascadeOnUpdate()->onDelete('cascade'); // ID de factura de compra
            $table->string('branch'); // Sucursal
            $table->string('telephony'); // Telefonía
            $table->string('phone'); // Teléfono
            $table->date('purchase_date'); // Fecha de compra
            $table->decimal('purchased_balance', 8, 2); // Saldo comprado
            $table->decimal('previous_balance', 8, 2); // Saldo anterior
            $table->decimal('invoice_amount', 8, 2); // Monto de factura
            $table->text('details')->nullable(); // Detalles
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
        Schema::table('purchase_balances', function (Blueprint $table) {
            $table->dropForeign(['purchase_id']);
        });
        Schema::dropIfExists('purchase_balances');
    }
};
