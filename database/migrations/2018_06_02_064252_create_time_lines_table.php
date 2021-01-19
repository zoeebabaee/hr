<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimeLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_lines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('img')->nullable();
			$table->string('icon');
			$table->text('body', 65535);
			$table->date('when');
			$table->string('ref');
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
		Schema::drop('time_lines');
	}

}
