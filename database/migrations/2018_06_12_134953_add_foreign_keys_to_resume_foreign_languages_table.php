<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeForeignLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_foreign_languages', function(Blueprint $table)
		{
			$table->foreign('resume_id')->references('id')->on('resumes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resume_foreign_languages', function(Blueprint $table)
		{
			$table->dropForeign('resume_foreign_languages_resume_id_foreign');
		});
	}

}
