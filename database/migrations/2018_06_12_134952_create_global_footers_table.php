<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlobalFootersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('global_footers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('central_office', 65535);
			$table->text('contact_us', 65535);
			$table->text('links', 65535);
			$table->integer('content_id')->unsigned()->nullable()->index('global_footers_content_id_foreign');
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
		Schema::drop('global_footers');
	}

}
