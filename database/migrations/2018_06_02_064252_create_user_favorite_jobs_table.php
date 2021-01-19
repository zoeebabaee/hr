<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserFavoriteJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_favorite_jobs', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->nullable()->index('user_favorite_jobs_user_id_foreign');
			$table->integer('job_id')->unsigned()->nullable()->index('user_favorite_jobs_job_id_foreign');
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
		Schema::drop('user_favorite_jobs');
	}

}
