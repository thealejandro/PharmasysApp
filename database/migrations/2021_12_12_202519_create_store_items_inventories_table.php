<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreItemsInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_items_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnUpdate();
            $table->foreignId('item_codeBar_id')->constrained('items', 'codeBar')->cascadeOnUpdate();
            $table->integer('quantity_countable')->default(0);
            $table->integer('quantity_uncountable')->default(0);
            $table->json('article_data');
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
        Schema::table('store_items_inventories', function (Blueprint $tab) {
            $tab->dropForeign(['store_id']);
            $tab->dropForeign(['item_codeBar_id']);
        });
        Schema::dropIfExists('store_items_inventories');
    }
}
