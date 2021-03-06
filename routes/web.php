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
    Route::any('/breeds', 'BreedController@breeds')->name('breeds');
    Route::put('/baixar/breeds', 'BreedController@create')->name('create.breed');
    Route::put('/baixar/fotos', 'ImgBreedController@create')->name('photos.breed');
    Route::any('/buscar/home', 'BreedController@searchHome')->name('search.home');
    Route::post('/buscar/', 'BreedController@searchTwo')->name('searchTwo');
    Route::get('/buscar/{id_breed}', 'BreedController@search')->name('search');
    Route::get('/db-habilitado', 'BreedController@status')->name('status.db');
    Route::get('/api-habilitado', 'BreedController@status')->name('status.api');
});

