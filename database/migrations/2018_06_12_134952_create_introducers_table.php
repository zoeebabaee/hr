<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntroducersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('introducers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('company_name')->default('');
			$table->string('relevance')->default('');
			$table->string('post')->default('');
			$table->timestamps();
			$table->boolean('ashna');
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('introducers');
	}

}
