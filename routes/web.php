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
    // register
    Route::controller(AuthController::class)
        ->middleware('guest')
        ->group(function () {
            Route::get('/register', 'register')->defaults('_config', [
                'view' => 'user.auth.register',
            ])->name('register');
            Route::post('/login/checkRegister', 'checkRegister')->name('check_register');
        });

    Route::group(['middleware' => ['auth', 'role:user']], function () {

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



        Route::get('/', function () {
            return redirect()->route('user.dashboard');
        });
    });
});
