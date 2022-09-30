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

            // spares_avai*lable Route
            Route::get('spares_available', 'AparesAvailableController@index')->name('spares_available');
            Route::get('spares_available/data', 'AparesAvailableController@data')->name('spares_available.data');

            // spares_used
            Route::get('spares_used', 'AparesUsedController@index')->name('spares_used');
            Route::get('spares_used/data', 'AparesUsedController@data')->name('spares_used.data');

            // breakdown_overview
            Route::get('breakdown_overview', 'BreakdownOverviewController@index')->name('breakdown_overview');
            Route::get('breakdown_overview/data', 'BreakdownOverviewController@data')->name('breakdown_overview.data');

        });//end of group

    });//end of Route middleware