<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('categories')){
            return false;
        }
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->tinyInteger('priority');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('categories');
    }
}
