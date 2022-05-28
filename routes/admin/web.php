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
           
            Route::get('/home', 'HomeController@index')->name('home');

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

            
            //equipments routes
            Route::get('/equipments/data', 'EquipmentController@data')->name('equipments.data');
            Route::delete('/equipments/bulk_delete', 'EquipmentController@bulkDelete')->name('equipments.bulk_delete');
            Route::resource('equipments', 'EquipmentController');

          

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
