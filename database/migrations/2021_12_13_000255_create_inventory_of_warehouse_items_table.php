<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOfWarehouseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_of_warehouse_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_codeBar_id')->constrained('items', 'codeBar')->cascadeOnUpdate();
            $table->integer('quantity_countable')->default(0);
            $table->integer('quantity_uncountable')->default(0);
            $table->json('article_data');
            $table->json('article_data_for_warehouse')->nullable();
            $table->integer('starring_inventory_quantity')->default(0);
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
        Schema::table('inventory_of_warehouse_items', function (Blueprint $tab) {
            $tab->dropForeign(['item_codeBar_id']);
        });
        Schema::dropIfExists('inventory_of_warehouse_items');
    }
}
