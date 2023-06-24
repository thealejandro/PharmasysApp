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
        // Schema::create('sales_records', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users');
        //     $table->foreignId('seller_id')->constrained('sellers');
        //     $table->foreignId('store_id')->constrained('stores')->cascadeOnUpdate();
        //     $table->boolean('has_invoice')->default(false);
        //     $table->json('invoice_details')->nullable();
        //     $table->json('sale_data');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_records', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['store_id']);
        });
        Schema::dropIfExists('sales_records');
    }
};
