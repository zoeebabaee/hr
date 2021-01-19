<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sender')->unsigned()->index('messages_sender_foreign');
			$table->integer('receiver')->unsigned()->index('messages_receiver_foreign');
			$table->string('subject');
			$table->text('body');
			$table->string('attachment')->nullable();
			$table->string('ref', 20)->nullable();
			$table->integer('ref_id')->unsigned()->nullable();
			$table->dateTime('read_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}
