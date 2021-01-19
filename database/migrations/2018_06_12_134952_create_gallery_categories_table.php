<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleryCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('created_by')->unsigned()->nullable()->index('gallery_categories_user_id_foreign');
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
		Schema::drop('gallery_categories');
	}

}
