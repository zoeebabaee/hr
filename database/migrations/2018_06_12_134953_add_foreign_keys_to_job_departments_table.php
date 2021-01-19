<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_departments', function(Blueprint $table)
		{
			$table->foreign('parent_id')->references('id')->on('job_departments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_departments', function(Blueprint $table)
		{
			$table->dropForeign('job_departments_parent_id_foreign');
		});
	}

}
