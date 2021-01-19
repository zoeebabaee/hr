<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContentGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('content_groups', function(Blueprint $table)
		{
			$table->foreign('cat_id')->references('id')->on('content_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('content_groups', function(Blueprint $table)
		{
			$table->dropForeign('content_groups_cat_id_foreign');
		});
	}

}
