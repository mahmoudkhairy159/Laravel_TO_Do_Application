<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AppSettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::prefix('/v1')->group(function () {

    //app-settings
    Route::controller(AppSettingsController::class)->group(function () {
        Route::get('/app-settings', 'index');
    });
    //app-settings

});
