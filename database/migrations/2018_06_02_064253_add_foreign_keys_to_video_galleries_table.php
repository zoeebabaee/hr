<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVideoGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('video_galleries', function(Blueprint $table)
		{
			$table->foreign('parent_id')->references('id')->on('video_galleries')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('video_galleries', function(Blueprint $table)
		{
			$table->dropForeign('video_galleries_parent_id_foreign');
		});
	}

}
