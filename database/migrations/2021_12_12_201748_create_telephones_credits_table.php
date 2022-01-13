<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephonesCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephones_credits', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('number_phone');
            $table->foreignId('store_id')->constrained('stores')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telephones_credits', function (Blueprint $tab) {
            $tab->dropForeign(['store_id']);
        });
        Schema::dropIfExists('telephones_credits');
    }
}
