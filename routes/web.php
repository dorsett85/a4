<?php

/*
 * Landing and login routes
 */
Route::get('/', 'ViewController@landing');

Auth::routes();

/*
 * Routes after login
 */

Route::get('/guest', 'ViewController@guest');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'ViewController@welcome');

    Route::get('/search', 'ViewController@search');
    Route::post('/search', 'ViewController@searchResults');
    Route::post('/add', 'ViewController@saveFavorite');

    Route::get('/favorites', 'ViewController@showFavorites');
    Route::post('/favorites', 'ViewController@removeCompany');

    Route::get('/data/{ticker}', 'ViewController@selectData');

    Route::post('/tags', 'ViewController@updateTags');

});

// Practice route
Route::get('/practice', 'practiceController@practice');




