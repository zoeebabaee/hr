<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGlobalFootersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('global_footers', function(Blueprint $table)
		{
			$table->foreign('content_id')->references('id')->on('contents')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('global_footers', function(Blueprint $table)
		{
			$table->dropForeign('global_footers_content_id_foreign');
		});
	}

}
