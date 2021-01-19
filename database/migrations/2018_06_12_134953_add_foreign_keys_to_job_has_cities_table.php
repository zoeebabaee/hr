<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobHasCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_has_cities', function(Blueprint $table)
		{
			$table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('job_id')->references('id')->on('jobs')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_has_cities', function(Blueprint $table)
		{
			$table->dropForeign('job_has_cities_city_id_foreign');
			$table->dropForeign('job_has_cities_job_id_foreign');
		});
	}

}
