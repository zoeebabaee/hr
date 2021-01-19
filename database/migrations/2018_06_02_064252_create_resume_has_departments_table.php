<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_departments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->nullable()->index('resume_has_departments_resume_id_foreign');
			$table->integer('department_id')->unsigned()->nullable()->index('resume_has_departments_department_id_foreign');
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
		Schema::drop('resume_has_departments');
	}

}
