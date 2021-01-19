<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('logo', 90)->default('/GolrangSystem-File-Manager/photos/1/default/59a66a4b94fb8.png');
			$table->string('name');
			$table->text('body', 65535)->nullable();
			$table->string('home_page_url');
			$table->timestamps();
			$table->string('address');
			$table->string('phone');
			$table->string('LatLng');
			$table->integer('company_id')->unsigned()->nullable()->index('companies_company_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
