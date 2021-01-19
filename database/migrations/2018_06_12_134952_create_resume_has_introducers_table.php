<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasIntroducersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_introducers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('introducer_id')->unsigned()->nullable()->index('resume_has_introducers_introducer_id_foreign');
			$table->integer('resume_id')->unsigned()->nullable()->index('resume_has_introducers_resume_id_foreign');
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
		Schema::drop('resume_has_introducers');
	}

}
