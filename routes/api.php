<?php

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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('venues', 'Api\\VenueController');

    Route::apiResource('venues.spaces', 'Api\\SpaceController')->only('index', 'store');
    Route::apiResource('spaces', 'Api\\SpaceController')->except('index', 'store');
});
