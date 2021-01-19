<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeHasExpExpertisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_has_exp_expertises', function(Blueprint $table)
		{
			$table->foreign('professional_merites_id')->references('id')->on('job_professional_merites')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('resume_has_exp_expertises', function(Blueprint $table)
		{
			$table->dropForeign('resume_has_exp_expertises_professional_merites_id_foreign');
			$table->dropForeign('resume_has_exp_expertises_resume_id_foreign');
		});
	}

}
