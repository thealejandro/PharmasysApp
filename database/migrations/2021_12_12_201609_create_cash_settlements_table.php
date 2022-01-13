<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settlement_id')->constrained('settlement_records', 'id')->cascadeOnUpdate();
            $table->double('cash_in_box')->default(0);
            $table->double('money_in_system')->default(0);
            $table->double('money_difference')->default(0);
            $table->string('notes')->nullable();
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
        Schema::table('cash_settlements', function (Blueprint $tab) {
            $tab->dropForeign(['settlement_id']);
        });
        Schema::dropIfExists('cash_settlements');
    }
}
