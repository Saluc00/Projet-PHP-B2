<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->unsignedBigInteger('fk_profile_id');
            $table->foreign('fk_profile_id')->references('id')->on('profile'); 
            $table->unsignedBigInteger('fk_canal_id');
            $table->foreign('fk_canal_id')->references('id')->on('canal');            
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
