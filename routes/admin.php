<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
 */

//default

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/login', 'login')->defaults('_config', [
                'view' => 'admin.auth.login',
            ])->name('login');
            Route::post('/login/checkLogin', 'checkLogin')->name('check_login');
        });

    // Admin Routes
    Route::group(['middleware' => ['auth', 'role:admin']], function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->defaults('_config', [
                'view' => 'admin.dashboard.dashboard',
            ])->name('dashboard');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin Management
        Route::controller(AdminController::class)->name('admin-management.')->prefix('admin-management')->group(function () {
            Route::get('', 'index')->defaults('_config', [
                'view' => 'admin.admin.index',
            ])->name('index');

            Route::get('/profile', 'showProfile')->defaults('_config', [
                'view' => 'admin.admin.edit',
            ])->name('showProfile');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'admin.admin.create',
            ])->name('create');

            Route::get('/{id}/edit', 'edit')->defaults('_config', [
                'view' => 'admin.admin.edit',
            ])->name('edit');

            Route::post('/store', 'store')->defaults('_config', [
                'redirect' => 'admin.admin-management.index',
            ])
                ->name('store');

            Route::put('/{id}/update', 'update')
                ->defaults('_config', [
                    'redirect' => 'admin.admin-management.index',
                ])
                ->name('update');

            Route::delete('/{id}/destroy', 'destroy')
                ->defaults('_config', [
                    'redirect' => 'admin.admin-management.index',
                ])
                ->name('destroy');
        });
        // Admin Management

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });


        // SETTINGS
        Route::controller(SettingController::class)->name('settings.')
            ->prefix('settings')->group(function () {
                Route::get('', 'index')->defaults('_config', [
                    'view' => 'admin.settings.index',
                ])->name('index');

                Route::put('/update', 'update')
                    ->defaults('_config', [
                        'redirect' => 'admin.settings.index',
                    ])
                    ->name('update');
            });

        // SETTINGS


    });
});
