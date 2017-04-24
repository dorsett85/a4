<?php


Route::get('/', 'ViewController@welcome');

Route::post('/post', 'ViewController@getstock');



// Practice route
Route::get('/practice', 'PracticeController@practice');

// Route to drop database
if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database companies');
        DB::statement('CREATE database companies');

        return 'Dropped companies; created companies.';
    });

};