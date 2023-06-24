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
    {

        // Tabla de registros de asignaciones de gerentes de tiendas
        Schema::create('manager_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('user_approve_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            // Indexar las claves foráneas
            $table->index('user_id');
            $table->index('user_approve_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('managers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_approve_id']);
        });
        Schema::dropIfExists('manager_assignments');
    }
};
