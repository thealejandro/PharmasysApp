<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashCopiesSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_copies_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settlement_id')->constrained('settlement_records', 'id')->cascadeOnUpdate();
            $table->integer('letter_counter')->default(0);
            $table->integer('legal_counter')->default(0);
            $table->integer('bad_counter')->default(0);
            $table->double('money_received')->default(0);
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
        Schema::table('cash_copies_settlements', function (Blueprint $tab) {
            $tab->dropForeign(['settlement_id']);
        });
        Schema::dropIfExists('cash_copies_settlements');
    }
}
