<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('galleries', function(Blueprint $table)
		{
			$table->foreign('cat_id')->references('id')->on('gallery_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'galleries_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('galleries', function(Blueprint $table)
		{
			$table->dropForeign('galleries_cat_id_foreign');
			$table->dropForeign('galleries_ibfk_1');
		});
	}

}
