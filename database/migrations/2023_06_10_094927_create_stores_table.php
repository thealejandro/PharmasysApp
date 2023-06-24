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
        Schema::create('stores', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->foreignId('manager_id')->nullable()->constrained('managers')->cascadeOnUpdate()->nullOnDelete();
            // $table->integer('phone')->nullable();
            // $table->string('address')->nullable();
            // $table->json('dataFEL')->nullable();
            // $table->timestamps();
            // $table->softDeletes();

            $table->id();
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->foreignId('manager_id')->constrained('manager_assignments')->cascadeOnUpdate();
            $table->unsignedBigInteger('store_code'); // Nuevo campo para almacenar storeCode
            $table->string('store_name'); // Nuevo campo para almacenar nameStore
            $table->string('store_direction')->nullable(); // Nuevo campo para almacenar direccion de locationStore
            $table->string('store_municipality')->nullable(); // Nuevo campo para almacenar municipio de locationStore
            $table->string('store_department')->nullable(); // Nuevo campo para almacenar departamento de locationStore
            $table->unsignedBigInteger('store_phone')->nullable(); // Nuevo campo para almacenar telefono de locationStore
            $table->boolean('status_active')->default(true); // Nuevo campo para almacenar statusActive
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('name');
            $table->index('store_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
        });
        Schema::dropIfExists('stores');
    }
};
