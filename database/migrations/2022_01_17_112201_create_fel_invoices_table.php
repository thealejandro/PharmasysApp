<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFelInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fel_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storeId')->constrained('stores', 'id');
            $table->foreignId('sellerId')->constrained('sellers', 'id');
            $table->json('invoiceCertificated');
            $table->json('invoiceDataClient');
            $table->json('invoiceDataItems');
            // $table->string('number_certification')->unique();
            // $table->string('number_serial');
            // $table->string('number_dte');
            // $table->json('detailsInvoice');
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
        Schema::table('fel_invoices', function (Blueprint $table) {
            $table->dropForeign(['storeID']);
            $table->dropForeign(['sellerID']);
        });
        Schema::dropIfExists('fel_invoices');
    }
}
