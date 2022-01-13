<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores');
            $table->foreignId('manager_id')->constrained('managers');
            $table->foreignId('user_supervisor_id')->constrained('users');
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
        Schema::table('settlement_records', function (Blueprint $tab) {
            $tab->dropForeign(['store_id']);
            $tab->dropForeign(['manager_id']);
            $tab->dropForeign(['user_supervisor_id']);
        });
        Schema::dropIfExists('settlement_records');
    }
}
