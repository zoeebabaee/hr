<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasComSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_com_skills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_has_com_skills_resume_id_foreign');
			$table->integer('professional_merites_id')->unsigned()->index('resume_has_com_skills_professional_merites_id_foreign');
			$table->boolean('proficiency');
			$table->boolean('has_certificate');
			$table->string('description')->nullable();
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
		Schema::drop('resume_has_com_skills');
	}

}
