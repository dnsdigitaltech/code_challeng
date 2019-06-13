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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::fallback(function () {
        return redirect()->route('home')->with('error', "☹ 404 - Esta página não foi encontrada");
    });

    Route::get('/home', 'BreedController@index')->name('home');
});

