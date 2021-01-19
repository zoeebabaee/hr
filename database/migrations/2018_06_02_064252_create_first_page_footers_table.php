<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFirstPageFootersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_page_footers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('central_office', 65535);
			$table->text('contact_us', 65535);
			$table->text('work_time', 65535);
			$table->text('links', 65535);
			$table->integer('content_id')->unsigned()->nullable()->index('first_page_footers_contact_id_foreign');
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
		Schema::drop('first_page_footers');
	}

}
