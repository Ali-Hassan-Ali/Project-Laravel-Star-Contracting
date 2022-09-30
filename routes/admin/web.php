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

        Route::name('admin.')->prefix('admin')->group(function () {

            // reports Route
            Route::get('reports/get/equipment/{eir_overview}', 'ReportController@GetEquipment')->name('reports.get.equipment');
            Route::get('tables/old/{name}', 'TableController@index')->name('tables');

            Route::get('/material_delivery_time/sum', 'ReportController@sumMaterialDeliveryTime')->name('material_delivery_time.sum');
            Route::get('/material_delivery_time/data', 'ReportController@dataMaterialDeliveryTime')->name('material_delivery_time.data');
            Route::get('reports/material_delivery_time', 'ReportController@MaterialDeliveryTime')->name('reports.material_delivery_time');

            Route::get('/total_fuel_consumption/sum', 'ReportController@sumTotalFuelConsumption')->name('total_fuel_consumption.sum');
            Route::get('/total_fuel_consumption/data', 'ReportController@dataTotalFuelConsumption')->name('total_fuel_consumption.data');
            Route::get('reports/total_fuel_consumption', 'ReportController@totalFuelConsumption')->name('reports.total_fuel_consumption');

            Route::get('/totalequipment_expenditure/sum', 'ReportController@sumTotalEquipmentExpenditure')->name('total_equipment_expenditure.sum');
            Route::get('/total_equipment_expenditure/data', 'ReportController@dataTotalEquipmentExpenditure')->name('total_equipment_expenditure.data');
            Route::get('reports/total_equipment_expenditure', 'ReportController@totalEquipmentExpenditure')->name('reports.total_equipment_expenditure');

            Route::get('/average_expenditure_per_km/sum', 'ReportController@sumAverageExpenditurePerkM')->name('average_expenditure_per_km.sum');
            Route::get('/average_expenditure_per_km/data', 'ReportController@dataAverageExpenditurePerkM')->name('average_expenditure_per_km.data');
            Route::get('reports/average_expenditure_per_km', 'ReportController@averageExpenditurePerkM')->name('reports.average_expenditure_per_km');

            Route::get('reports/eir_overview', 'ReportController@EirOverview')->name('reports.eir_overview');
            Route::get('/eir_overview/data', 'ReportController@dataEirOverview')->name('eir_overview.data');
            Route::get('reports/sum_eir_overview', 'ReportController@sumEirOverview')->name('eir_overview.sum');

            Route::get('reports/equipments_overview', 'ReportController@EquipmentsOverview')->name('reports.equipments_overview');
            Route::get('/equipments_overview/data', 'ReportController@dataEquipmentsOverview')->name('equipments_overview.data');
            Route::get('reports/sum_equipments_overview', 'ReportController@sumEquipmentsOverview')->name('equipments_overview.sum');

            Route::get('/idle_equipments/sum', 'ReportController@sumIdleEquipments')->name('idle_equipments.sum');
            Route::get('/idle_equipments/data', 'ReportController@dataIdleEquipments')->name('idle_equipments.data');
            Route::get('reports/idle_equipments', 'ReportController@IdleEquipments')->name('reports.idle_equipments');


            Route::get('reports/total_hours_worked', 'ReportController@totalHoursWorked')->name('reports.total_hours_worked');
            Route::get('/total_hours_worked/data', 'ReportController@dataTotalHoursWorked')->name('total_hours_worked.data');
            Route::get('/total_hours_worked/sum', 'ReportController@sumTotalHoursWorked')->name('total_hours_worked.sum');


            Route::get('reports/average_mileage', 'ReportController@AverageMileage')->name('reports.average_mileage');
            Route::get('/average_mileage/data', 'ReportController@dataAverageMileage')->name('average_mileage.data');
            Route::get('/average_mileage/sum', 'ReportController@sumAverageMileage')->name('average_mileage.sum');

            Route::get('reports/total_insurance_cost', 'ReportController@TotalInsuranceCost')->name('reports.total_insurance_cost');
            Route::get('/total_insurance_cost/data', 'ReportController@dataTotalInsuranceCost')->name('total_insurance_cost.data');
            Route::get('/total_insurance_cost/sum', 'ReportController@sumTotalInsuranceCost')->name('total_insurance_cost.sum');


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

            Route::get('/statistics_ro', 'StatisticsController@chart')->name('statistics.chart');
            Route::get('/statistics_table', 'StatisticsController@table')->name('statistics.table');
            
            //combo boxs routes
            Route::get('/combo_boxs/data', 'ComboBoxController@data')->name('combo_boxs.data');
            Route::delete('/combo_boxs/bulk_delete', 'ComboBoxController@bulkDelete')->name('combo_boxs.bulk_delete');
            Route::resource('combo_boxs', 'ComboBoxController');

            Route::prefix('models')->group(function () {


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

                //spares routes
                Route::get('/spares/data', 'SpareController@data')->name('spares.data');
                Route::delete('/spares/bulk_delete', 'SpareController@bulkDelete')->name('spares.bulk_delete');
                Route::resource('spares.attachment', 'SpareAttachmentController');
                Route::resource('spares', 'SpareController');

                //specs routes
                Route::get('/specs/data', 'SpecController@data')->name('specs.data');
                Route::delete('/specs/bulk_delete', 'SpecController@bulkDelete')->name('specs.bulk_delete');
                Route::resource('specs', 'SpecController');

                //insurances routes
                Route::post('/insurances/claim', 'InsuranceController@claim')->name('insurances.claim');
                Route::get('/insurances/data', 'InsuranceController@data')->name('insurances.data');
                Route::delete('/insurances/bulk_delete', 'InsuranceController@bulkDelete')->name('insurances.bulk_delete');
                Route::resource('insurances.attachment', 'InsuranceAttachmentController');
                Route::resource('insurances', 'InsuranceController');

                //equipments routes

                Route::resource('equipments.attachment', 'EquipmentAttachmentController');

                Route::post('/equipments/country', 'EquipmentController@country')->name('equipments.country');
                Route::post('/equipments/type', 'EquipmentController@type')->name('equipments.type');
                Route::get('/equipments/data', 'EquipmentController@data')->name('equipments.data');
                Route::delete('/equipments/bulk_delete', 'EquipmentController@bulkDelete')->name('equipments.bulk_delete');
                Route::resource('equipments', 'EquipmentController');

                //maintenances routes
                Route::get('/maintenances/data', 'MaintenanceController@data')->name('maintenances.data');
                Route::delete('/maintenances/bulk_delete', 'MaintenanceController@bulkDelete')->name('maintenances.bulk_delete');
                Route::resource('maintenances', 'MaintenanceController');

                //fuels routes
                Route::get('/fuels/data', 'FuelController@data')->name('fuels.data');
                Route::delete('/fuels/bulk_delete', 'FuelController@bulkDelete')->name('fuels.bulk_delete');
                Route::resource('fuels', 'FuelController');


                //eirs routes
                Route::get('/eirs/request_parts/unit', 'EirController@unit')->name('eirs.request_parts.unit');
                Route::get('/eirs/data', 'EirController@data')->name('eirs.data');
                Route::delete('/eirs/bulk_delete', 'EirController@bulkDelete')->name('eirs.bulk_delete');
                Route::resource('eirs.attachment', 'EirAttachmentController');
                Route::resource('eirs', 'EirController');


                //request_parts routes
                Route::get('/request_parts/data', 'RequestPartController@data')->name('request_parts.data');
                Route::delete('/request_parts/bulk_delete', 'RequestPartController@bulkDelete')->name('request_parts.bulk_delete');
                Route::resource('request_parts', 'RequestPartController');


            });//end of models

            //role routes
            Route::get('/roles/data', 'RoleController@data')->name('roles.data');
            Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
            Route::resource('roles', 'RoleController');

            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //request_parts routes
            Route::get('/email_systems/data', 'EmailSystemController@data')->name('email_systems.data');
            Route::delete('/email_systems/bulk_delete', 'EmailSystemController@bulkDelete')->name('email_systems.bulk_delete');
            Route::resource('email_systems', 'EmailSystemController');
          

            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);


            Route::post('/ajax/country/{country}', 'AjaxController@ajaxCountry')->name('ajax.country');
            Route::post('/ajax/city/{city}', 'AjaxController@ajaxCity')->name('ajax.city');

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
