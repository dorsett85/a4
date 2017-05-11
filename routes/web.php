<?php


Route::get('/', 'ViewController@welcome');

Route::get('/search', 'ViewController@search');
Route::post('/search', 'ViewController@searchResults');
Route::post('/add', 'ViewController@saveFavorite');

Route::get('/favorites', 'ViewController@showFavorites');
Route::post('/favorites', 'ViewController@removeCompany');

Route::any('/data', 'ViewController@selectData');
Route::get('/data/{switchTicker}', 'ViewController@switchCompany');

Route::post('/tags', 'ViewController@updateTags');


// Practice route
Route::get('/practice', 'practiceController@practice');


// Route to drop database
if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database companies');
        DB::statement('CREATE database companies');

        return 'Dropped companies; created companies.';
    });

};