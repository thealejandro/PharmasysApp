<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laboratoryID')->unique();
            $table->string('name');
            $table->foreignId('provider_id')->nullable()->constrained('providers', 'providerID')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained('contacts', 'id')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::table('laboratories', function (Blueprint $tab) {
           $tab->dropForeign(['provider_id']);
           $tab->dropForeign(['contact_id']);
        });
        Schema::dropIfExists('laboratories');
    }
}
