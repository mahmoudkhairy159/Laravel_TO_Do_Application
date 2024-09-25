<?php

use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\SettingController;
use App\Http\Controllers\Website\DashboardController;
use App\Http\Controllers\Website\TaskController;

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
    // register
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/register', 'register')->defaults('_config', [
                'view' => 'user.auth.register',
            ])->name('register');
            Route::post('/login/checkRegister', 'checkRegister')->name('check_register');
        });

    Route::group(['middleware' => ['auth']], function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->defaults('_config', [
                'view' => 'user.dashboard.dashboard',
            ])->name('dashboard');

        Route::controller(AuthController::class)->group(function () {
            // Logout
            Route::post('/logout', 'logout')->name('logout');

            // Change Password
            Route::put('/changePassword', 'changePassword')->name('changePassword');

            // Update Profile
            Route::put('/updateProfile', 'updateProfile')->name('updateProfile');

            // Show Profile
            Route::get('/showProfile', 'showProfile')->name('showProfile');
            // Update User Profile Image
            Route::post('/updateProfileImage', 'updateProfileImage')->name('updateProfileImage');

            // Delete User Profile Image
            Route::delete('/deleteProfileImage', 'deleteProfileImage')->name('deleteProfileImage');
        });
        // Tasks Management
        Route::controller(TaskController::class)->name('tasks.')->prefix('tasks')->group(function () {
            Route::get('', 'index')->defaults('_config', [
                'view' => 'user.tasks.index',
            ])->name('index');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'user.tasks.create',
            ])->name('create');

            Route::get('/{id}', 'show')->defaults('_config', [
                'view' => 'user.tasks.show',
            ])->name('show');


            Route::get('/{id}/edit', 'edit')->defaults('_config', [
                'view' => 'user.tasks.edit',
            ])->name('edit');

            Route::post('/store', 'store')->defaults('_config', [
                'redirect' => 'user.tasks.index',
            ])
                ->name('store');

            Route::put('/{id}/update', 'update')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('update');
                Route::put('/{id}/updateStatus', 'updateStatus')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('updateStatus');

            Route::delete('/{id}/destroy', 'destroy')
                ->defaults('_config', [
                    'redirect' => 'user.tasks.index',
                ])
                ->name('destroy');
        });
        // Tasks Management
 // Categories Management
 Route::controller(CategoryController::class)->name('categories.')->prefix('categories')->group(function () {
    Route::get('', 'index')->defaults('_config', [
        'view' => 'user.categories.index',
    ])->name('index');

    Route::get('/create', 'create')->defaults('_config', [
        'view' => 'user.categories.create',
    ])->name('create');

    Route::get('/{id}', 'show')->defaults('_config', [
        'view' => 'user.categories.show',
    ])->name('show');


    Route::get('/{id}/edit', 'edit')->defaults('_config', [
        'view' => 'user.categories.edit',
    ])->name('edit');

    Route::post('/store', 'store')->defaults('_config', [
        'redirect' => 'user.categories.index',
    ])
        ->name('store');

    Route::put('/{id}/update', 'update')
        ->defaults('_config', [
            'redirect' => 'user.categories.index',
        ])
        ->name('update');

    Route::delete('/{id}/destroy', 'destroy')
        ->defaults('_config', [
            'redirect' => 'user.categories.index',
        ])
        ->name('destroy');
});
// Categories Management

        Route::get('/', function () {
            return redirect()->route('user.dashboard');
        });
    });
});
