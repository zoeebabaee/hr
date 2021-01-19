<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->nullable()->unique();
			$table->string('mobile')->unique();
			$table->string('bio', 500)->nullable();
			$table->boolean('is_mobile_verified')->default(0);
			$table->boolean('is_email_verified')->default(0);
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('avatar')->default('/GolrangSystem-File-Manager/photos/1/default/noimage_profile.png');
			$table->boolean('status')->default(1);
			$table->string('cover')->default('/GolrangSystem-File-Manager/photos/1/default/noimage_cover.jpg');
			$table->string('cv')->default('');
			$table->boolean('complete_percent')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
