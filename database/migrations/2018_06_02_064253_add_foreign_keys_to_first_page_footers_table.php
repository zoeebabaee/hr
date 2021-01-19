<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFirstPageFootersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('first_page_footers', function(Blueprint $table)
		{
			$table->foreign('content_id', 'first_page_footers_contact_id_foreign')->references('id')->on('contents')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('first_page_footers', function(Blueprint $table)
		{
			$table->dropForeign('first_page_footers_contact_id_foreign');
		});
	}

}
