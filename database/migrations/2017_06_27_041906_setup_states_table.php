<?php

use Illuminate\Database\Migrations\Migration;

class SetupStatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the users table
        Schema::create(Config::get('states.table_name'), function ($table) {
            $table->increments('id')->index();
            $table->char('iso_3166_2', 2)->default('');
            $table->string('name', 255)->default('');
            $table->string('country_code')->default('US');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop(Config::get('states.table_name'));
    }

}
