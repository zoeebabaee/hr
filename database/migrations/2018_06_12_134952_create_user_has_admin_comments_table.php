<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasAdminCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_admin_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('admin_id')->unsigned()->nullable()->index('user_has_admin_comments_admin_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('user_has_admin_comments_user_id_foreign');
			$table->text('message', 65535);
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
		Schema::drop('user_has_admin_comments');
	}

}
