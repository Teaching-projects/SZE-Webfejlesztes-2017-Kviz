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

Route::get('/', 'Main@index');
Route::get('ranglista', 'Main@scoreboard');

//Ha be van jelentkezve akkor az indexre irányít
Route::group(['middleware' => ['guest']], function () {
    Route::get('bejelentkezes', 'Main@login')->name('login'); //Named Routes a bejelentkezés miatt => https://laravel.com/docs/5.5/routing#named-routes
    Route::post('bejelentkezes', 'Main@processLogin');
    Route::get('regisztracio', 'Main@registration');
    Route::post('regisztracio', 'Main@processRegistration');
});

//Ha nincs bejelentkezve akkor a bejelentkezésre irányít
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['gameend']], function () {
        Route::get('jatek', 'Main@game');
        Route::get('keredes','Game@getQuestion');
        Route::post('valasz','Game@processAnswer');
        Route::get('ranglistara','Scoreboard@add');
    });

    Route::get('kijelentkezes', 'Main@logout');
});