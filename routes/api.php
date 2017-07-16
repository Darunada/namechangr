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

    Route::resource('counties', 'CountyController', ['only'=> ['index', 'show']]);
    Route::resource('locations', 'LocationController', ['only'=> ['index', 'show']]);



    Route::get('/applications/{application}/generate/{type?}', 'ApplicationController@generate')
        ->where('type', 'docx|html|pdf');
    Route::delete('/applications/{application}/delete/{application_file}', 'ApplicationController@delete_file');
    Route::resource('applications', 'ApplicationController', ['only'=>['index', 'show', 'update']]);


});
