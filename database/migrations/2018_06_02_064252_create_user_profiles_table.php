<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_profiles_user_id_foreign');
			$table->timestamps();
			$table->string('national_code');
			$table->boolean('gender');
			$table->date('born_date');
			$table->boolean('marital_status');
			$table->date('marriage_date')->nullable();
			$table->boolean('military_status')->nullable();
			$table->boolean('reason_exemption')->nullable();
			$table->date('military_end_date')->nullable();
			$table->integer('province_id')->unsigned()->index('user_profiles_province_id_foreign');
			$table->integer('city_id')->unsigned()->index('user_profiles_city_id_foreign');
			$table->string('neighborhood')->nullable();
			$table->string('home_phone');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_profiles');
	}

}
