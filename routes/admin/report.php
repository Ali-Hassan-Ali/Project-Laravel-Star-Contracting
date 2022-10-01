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

            // material_delivery_time
            Route::get('material_delivery_time', 'MaterialDeliveryTimeController@index')->name('material_delivery_time');
            Route::get('material_delivery_time/data', 'MaterialDeliveryTimeController@data')->name('material_delivery_time.data');

            // fuel_consumption
            Route::get('total_fuel_consumption', 'FuelConsumptionController@index')->name('total_fuel_consumption');
            Route::get('total_fuel_consumption/data', 'FuelConsumptionController@data')->name('total_fuel_consumption.data');

            // equipment_expenditure
            Route::get('total_equipment_expenditure', 'EquipmentExpenditureController@index')->name('total_equipment_expenditure');
            Route::get('total_equipment_expenditure/data', 'EquipmentExpenditureController@data')->name('total_equipment_expenditure.data');

            // equipment_expenditure
            Route::get('expenditure_per_KM', 'ExpenditurePerKMController@index')->name('expenditure_per_KM');
            Route::get('expenditure_per_KM/data', 'ExpenditurePerKMController@data')->name('expenditure_per_KM.data');

            // equipment_expenditure
            Route::get('eir_overview', 'EirOverviewController@index')->name('eir_overview');
            Route::get('eir_overview/data', 'EirOverviewController@data')->name('eir_overview.data');

        });//end of group

    });//end of Route middleware