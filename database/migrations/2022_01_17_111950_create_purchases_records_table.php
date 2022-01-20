<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_records', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_purchase');
            $table->foreignId('providerID')->constrained('providers', 'providerID')->cascadeOnUpdate();
            $table->unsignedBigInteger('invoiceSystemID')->nullable();
            $table->json('invoiceDetails');
            $table->boolean('invoiceCountable')->default(FALSE);
            $table->json('itemsPurchase');
            $table->foreignId('inventoryRecords')->constrained('inventory_records', 'id')->cascadeOnUpdate();
            $table->boolean('purchaseVerified')->default(FALSE);
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
        Schema::table('purchases_records', function (Blueprint $tab) {
            $tab->dropForeign(['inventoryRecords']);
        });
        Schema::dropIfExists('purchases_records');
    }
}
