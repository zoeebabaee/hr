<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ticket_replies', function(Blueprint $table)
		{
			$table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('RESTRICT')->onDelete('SET NULL');
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
		Schema::table('ticket_replies', function(Blueprint $table)
		{
			$table->dropForeign('ticket_replies_ticket_id_foreign');
			$table->dropForeign('ticket_replies_user_id_foreign');
		});
	}

}
