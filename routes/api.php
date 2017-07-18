<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Make routes like /api/v1/...
 */
Route::group(['prefix'=>'v1', 'namespace'=>'Api', 'middleware'=>'auth:api'], function() {

    // counties resource
    Route::resource('counties', 'CountyController', ['only'=> ['index', 'show']]);

    // locations resource
    Route::resource('locations', 'LocationController', ['only'=> ['index', 'show']]);

    /**
     * must be able to view applications
     */
    Route::group(['middleware'=>'can:view,application'], function() {

        // start application generating
        Route::get('/applications/{application}/generate/{type?}', 'ApplicationController@generate')
            ->where('type', 'docx|html|pdf');

        // delete application file
        Route::delete('/applications/{application}/delete/{application_file}', 'ApplicationController@delete_file');

        // application resource
        Route::resource('applications', 'ApplicationController', ['only' => ['index', 'show', 'update']]);
    });



}); // ^ all api calls should be above here ^
