<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('body');
            $table->integer('user_id')->unsigned()->nullable()->index('tickets_user_id_foreign')->comment('site user who is audience');
            $table->integer('company_id')->unsigned()->nullable()->index('tickets_company_id_foreign');
            $table->integer('created_by')->unsigned()->nullable()->index('tickets_created_by_foreign');

            # Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('RESTRICT')->onDelete('SET NULL');

            # Timestamps
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
        Schema::dropIfExists('tickets');
    }
}
