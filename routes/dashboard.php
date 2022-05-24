<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Auth\AuthController;

use App\Http\Controllers\Dashboard\Admin\WelcomController;
use App\Http\Controllers\Dashboard\Admin\AdminController;

Route::get('dashboard/login', [AuthController::class,'index'])->name('dashboard.admin.login');
Route::post('/dashboard/store', [AuthController::class,'store'])->name('dashboard.admin.login.store');
Route::get('dashboard/admin/logout', [AuthController::class,'admin_logout'])->name('dashboard.admin.logout');

Route::prefix('dashboard/admin')->name('dashboard.admin.')->middleware('auth:admin')->group(function () {

        Route::get('/', [WelcomController::class,'index'])->name('welcome');

        Route::resource('admins', AdminController::class)->except('show');

        Route::prefix('setting')->name('setting.')->group(function () {

                Route::resource('suppors', SupportController::class)->except('show');

                Route::get('support', [SettingController::class, 'support'])->name('support');
                Route::post('/settings', [SettingController::class,'store'])->name('store');

        });//group(function

});//group(function