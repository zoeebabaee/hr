<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galleries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('body', 65535);
			$table->string('img');
			$table->string('l_img', 50)->nullable();
			$table->string('link')->nullable();
			$table->boolean('approved')->default(0);
			$table->timestamps();
			$table->integer('cat_id')->unsigned()->index('galleries_cat_id_foreign');
			$table->integer('created_by')->unsigned()->nullable()->index('created_by');
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
		Schema::drop('galleries');
	}

}
