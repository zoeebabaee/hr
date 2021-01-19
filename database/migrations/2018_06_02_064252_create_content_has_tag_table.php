<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentHasTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_has_tag', function(Blueprint $table)
		{
			$table->integer('tag_id')->unsigned()->nullable()->index('content_has_tag_tag_id_foreign');
			$table->integer('content_id')->unsigned()->nullable()->index('content_has_tag_content_id_foreign');
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
		Schema::drop('content_has_tag');
	}

}
