<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksHasTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books_has_tags', function(Blueprint $table)
		{
			$table->integer('tag_id')->unsigned()->nullable()->index('books_has_tags_tag_id_foreign');
			$table->integer('book_introduction_id')->unsigned()->nullable()->index('books_has_tags_book_introduction_id_foreign');
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
		Schema::drop('books_has_tags');
	}

}
