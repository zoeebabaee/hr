<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobHasProfessionalMeritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_has_professional_merites', function(Blueprint $table)
		{
			$table->foreign('job_id')->references('id')->on('jobs')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('professional_merites_id')->references('id')->on('job_professional_merites')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_has_professional_merites', function(Blueprint $table)
		{
			$table->dropForeign('job_has_professional_merites_job_id_foreign');
			$table->dropForeign('job_has_professional_merites_professional_merites_id_foreign');
		});
	}

}
