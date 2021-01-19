<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('comment', 65535);
			$table->integer('user_id')->unsigned()->nullable()->index('user_comments_user_id_foreign');
			$table->integer('admin_id')->unsigned()->nullable()->index('user_comments_admin_id_foreign');
			$table->integer('job_id')->unsigned()->nullable()->index('user_comments_job_id_foreign');
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
		Schema::drop('user_comments');
	}

}
