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

        Route::name('admin.home.')->prefix('admin/home')->group(function () {

            // reports Route
            Route::get('/top_statistics/tables', 'HomeController@topStatisticsTables')->name('top_statistics.tables');

            Route::get('ajax/eir_pending_approved', 'AjaxController@EirPendingApproved')->name('ajax.eir_pending_approved');
            Route::get('ajax/eir_in_transit', 'AjaxController@EirInTransit')->name('ajax.eir_in_transit');
            Route::get('ajax/equipment_vehicle', 'AjaxController@EquipmentVehicle')->name('ajax.equipment_vehicle');
            Route::get('ajax/equipment_rented', 'AjaxController@EquipmentRented')->name('ajax.equipment_rented');
            Route::get('ajax/equipment_barkdown', 'AjaxController@EquipmentBarkdown')->name('ajax.equipment_barkdown');


        });

    });
