<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeWorkExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_work_experiences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_work_experiences_resume_id_foreign');
			$table->string('title');
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->string('last_post');
			$table->string('last_given_salary')->nullable();
			$table->text('cause_interruption', 65535);
			$table->string('phone_number');
			$table->text('important_tasks', 65535);
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
		Schema::drop('resume_work_experiences');
	}

}
