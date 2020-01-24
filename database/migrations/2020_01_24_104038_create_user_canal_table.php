<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCanalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_canal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('pseudo');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('fk_canal_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fk_canal_id')->references('canal_id')->on('canals');
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
        Schema::dropIfExists('user_canal');
    }
}
