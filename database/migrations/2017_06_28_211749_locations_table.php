<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function ($table) {
            $table->increments('id')->index();
            $table->integer('district_id')->unsigned();
            $table->integer('county_id')->unsigned();
            $table->string('address', '255');
            $table->softDeletes();
        });

        Schema::table('locations', function ($table) {
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
