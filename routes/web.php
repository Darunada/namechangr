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
 * The heart of the site
 */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/start', 'DashboardController@start')->name('start');
Route::post('/dashboard/start', 'DashboardController@spawnApplication');

/**
 * User authentication
 */
Auth::routes();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->name('redirect_to_provider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('auth/{provider}/deauthorize', 'Auth\AuthController@handleDeauthorizeCallback');

/**
 * If a user makes a profile these will be available
 */
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update');
Route::delete('/profile', 'ProfileController@delete');

/**
 * State routes
 */
Route::get('/UT/instructions', function() {
    $file = resource_path('templates/ut/instructions.pdf');
    return response()->file($file);
})->name('states.UT.instructions');

Route::get('/UT/cover_sheet', function() {
    $file = resource_path('templates/ut/cover-sheet.pdf');
    return response()->file($file);
})->name('states.UT.cover_sheet');

Route::post('/UT/generate/{application}', 'States\UtController@generate')->name('states.UT.generate')->middleware('can:update,application');
Route::get('/UT/{application}', 'States\UtController@index')->name('states.UT')->middleware('can:view,application');
Route::post('/UT/{application}', 'States\UtController@save')->name('states.UT.save')->middleware('can:update,application');
Route::get('/UT/{application}/download/{application_file}', 'States\UtController@download_file')->name('states.UT.download')->middleware('can:view,application');
Route::delete('/UT/{application}/delete/{application_file}', 'States\UtController@delete_file')->name('states.UT.delete')->middleware('can:view,application');
