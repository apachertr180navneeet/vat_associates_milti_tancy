<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\{
    AdminAuthController,
    PageController,
    FirmTypeController,
    FirmController,
};
use App\Http\Controllers\Ajax\{
    LocationController
};

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Register your web routes for the application. These routes are loaded
| by the RouteServiceProvider within a group that is assigned to the
| "web" middleware group. Enjoy building your application!
|
*/

// Website routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Authentication Routes
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin')->name('login.post');
        Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });

    // Admin routes with 'admin' middleware
    Route::middleware('admin')->group(function () {

        // Admin Dashboard and Profile Routes
        Route::controller(AdminAuthController::class)->group(function () {
            Route::get('dashboard', 'adminDashboard')->name('dashboard');
            Route::get('change-password', 'changePassword')->name('change.password');
            Route::post('update-password', 'updatePassword')->name('update.password');
            Route::get('logout', 'logout')->name('logout');
            Route::get('profile', 'adminProfile')->name('profile');
            Route::post('profile', 'updateAdminProfile')->name('update.profile');
        });

        // Firm Type Management Routes
        Route::prefix('firm_type')->name('firm.type.')->controller(FirmTypeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('all', 'getall')->name('all');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('status', 'status')->name('status');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::delete('delete/{id}', 'destroy')->name('destroy');
        });

        // Firm Management Routes
        Route::prefix('firm')->name('firm.')->controller(FirmController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('all', 'getall')->name('all');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('status', 'status')->name('status');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::delete('delete/{id}', 'destroy')->name('destroy');
        });

    });

});

Route::middleware(['auth'])->group(function () {

});


/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Routes for Ajax functionalities, prefixed with 'ajax' and named with 'ajax.'
|
*/

Route::prefix('ajax')->name('ajax.')->group(function () {

    // Location-related Ajax Routes
    Route::controller(LocationController::class)->group(function () {
        Route::get('getCities/{state}', 'getCities')->name('getCities');
        Route::get('getPincodes/{city}', 'getPincodes')->name('getPincodes');
    });
});
