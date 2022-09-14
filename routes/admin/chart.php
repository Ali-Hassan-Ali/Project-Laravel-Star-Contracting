<?php
use Illuminate\Support\Facades\Route;

Route::middleware([
    // 'localeSessionRedirect',
    // 'localizationRedirect',
    // 'localeViewPath',
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.chart.')->prefix('admin/chart')->group(function () {

            // reports Route
            Route::get('fuel_consumption', 'FuelConsumptionController@index')->name('fuel_consumption.index');

            Route::get('fuel_consumption/data', 'FuelConsumptionController@Chart')->name('fuel_consumption.chart');

        });

    });
