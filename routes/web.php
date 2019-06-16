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
    Route::put('/baixar/breeds', 'BreedController@create')->name('create.breed');
    Route::put('/baixar/fotos', 'ImgBreedController@create')->name('photos.breed');
    //Route::get('/salvarimagem', 'ImgBreedController@photos')->name('photos');
    Route::get('/buscar/{id_breed}', 'BreedController@search')->name('search');
});

