<?php

use App\Http\Controllers\Api\amenitiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClusterController;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\vehicleEntranceController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('clusters/ge', ClusterController::class);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    //Route::apiResource('users', userController::class);
    Route::get('out-of-service', [UserController::class, 'getUsersOutOfService']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('amenities', amenitiController::class);
    Route::get('/amenitie/active', [amenitiController::class, 'getAmenitieActive']);
    Route::get('/amenitie/inactive', [amenitiController::class, 'getAmenitieInactive']);
    Route::get('/amenitie/maintenance', [amenitiController::class, 'getAmenitieManitenance']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('vehicleEntrances', vehicleEntranceController::class);
    Route::get('/entrances/today', [vehicleEntranceController::class, 'getTodayVehicleEntrances']);
});
