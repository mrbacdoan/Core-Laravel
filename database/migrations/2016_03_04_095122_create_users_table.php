<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users')){
            return false;
        }
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 64);
            $table->string('password', 60);
            $table->string('email', 255);
            $table->string('full_name', 128);
            $table->string('phone', 15)->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('address', 500)->nullable();
            $table->integer('group_id');
            $table->string('token', 100);
            $table->string('remember_token', 100);
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
        Schema::dropIfExists('users');
    }
}
