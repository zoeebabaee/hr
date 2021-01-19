<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('status', array('user_reply','open','on_hold','in_progress','answered','closed'))->default('answered');
			$table->enum('priority', array('high','medium','low'))->nullable()->default('medium');
			$table->string('subject');
			$table->text('body', 65535);
			$table->integer('user_id')->unsigned()->nullable()->index('tickets_user_id_foreign')->comment('site user who is audience');
			$table->integer('company_id')->unsigned()->nullable()->index('tickets_company_id_foreign');
			$table->integer('created_by')->unsigned()->nullable()->index('tickets_created_by_foreign');
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
		Schema::drop('tickets');
	}

}
