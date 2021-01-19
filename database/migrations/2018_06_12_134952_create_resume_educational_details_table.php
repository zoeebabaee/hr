<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeEducationalDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_educational_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->index('resume_educational_details_resume_id_foreign');
			$table->boolean('grade')->nullable()->comment('            1-دیپلم            2-کاردانی            3-کارشناسی            4-کارشناسی ارشد            5-کارشناسی ارشد پیوسته            6-دکترا            7-دکترا پیوسته            ');
			$table->string('field')->nullable();
			$table->string('tendency')->nullable();
			$table->string('institute')->nullable();
			$table->boolean('institute_structure')->nullable();
			$table->boolean('course_type')->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->float('average', 4)->nullable();
			$table->timestamps();
			$table->string('city')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resume_educational_details');
	}

}
