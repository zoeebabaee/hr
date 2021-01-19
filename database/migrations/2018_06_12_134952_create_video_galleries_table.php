<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideoGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_galleries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('icon', 50)->default('fa-video-camera');
			$table->string('name');
			$table->timestamps();
			$table->integer('parent_id')->unsigned()->nullable()->index('video_galleries_parent_id_foreign');
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
		Schema::drop('video_galleries');
	}

}
