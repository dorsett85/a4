<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('company', 'App\Http\Controllers\StockController@validateCompany');
        Validator::extend('duplicate', 'App\Http\Controllers\StockController@duplicateCompany');
        \Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
