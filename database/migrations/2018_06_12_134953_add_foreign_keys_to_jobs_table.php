<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('company_id')->references('id')->on('companies')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('department_id')->references('id')->on('job_departments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('industry_id')->references('id')->on('industries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('modified_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('post_id')->references('id')->on('job_posts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('province_id')->references('id')->on('provinces')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->dropForeign('jobs_city_id_foreign');
			$table->dropForeign('jobs_company_id_foreign');
			$table->dropForeign('jobs_created_by_foreign');
			$table->dropForeign('jobs_department_id_foreign');
			$table->dropForeign('jobs_industry_id_foreign');
			$table->dropForeign('jobs_modified_by_foreign');
			$table->dropForeign('jobs_post_id_foreign');
			$table->dropForeign('jobs_province_id_foreign');
		});
	}

}
