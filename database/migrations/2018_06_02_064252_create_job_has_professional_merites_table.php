<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobHasProfessionalMeritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_has_professional_merites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->unsigned()->nullable()->index('job_has_professional_merites_job_id_foreign');
			$table->integer('professional_merites_id')->unsigned()->nullable()->index('job_has_professional_merites_professional_merites_id_foreign');
			$table->integer('value')->nullable()->default(4);
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
		Schema::drop('job_has_professional_merites');
	}

}
