<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookIntroductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_introductions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('author');
			$table->string('book_name');
			$table->string('slug')->default('');
			$table->date('release_date')->nullable();
			$table->string('publication_name');
			$table->text('body');
			$table->string('img')->nullable();
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
		Schema::drop('book_introductions');
	}

}
