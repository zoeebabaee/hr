<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasIndustriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_industries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->nullable()->index('resume_has_industries_resume_id_foreign');
			$table->integer('industry_id')->unsigned()->nullable()->index('resume_has_industries_industry_id_foreign');
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
		Schema::drop('resume_has_industries');
	}

}
