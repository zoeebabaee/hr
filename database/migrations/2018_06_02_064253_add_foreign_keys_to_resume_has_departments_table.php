<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeHasDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_has_departments', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('job_departments')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('resume_id')->references('id')->on('resumes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resume_has_departments', function(Blueprint $table)
		{
			$table->dropForeign('resume_has_departments_department_id_foreign');
			$table->dropForeign('resume_has_departments_resume_id_foreign');
		});
	}

}
