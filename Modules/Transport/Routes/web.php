<?php


use Modules\Transport\Http\Controllers\Admin\{
    TransportAuthController,
    TransportBranchController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('transport')->group(function() {
    Route::get('/', 'TransportController@index');
    Route::name('admin.')->prefix('admin')->group(function () {

        // Tranport Admin Authentication Routes
        Route::controller(TransportAuthController::class)->group(function () {
            Route::get('login', 'login')->name('login');
            Route::post('login', 'postLogin')->name('login.post');
        });

        // Tranport Admin Dashboard login
        Route::controller(TransportAuthController::class)->group(function () {
            Route::get('dashboard', 'adminDashboard')->name('dashboard');
        });

        // Tranport Admin Branches

        Route::prefix('branchs')->name('branchs.')->controller(TransportBranchController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });

    });
});
