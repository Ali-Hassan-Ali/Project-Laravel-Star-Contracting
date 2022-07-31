<?php

use Illuminate\Support\Facades\Route;

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    
    Auth::routes();

    Route::get('/test', function () {

        dd(date('d-m-Y', strtotime(now()) ) );
        
    });


    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::get('/home', 'HomeController@index')->name('home');

});
