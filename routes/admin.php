<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\Auth\ProfileController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\CityController;
use App\Http\Controllers\Dashboard\Admin\TypeController;
use App\Http\Controllers\Dashboard\Admin\SpecController;
use App\Http\Controllers\Dashboard\Admin\VehicleController;
use App\Http\Controllers\Dashboard\Admin\WelcomController;


Route::get('/dashboard/login', [AuthController::class,'index'])->name('dashboard.login.index');
Route::post('/dashboard/login', [AuthController::class,'store'])->name('dashboard.login.store');
Route::post('/dashboard/logout', [AuthController::class,'logout'])->name('dashboard.logout');

Route::prefix('dashboard/admin')->name('dashboard.admin.')->middleware(['auth:admin'])->group(function () {

    Route::get('/', [WelcomController::class,'index'])->name('welcome');

    // profile route
    Route::get('profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
    Route::put('profile/update/{user}', [ProfileController::class,'update'])->name('profile.update');

    //admins routes
    Route::resource('admins', AdminController::class)->except(['show']);

    //citys routes
    Route::resource('citys', CityController::class)->except(['show']); 

    //types routes
    Route::resource('types', TypeController::class)->except(['show']);

    //citys routes
    Route::resource('specs', SpecController::class)->except(['show']);

    //vehicles routes
    Route::resource('vehicles', VehicleController::class)->except(['show']);


}); //end of dashboard routes

