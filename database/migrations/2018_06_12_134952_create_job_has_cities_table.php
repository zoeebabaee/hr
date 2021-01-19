<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobHasCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_has_cities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->unsigned()->nullable()->index('job_has_cities_job_id_foreign');
			$table->integer('city_id')->unsigned()->nullable()->index('job_has_cities_city_id_foreign');
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
		Schema::drop('job_has_cities');
	}

}
