<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasPTRTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_p_t_r', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_has_p_t_r_resume_id_foreign');
			$table->integer('professional_merites_id')->unsigned()->index('resume_has_p_t_r_professional_merites_id_foreign');
			$table->integer('duration');
			$table->boolean('has_certificate');
			$table->integer('finish_year');
			$table->string('institute_name');
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
		Schema::drop('resume_has_p_t_r');
	}

}
