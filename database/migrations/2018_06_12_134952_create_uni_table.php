<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uni', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->integer('student_id')->unsigned();
			$table->string('mobile', 15);
			$table->string('email', 256);
			$table->text('interests', 65535);
			$table->string('cv', 256)->nullable();
			$table->boolean('wantRegister')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('uni');
	}

}
