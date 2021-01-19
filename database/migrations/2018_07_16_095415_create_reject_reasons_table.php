<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRejectReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason')->size('256');
            $table->unsignedInteger('created_by')->size('11');
            $table->unsignedInteger('modified_by')->size('11');
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
        Schema::dropIfExists('reject_reasons');
    }
}
