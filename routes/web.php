<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Front/home page things
 */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');
Route::get('/terms', 'HomeController@terms')->name('terms');

/**
 * User authentication
 */
Auth::routes();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->name('redirect_to_provider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('auth/{provider}/deauthorize', 'Auth\AuthController@handleDeauthorizeCallback');

/**
 * Other Public Pages
 */
Route::get('/UT', 'States\UtController@index')->name('states.UT');

/**
 * User Must Log In For These
 */
Route::group(['middleware' => 'auth'], function () {
    /**
     * The heart of the site
     */
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/start', 'DashboardController@start')->name('start');
    Route::post('/dashboard/start', 'DashboardController@spawnApplication');


    /**
     * User Profile Page
     */
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@update');
    Route::delete('/profile', 'ProfileController@delete');

    /**
     * UT routes
     */


    // must be able to view applications
    Route::group(['middleware' => 'can:view,application'], function () {
        // instructions document
        Route::get('/UT/instructions', 'States\UtController@instructions')
            ->name('states.UT.instructions');

        // cover sheet document
        Route::get('/UT/cover-sheet', 'States\UtController@coverSheet')
            ->name('states.UT.cover_sheet');

        // view application
        Route::get('/UT/{application}', 'States\UtController@application')
            ->name('states.UT');

        // download application files
        Route::get('/UT/{application}/download/{application_file}', 'States\UtController@download_file')
            ->name('states.UT.download');
    });
}); // end of user must be logged in
