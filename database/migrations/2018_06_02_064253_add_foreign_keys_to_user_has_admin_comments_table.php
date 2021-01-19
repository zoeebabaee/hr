<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasAdminCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_admin_comments', function(Blueprint $table)
		{
			$table->foreign('admin_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_admin_comments', function(Blueprint $table)
		{
			$table->dropForeign('user_has_admin_comments_admin_id_foreign');
			$table->dropForeign('user_has_admin_comments_user_id_foreign');
		});
	}

}
