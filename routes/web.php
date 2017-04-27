<?php


Route::get('/', 'ViewController@welcome');

Route::get('/favorites', 'ViewController@showFavorites');

Route::get('/data', 'ViewController@selectData');
Route::post('/data', 'ViewController@dataResults');

Route::get('/search', 'ViewController@search');
Route::post('/search', 'ViewController@searchResults');

Route::post('/add', 'ViewController@saveFavorite');


// Practice route
Route::get('/practice', 'StockController@test');


// Route to drop database
if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database companies');
        DB::statement('CREATE database companies');

        return 'Dropped companies; created companies.';
    });

};