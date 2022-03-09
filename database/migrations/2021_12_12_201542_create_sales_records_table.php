<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_records', function (Blueprint $table) {
            $table->id();
            $table->string('saleID')->unique();
            $table->foreignId('seller_id')->constrained('sellers');
            $table->foreignId('settlement_record_id')->nullable()->constrained('settlement_records', 'id')->cascadeOnUpdate();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('has_invoice')->default(FALSE);
            $table->json('invoice_details')->nullable();
            $table->json('sale_details');
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
        Schema::table('sales_records', function (Blueprint $tab) {
            $tab->dropForeign(['seller_id']);
            $tab->dropForeign(['settlement_record_id']);
        });
        Schema::dropIfExists('sales_records');
    }
}
