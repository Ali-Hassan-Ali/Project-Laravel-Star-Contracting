<?php

use Illuminate\Support\Facades\Route;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([
        // 'localeSessionRedirect',
        // 'localizationRedirect',
        // 'localeViewPath',
    ])
    ->group(function () {
         Auth::routes();

        Route::get('/', 'WelcomeController@index')->name('welcome');

        Route::get('/home', 'HomeController@index')->name('home');

       


    });
