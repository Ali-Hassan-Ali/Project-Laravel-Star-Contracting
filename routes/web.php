<?php

use Illuminate\Support\Facades\Route;

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    
    Auth::routes();

    // Route::get('/', function () {

    //     return $dd = now()->addDays(1);

    //     dd($dd);
        
    // });


    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::get('/home', 'HomeController@index')->name('home');

});
