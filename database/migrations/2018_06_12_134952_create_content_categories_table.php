<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('alias')->nullable();
			$table->text('body')->nullable();
			$table->boolean('status')->default(2);
			$table->string('layout')->default('general');
			$table->boolean('comment_enable')->default(1);
			$table->integer('parent_id')->unsigned()->nullable()->index('content_categories_parent_id_foreign');
			$table->integer('created_by')->unsigned()->index('content_categories_created_by_foreign');
			$table->integer('modified_by')->unsigned()->nullable()->index('content_categories_modified_by_foreign');
			$table->string('meta_description')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('image')->nullable()->default('/GolrangSystem-File-Manager/photos/1/default/noimage_blog.png');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_categories');
	}

}
