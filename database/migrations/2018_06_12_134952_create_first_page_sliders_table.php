<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFirstPageSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_page_sliders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('link');
			$table->string('image');
			$table->text('body', 65535);
			$table->timestamps();
			$table->boolean('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('first_page_sliders');
	}

}
