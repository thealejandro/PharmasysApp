<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsInvoiceDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_invoice_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storeID')->constrained('stores', 'storeID');
            $table->unsignedBigInteger('itemID');
            $table->string('name');
            $table->integer('quantitySale')->default(1);
            $table->double('priceSale')->default(1);
            $table->boolean('generic')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_invoice_days', function (Blueprint $table) {
            $table->dropForeign(['storeID']);
        });
        Schema::dropIfExists('items_invoice_days');
    }
}
