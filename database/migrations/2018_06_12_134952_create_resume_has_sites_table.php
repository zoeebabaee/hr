<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_sites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->nullable()->index('resume_has_sites_resume_id_foreign');
			$table->integer('site_id')->unsigned()->nullable()->index('resume_has_sites_site_id_foreign');
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
		Schema::drop('resume_has_sites');
	}

}
