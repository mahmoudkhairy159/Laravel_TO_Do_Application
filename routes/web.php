<?php

use App\Http\Controllers\Website\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\SettingController;
use App\Http\Controllers\Website\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
 */

 Route::get('/', [AuthController::class, 'login'])->defaults('_config', [
    'view' => 'user.auth.login',
])->name(name: 'index');

Route::prefix('user')->name('user.')->group(function () {

    // Login
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/login', 'login')->defaults('_config', [
                'view' => 'user.auth.login',
            ])->name('login');
            Route::post('/login/checkLogin', 'checkLogin')->name('check_login');
        });

    // Admin Routes
    Route::group(['middleware' => ['auth', 'role:user']], function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->defaults('_config', [
                'view' => 'user.dashboard.dashboard',
            ])->name('dashboard');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin Management
        Route::controller(UserController::class)->name('user-management.')->prefix('user-management')->group(function () {
            Route::get('', 'index')->defaults('_config', [
                'view' => 'user.user.index',
            ])->name('index');

            Route::get('/profile', 'showProfile')->defaults('_config', [
                'view' => 'user.user.edit',
            ])->name('showProfile');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'user.user.create',
            ])->name('create');

            Route::get('/{id}/edit', 'edit')->defaults('_config', [
                'view' => 'user.user.edit',
            ])->name('edit');

            Route::post('/store', 'store')->defaults('_config', [
                'redirect' => 'user.user-management.index',
            ])
                ->name('store');

            Route::put('/{id}/update', 'update')
                ->defaults('_config', [
                    'redirect' => 'user.user-management.index',
                ])
                ->name('update');

            Route::delete('/{id}/destroy', 'destroy')
                ->defaults('_config', [
                    'redirect' => 'user.user-management.index',
                ])
                ->name('destroy');
        });
        // Admin Management

        Route::get('/', function () {
            return redirect()->route('user.dashboard');
        });


        // SETTINGS
        Route::controller(SettingController::class)->name('settings.')
            ->prefix('settings')->group(function () {
                Route::get('', 'index')->defaults('_config', [
                    'view' => 'user.settings.index',
                ])->name('index');

                Route::put('/update', 'update')
                    ->defaults('_config', [
                        'redirect' => 'user.settings.index',
                    ])
                    ->name('update');
            });

        // SETTINGS


    });
});
