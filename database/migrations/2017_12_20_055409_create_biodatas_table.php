<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('gender')->default('-');
            $table->string('cp')->default('-');
            $table->string('date_of_birth')->default('-');
            $table->string('province')->default('-');
            $table->string('regency')->default('-');
            $table->string('district')->default('-');
            $table->string('village')->default('-');
            $table->string('home_address')->default('-');
            $table->string('last_education')->default('-');
            $table->string('profession')->default('-');
            $table->string('skill')->default('-');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
}
