<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContentHasTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('content_has_tag', function(Blueprint $table)
		{
			$table->foreign('content_id')->references('id')->on('contents')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('content_has_tag', function(Blueprint $table)
		{
			$table->dropForeign('content_has_tag_content_id_foreign');
			$table->dropForeign('content_has_tag_tag_id_foreign');
		});
	}

}
