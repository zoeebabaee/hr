<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeHasIndustriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_has_industries', function(Blueprint $table)
		{
			$table->foreign('industry_id')->references('id')->on('industries')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('resume_has_industries', function(Blueprint $table)
		{
			$table->dropForeign('resume_has_industries_industry_id_foreign');
			$table->dropForeign('resume_has_industries_resume_id_foreign');
		});
	}

}
