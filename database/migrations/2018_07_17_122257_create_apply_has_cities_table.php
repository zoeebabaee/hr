<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyHasCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_has_cities', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('apply_id')->unsigned()->nullable()->index('apply_has_cities_apply_id_foreign');
            $table->foreign('apply_id')->references('id')->on('applies')->onUpdate('RESTRICT')->onDelete('SET NULL');

            $table->integer('city_id')->unsigned()->nullable()->index('apply_has_cities_city_id_foreign');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('SET NULL');

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
        //
    }
}
