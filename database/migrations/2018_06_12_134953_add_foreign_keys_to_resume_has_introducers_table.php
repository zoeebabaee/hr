<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeHasIntroducersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_has_introducers', function(Blueprint $table)
		{
			$table->foreign('introducer_id')->references('id')->on('introducers')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('resume_has_introducers', function(Blueprint $table)
		{
			$table->dropForeign('resume_has_introducers_introducer_id_foreign');
			$table->dropForeign('resume_has_introducers_resume_id_foreign');
		});
	}

}
