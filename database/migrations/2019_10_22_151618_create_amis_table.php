<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_profile_id');
            $table->foreign('fk_profile_id')->references('id')->on('profile');
            $table->unsignedBigInteger('fk_profile_amis_id');
            $table->foreign('fk_profile_amis_id')->references('id')->on('profile');
            $table->timestamps('date_ajout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amis');
    }
}
