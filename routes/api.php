<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api'], 'prefix' => '/v1/users'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::get('{id}/like', [LikeController::class, 'show']);
    Route::get('{id}/reservations', [ReservationController::class, 'show']);

    Route::get('', [UserController::class, 'index']);
    // Route::get('like', [LikeController::class, 'index']);
});

Route::group(['middleware' => ['api'], 'prefix' => '/v1/shops'], function () {
    Route::get('', [ShopController::class, 'index']);
    Route::get('{id}', [ShopController::class, 'show']);
    Route::post('{id}/like', [LikeController::class, 'store']);
    Route::delete('{id}/like', [LikeController::class, 'destroy']);
    Route::post('{id}/reservation', [ReservationController::class, 'store']);
    Route::delete('reservation/{id}', [ReservationController::class, 'destroy']);
});
