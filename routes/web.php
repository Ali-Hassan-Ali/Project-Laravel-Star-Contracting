<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApartmentController;

// https://codepen.io/DashboardPack/pen/REmEZQ


Route::get('/', function (){
    
    if (!auth()->guard('admin')->check()) {
            
        return view('dashboard_admin.auth.login');

    }//end of if

    return redirect()->route('dashboard.admin.welcome');

});


//view apartment
Route::get('apartment/list', [ApartmentController::class,'getApartments'])->name('apartment.list');
Route::get('apartments',[ApartmentController::class,'index'])->name('apartments');
//insert into photo table
Route::get('Add', [ApartmentController::class,'Add'])->name('addapartment');
Route::post('uploadapartment', [ApartmentController::class,'store'])->name('uploadapartment');
Route::get('EditApartment/{id}', [ApartmentController::class,'Edit'])->name('EditApartment');
Route::PUT('update', [ApartmentController::class,'update'])->name('update');
Route::DELETE('/movetoTrash/{id}', [ApartmentController::class,'destroy'])->name('movetoTrash');
// Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

//     Route::get('/', function (){
//         return redirect()->route('admin.auth.login');
//     });


    /*authentication*/
    // Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    //     Route::get('login', 'LoginController@login')->name('login');
    //     Route::post('login', 'LoginController@submit');
    //     Route::get('logout', 'LoginController@logout')->name('logout');
    // });
//     Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// });

