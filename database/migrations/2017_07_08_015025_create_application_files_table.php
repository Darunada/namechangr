<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('application_id')->unsigned()->nullable();
            $table->string('channel')->nullable();
            $table->string('path');
            $table->string('type');

            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('expired_at')->nullable();
        });

        Schema::table('application_files', function (Blueprint $table) {
            // index for fast searches for the different searches we might do
            $table->index('user_id');
            $table->index('application_id');
            $table->index('channel');
            $table->index(['user_id', 'application_id']);

            // set them null, a worker can clean up files from storage later?
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_files');
    }
}
