<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeForeignLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_foreign_languages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_foreign_languages_resume_id_foreign');
			$table->string('title');
			$table->boolean('conversation');
			$table->boolean('writing');
			$table->boolean('comprehension');
			$table->string('certificate')->nullable();
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
		Schema::drop('resume_foreign_languages');
	}

}
