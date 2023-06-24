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
    { //renombrar a "brands", para hacerla llamar "marcas"
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('provider_id')->nullable()->constrained('providers')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->cascadeOnUpdate()->nullOnDelete(); // No es necesario porque ya esta enlazado al proveedor
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
        Schema::table('laboratories', function (Blueprint $table) {
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['contact_id']);
        });
        Schema::dropIfExists('laboratories');
    }
};
