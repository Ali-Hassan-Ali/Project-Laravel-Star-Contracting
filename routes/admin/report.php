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

        Route::name('admin.reports.')->prefix('admin/report')->group(function () {

            // spares_available Route
            Route::get('spares_available', 'AparesAvailableController@index')->name('spares_available');
            Route::get('spares_available/data', 'AparesAvailableController@data')->name('spares_available.data');

            Route::get('spares_used', 'AparesUsedController@index')->name('reports.spares_used');
            Route::get('spares_used/data', 'AparesUsedController@data')->name('spares_used.data');

        });//end of group

    });//end of Route middleware