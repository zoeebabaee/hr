<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->nullable();
			$table->integer('visitCount')->default(0);
			$table->integer('gallery_id')->unsigned()->index('videos_gallery_id_foreign');
			$table->text('body', 65535);
			$table->string('video', 500);
			$table->string('avatar');
			$table->timestamps();
			$table->integer('sort_order')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('videos');
	}

}
