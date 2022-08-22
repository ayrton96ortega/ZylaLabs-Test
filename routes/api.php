<?php

use App\Http\Controllers\CurrentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ModelClimateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ModelClimateController::class)->group(function () {
    Route::get('current/{query?}', 'show');
    Route::get('currents', 'store')->name('store');
    Route::get('currentess','update')->neme('update');
});
