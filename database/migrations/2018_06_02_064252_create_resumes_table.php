<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('resumes_user_id_foreign');
			$table->timestamps();
			$table->integer('province_id')->unsigned()->index('resumes_province_id_foreign');
			$table->integer('introducer_id')->unsigned()->nullable()->index('resumes_introducer_id_foreign');
			$table->boolean('referer')->comment('
            1-newsletter
            2-site
            3-with an introducer
            4-job agency
            5-introduce by employees
            6-call from golrang
            ');
			$table->string('other')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resumes');
	}

}
