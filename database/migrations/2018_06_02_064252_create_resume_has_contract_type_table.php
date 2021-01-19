<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumeHasContractTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_has_contract_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resume_id')->unsigned()->nullable()->index('resume_has_contract_type_resume_id_foreign');
			$table->integer('contract_type_id')->unsigned()->nullable()->index('resume_has_contract_type_contract_type_id_foreign');
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
		Schema::drop('resume_has_contract_type');
	}

}
