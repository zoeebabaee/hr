<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContentsHasGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contents_has_groups', function(Blueprint $table)
		{
			$table->foreign('content_id')->references('id')->on('contents')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('group_id')->references('id')->on('content_groups')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contents_has_groups', function(Blueprint $table)
		{
			$table->dropForeign('contents_has_groups_content_id_foreign');
			$table->dropForeign('contents_has_groups_group_id_foreign');
		});
	}

}
