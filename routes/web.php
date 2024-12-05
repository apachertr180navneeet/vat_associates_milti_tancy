<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;

// Super Admin Controller
use App\Http\Controllers\Admin\{
    AdminAuthController,
    PageController,
    FirmTypeController,

};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Website routes
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Super Admin routes

Route::name('admin.')->prefix('admin')->group(function () {
    
    // Admin Authentication Routes
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin')->name('login.post');
        Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });

    // Routes requiring 'admin' middleware
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

        // Admin User Management Routes
        // Route::prefix('users')->name('users.')->controller(AdminUserController::class)->group(function () {
        //     Route::get("/",'index')->name('index');
        //     Route::get("alluser", 'getallUser')->name('alluser');
        //     Route::post("status",'userStatus')->name('status');
        //     Route::delete("delete/{id}",'destroy')->name('destroy');
        //     Route::get("{id}",'show')->name('show');
        // });

         // Admin Firm Type Management Routes
        Route::prefix('firm_type')->name('firm.type.')->controller(FirmTypeController::class)->group(function () {
            Route::get("/",'index')->name('index');
            Route::get("all", 'getall')->name('all');
            Route::get("create",'create')->name('create');
            Route::post("store",'store')->name('store');
            Route::post("status",'status')->name('status');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::delete("delete/{id}",'destroy')->name('destroy');
        });
    
    });

});

Route::middleware(['auth'])->group(function () {

});