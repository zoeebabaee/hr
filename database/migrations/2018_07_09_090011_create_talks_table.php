<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('from')->unsigned()->nullable();
            $table->foreign('from')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->integer('to')->unsigned()->nullable();
            $table->foreign('to')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->text('msg');

            $table->enum('type', array('txt', 'img', 'audio', 'video', 'file'))->nullable()->default('txt');


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
        Schema::dropIfExists('talks');
    }
}
