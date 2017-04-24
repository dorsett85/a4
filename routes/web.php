<?php


Route::get('/', 'ViewController@welcome');

Route::post('/post', 'ViewController@postCompany');



// Practice route
Route::get('/practice', 'PracticeController@practice');

Route::get('/practice2', 'PracticeController@practice2');


// Route to drop database
if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database companies');
        DB::statement('CREATE database companies');

        return 'Dropped companies; created companies.';
    });

};