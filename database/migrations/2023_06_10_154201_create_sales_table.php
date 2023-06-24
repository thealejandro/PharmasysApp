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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Usuario responsable de la venta
            $table->foreignId('store_id')->constrained('stores'); // Sucursal a la que pertenece la venta
            $table->foreignId('seller_id')->constrained('sellers'); // Vendedor asociado a la venta
            $table->date('sale_date'); // Fecha de la venta
            $table->decimal('total_amount', 10, 2); // Monto total de la venta
            $table->string('invoice_number')->nullable(); // Número de factura asociado a la venta
            $table->string('payment_method')->nullable(); // Método de pago utilizado
            $table->decimal('discount', 8, 2)->nullable(); // Descuento aplicado a la venta
            $table->text('notes')->nullable(); // Notas o comentarios adicionales
            $table->string('status')->default('pendiente'); // Estado de la venta
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
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['store_id']);
            $table->dropForeign(['seller_id']);
        });
        Schema::dropIfExists('sales');
    }
};
