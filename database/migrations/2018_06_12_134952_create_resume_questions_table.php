<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_questions_resume_id_foreign');
			$table->text('Q1', 65535);
			$table->text('Q2', 65535);
			$table->text('Q3', 65535);
			$table->text('Q4', 65535)->nullable();
			$table->timestamps();
			$table->integer('requested_salary');
			$table->boolean('crime')->default(0);
			$table->text('crime_description', 65535)->nullable();
			$table->boolean('sickness')->nullable();
			$table->text('sickness_description', 65535)->nullable();
			$table->boolean('treatment')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resume_questions');
	}

}
