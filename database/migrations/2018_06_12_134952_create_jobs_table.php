<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->unsigned()->index('jobs_company_id_foreign');
			$table->string('title');
			$table->string('alias')->default('test');
			$table->dateTime('expire_date')->nullable();
			$table->boolean('approved');
			$table->integer('apply_limit')->nullable()->default(0)->comment('set zero for unlimited');
			$table->boolean('pin_status')->default(0);
			$table->integer('department_id')->unsigned()->index('jobs_department_id_foreign');
			$table->integer('created_by')->unsigned()->index('jobs_created_by_foreign');
			$table->integer('modified_by')->unsigned()->index('jobs_modified_by_foreign');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('post_id')->unsigned()->index('jobs_post_id_foreign');
			$table->string('general_merites');
			$table->string('professional_merites');
			$table->boolean('gender')->default(3);
			$table->integer('province_id')->unsigned()->nullable()->index('jobs_province_id_foreign');
			$table->integer('city_id')->unsigned()->nullable()->index('jobs_city_id_foreign');
			$table->integer('industry_id')->unsigned()->nullable()->index('jobs_industry_id_foreign');
			$table->integer('sort_order')->nullable();
			$table->boolean('min_education')->default(1);
			$table->text('goal_or_mission', 65535);
			$table->text('main_responsibilities', 65535);
			$table->text('job_other_features', 65535)->nullable();
			$table->boolean('status')->default(1)->comment('
            1-publish
            2-unPublish
            3-archived
            ');
			$table->string('LatLng');
			$table->integer('cooperation_type')->default(1);
			$table->integer('visit_count')->default(0);
			$table->string('jobExp')->nullable();
			$table->string('field')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
