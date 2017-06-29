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
Route::group(['prefix'=>'v1', 'namespace'=>'Api', /*'middleware'=>'auth:api'*/], function() {

    Route::resource('states', 'StateController', ['only'=> ['index', 'show']]);
    Route::resource('states.counties', 'StateCountyController', ['only'=> ['index', 'show']]);
    Route::resource('states.districts', 'StateDistrictController', ['only'=> ['index', 'show']]);
    Route::resource('states.locations', 'StateLocationController', ['only'=> ['index', 'show']]);

});
