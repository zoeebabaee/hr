<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobHasGeneralMeritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_has_general_merites', function(Blueprint $table)
		{
			$table->foreign('general_merites_id')->references('id')->on('job_general_merites')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('job_id')->references('id')->on('jobs')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_has_general_merites', function(Blueprint $table)
		{
			$table->dropForeign('job_has_general_merites_general_merites_id_foreign');
			$table->dropForeign('job_has_general_merites_job_id_foreign');
		});
	}

}
