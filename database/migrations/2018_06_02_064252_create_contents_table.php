<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->boolean('status')->default(2)->comment('1-published 2-unpublished');
			$table->boolean('comment_status')->default(1)->comment('1-publish after admin accepts 2-publish all 3-disabled');
			$table->dateTime('start_publish')->nullable();
			$table->dateTime('end_publish')->nullable();
			$table->integer('cat_id')->unsigned()->index('contents_cat_id_foreign');
			$table->integer('created_by')->unsigned()->index('contents_created_by_foreign');
			$table->integer('modified_by')->unsigned()->nullable()->index('contents_modified_by_foreign');
			$table->string('meta_description')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->string('external_references')->nullable();
			$table->string('content_rights')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->boolean('label_active');
			$table->string('label_text')->nullable();
			$table->boolean('pin_status')->default(0);
			$table->string('main_image')->default('/GolrangSystem-File-Manager/photos/1/default/noimage_blog.png');
			$table->string('l_image', 50)->nullable();
			$table->string('xl_image', 50)->nullable();
			$table->string('xxl_image', 50)->nullable();
			$table->string('banner_image')->default('/GolrangSystem-File-Manager/photos/1/default/noimage_pin.png');
			$table->boolean('approved')->default(0);
			$table->text('reject_text', 65535);
			$table->string('alias')->nullable();
			$table->integer('visit_counter')->unsigned()->default(0);
			$table->integer('likes')->default(0);
			$table->integer('dislikes')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contents');
	}

}
