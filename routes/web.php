<?php


Route::get('/', 'ViewController@welcome');

Route::get('/search', 'ViewController@search');
Route::post('/search', 'ViewController@searchResults');
Route::post('/add', 'ViewController@saveFavorite');

Route::get('/favorites', 'ViewController@showFavorites');
Route::post('/remove', 'ViewController@removeCompany');

Route::get('/data', 'ViewController@selectData');
Route::post('/data', 'ViewController@dataResults');


// Practice route
Route::get('/practice', 'StockController@dataSelect');


// Route to drop database
if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database companies');
        DB::statement('CREATE database companies');

        return 'Dropped companies; created companies.';
    });

};