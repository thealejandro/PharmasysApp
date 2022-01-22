<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itemID')->unique();
            $table->unsignedBigInteger('codeBar')->unique();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories', 'categoryID')->cascadeOnUpdate();
            $table->foreignId('laboratory_id')->constrained('laboratories', 'laboratoryID')->cascadeOnUpdate();
            $table->boolean('generic')->default(FALSE);
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
        Schema::table('items', function (Blueprint $tab) {
            $tab->dropForeign(['category_id']);
            $tab->dropForeign(['laboratory_id']);
        });
        Schema::dropIfExists('items');
    }
}
