<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    
    Auth::routes();

    Route::get('/test', function () {

        return ucwords('foo bar');
        
    });


    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::get('/home', 'HomeController@index')->name('home');

});
