<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CountiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the counties table
        Schema::create('counties', function($table)
        {
            /** @var $table Blueprint */
            $table->increments('id');
            $table->integer('state_id')->unsigned()->index();
            $table->string('name', 255);
            $table->softDeletes();
        });

        Schema::table('counties', function ($table) {
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counties');
    }
}
