<?php

Route::middleware([
    // 'localeSessionRedirect',
    // 'localizationRedirect',
    // 'localeViewPath',
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
           
            Route::get('/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
            Route::get('/home', 'HomeController@index')->name('home');

            Route::get('/equipment_chart', 'StatisticsController@equipmentChart')->name('equipment.chart');
            Route::get('/specs_chart', 'StatisticsController@specsChart')->name('specs.chart');
            Route::get('/spares_chart', 'StatisticsController@sparesChart')->name('spares.chart');
            Route::get('/fuels_chart', 'StatisticsController@fuelsChart')->name('fuels.chart');
            Route::get('/eirs_chart', 'StatisticsController@eirsChart')->name('eirs.chart');
            Route::get('/insurances_chart', 'StatisticsController@insurancesChart')->name('insurances.chart');
            Route::get('/maintenances_chart', 'StatisticsController@maintenancesChart')->name('maintenances.chart');

            Route::get('/statistics_chart', 'StatisticsController@chart')->name('statistics.chart');
            Route::get('/statistics_table', 'StatisticsController@table')->name('statistics.table');

            //combo boxs routes
            Route::get('/combo_boxs/data', 'ComboBoxController@data')->name('combo_boxs.data');
            Route::delete('/combo_boxs/bulk_delete', 'ComboBoxController@bulkDelete')->name('combo_boxs.bulk_delete');
            Route::resource('combo_boxs', 'ComboBoxController');

            //role routes
            Route::get('/roles/data', 'RoleController@data')->name('roles.data');
            Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
            Route::resource('roles', 'RoleController');

            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::resource('users', 'UserController');

            //country routes
            Route::get('/countrys/data', 'CountryController@data')->name('countrys.data');
            Route::delete('/countrys/bulk_delete', 'CountryController@bulkDelete')->name('countrys.bulk_delete');
            Route::resource('countrys', 'CountryController');

            //citys routes
            Route::get('/citys/data', 'CityController@data')->name('citys.data');
            Route::delete('/citys/bulk_delete', 'CityController@bulkDelete')->name('citys.bulk_delete');
            Route::resource('citys', 'CityController');

            //types routes
            Route::get('/types/data', 'TypeController@data')->name('types.data');
            Route::delete('/types/bulk_delete', 'TypeController@bulkDelete')->name('types.bulk_delete');
            Route::resource('types', 'TypeController');

            //statuses routes
            Route::get('/status/data', 'StatusController@data')->name('status.data');
            Route::delete('/status/bulk_delete', 'StatusController@bulkDelete')->name('status.bulk_delete');
            Route::resource('status', 'StatusController');

            //specs routes
            Route::get('/specs/data', 'SpecController@data')->name('specs.data');
            Route::delete('/specs/bulk_delete', 'SpecController@bulkDelete')->name('specs.bulk_delete');
            Route::resource('specs', 'SpecController');

            //insurances routes
            Route::get('/insurances/data', 'InsuranceController@data')->name('insurances.data');
            Route::delete('/insurances/bulk_delete', 'InsuranceController@bulkDelete')->name('insurances.bulk_delete');
            Route::resource('insurances', 'InsuranceController');

            //equipments routes
            Route::get('/equipments/data', 'EquipmentController@data')->name('equipments.data');
            Route::delete('/equipments/bulk_delete', 'EquipmentController@bulkDelete')->name('equipments.bulk_delete');
            Route::resource('equipments', 'EquipmentController');

            //spares routes
            Route::get('/spares/data', 'SpareController@data')->name('spares.data');
            Route::delete('/spares/bulk_delete', 'SpareController@bulkDelete')->name('spares.bulk_delete');
            Route::resource('spares', 'SpareController');

            //maintenances routes
            Route::get('/maintenances/data', 'MaintenanceController@data')->name('maintenances.data');
            Route::delete('/maintenances/bulk_delete', 'MaintenanceController@bulkDelete')->name('maintenances.bulk_delete');
            Route::resource('maintenances', 'MaintenanceController');

            //fuels routes
            Route::get('/fuels/data', 'FuelController@data')->name('fuels.data');
            Route::delete('/fuels/bulk_delete', 'FuelController@bulkDelete')->name('fuels.bulk_delete');
            Route::resource('fuels', 'FuelController');


            //eirs routes
            Route::get('/eirs/data', 'EirController@data')->name('eirs.data');
            Route::delete('/eirs/bulk_delete', 'EirController@bulkDelete')->name('eirs.bulk_delete');
            Route::resource('eirs', 'EirController');


            //request_parts routes
            Route::get('/request_parts/data', 'RequestPartController@data')->name('request_parts.data');
            Route::delete('/request_parts/bulk_delete', 'RequestPartController@bulkDelete')->name('request_parts.bulk_delete');
            Route::resource('request_parts', 'RequestPartController');

          

            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            Route::name('profile.')->namespace('Profile')->group(function () {

                //password routes
                Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                Route::put('/password/update', 'PasswordController@update')->name('password.update');

            });

        });

    });
