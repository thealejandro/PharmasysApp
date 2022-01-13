<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashCreditsSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_credits_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('settlement_id')->constrained('settlement_records', 'id')->cascadeOnUpdate();
            $table->foreignId('phone_id')->constrained('telephones_credits')->cascadeOnUpdate();
            $table->double('credit_available')->default(0);
            $table->double('credit_initial')->default(0);
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
        Schema::table('cash_credits_settlements', function (Blueprint $tab) {
            $tab->dropForeign(['settlement_id']);
            $tab->dropForeign(['phone_id']);
        });
        Schema::dropIfExists('cash_credits_settlements');
    }
}
