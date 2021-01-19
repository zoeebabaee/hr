<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResumeHasContractTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resume_has_contract_type', function(Blueprint $table)
		{
			$table->foreign('contract_type_id')->references('id')->on('resume_contract_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('resume_id')->references('id')->on('resumes')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resume_has_contract_type', function(Blueprint $table)
		{
			$table->dropForeign('resume_has_contract_type_contract_type_id_foreign');
			$table->dropForeign('resume_has_contract_type_resume_id_foreign');
		});
	}

}
