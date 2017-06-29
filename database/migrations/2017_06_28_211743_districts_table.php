<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function($table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned()->index();
            $table->string('name', 255);
            $table->softDeletes();
        });

        Schema::table('districts', function ($table) {
            $table->foreign('state_id')->references('id')->on('states');
        });

        Schema::create('district_counties', function($table) {
            $table->integer('county_id')->unsigned();
            $table->integer('district_id')->unsigned();

            $table->primary(['district_id', 'county_id']);
        });

        Schema::table('district_counties', function($table) {
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('district_counties');
        Schema::drop('districts');
    }
}
