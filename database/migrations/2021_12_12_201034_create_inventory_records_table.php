<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_records', function (Blueprint $table) {
            $table->id();
            $table->string('internal_correlative')->unique();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnUpdate();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('finish_date')->nullable();
            $table->double('financial_state')->default(0);
            $table->foreignId('store_manager_id')->constrained('managers')->cascadeOnUpdate();
            $table->foreignId('user_supervisor_id')->constrained('users', 'id')->cascadeOnUpdate();
            $table->json('inventory_data')->nullable();
            $table->string('status')->default('waiting');
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
        Schema::table('inventory_records', function (Blueprint $tab) {
            $tab->dropForeign(['store_id']);
            $tab->dropForeign(['store_manager_id']);
            $tab->dropForeign(['user_supervisor_id']);
        });
        Schema::dropIfExists('inventory_records');
    }
}
