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

            // fuel_consumption Route
            Route::get('fuel_consumption', 'FuelConsumptionController@index')->name('fuel_consumption.index');

            Route::get('fuel_consumption/data', 'FuelConsumptionController@Chart')->name('fuel_consumption.chart');

            // equipment_expenditure Route
            Route::get('equipment_expenditure', 'EquipmentExpenditureController@index')->name('equipment_expenditure.index');

            Route::get('equipment_expenditure/data', 'EquipmentExpenditureController@Chart')->name('equipment_expenditure.chart');

            // average_expenditure Route
            Route::get('average_expenditure', 'AverageExpenditureController@index')->name('average_expenditure.index');

            Route::get('average_expenditure/data', 'AverageExpenditureController@Chart')->name('average_expenditure.chart');

        });

    });
