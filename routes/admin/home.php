<?php
// use Illuminate\Support\Facades\Route;

// Route::middleware([
//     // 'localeSessionRedirect',
//     // 'localizationRedirect',
//     // 'localeViewPath',
//     'auth',
//     'role:admin|super_admin',
// ])
//     ->group(function () {

//         Route::name('admin.reports.')->prefix('admin/report')->group(function () {

//             // reports Route

//             Route::get('spares_available', 'AparesAvailableController@AparesAvailable')->name('spares_available');
//             Route::get('spares_available/sum', 'AparesAvailableController@sumAparesAvailable')->name('spares_available.sum');
//             Route::get('spares_available/data', 'AparesAvailableController@dataAparesAvailable')->name('spares_available.data');


//         });//end of group

//     });//end of Route middleware
