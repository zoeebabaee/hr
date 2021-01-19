<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBooksHasTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('books_has_tags', function(Blueprint $table)
		{
			$table->foreign('book_introduction_id')->references('id')->on('book_introductions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('tag_id')->references('id')->on('tags')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('books_has_tags', function(Blueprint $table)
		{
			$table->dropForeign('books_has_tags_book_introduction_id_foreign');
			$table->dropForeign('books_has_tags_tag_id_foreign');
		});
	}

}
