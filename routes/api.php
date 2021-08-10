<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OwnerController;
use App\Models\Reservation;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api'], 'prefix' => '/v1/users'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::get('{id}/like', [LikeController::class, 'show']);
    Route::get('{id}/reservations', [ReservationController::class, 'index']);

    Route::get('', [UserController::class, 'index']);
});

Route::group(['middleware' => ['api'], 'prefix' => '/v1/shops'], function () {
    Route::get('', [ShopController::class, 'index']);
    Route::get('{id}', [ShopController::class, 'show']);
    Route::post('{id}/like', [LikeController::class, 'store']);
    Route::delete('{id}/like', [LikeController::class, 'destroy']);
    Route::post('{id}/review', [ReviewController::class, 'store']);
    Route::post('{id}/reservation', [ReservationController::class, 'store']);
    Route::get('reservation/{id}', [ReservationController::class, 'show']);
    Route::put('reservation/{id}', [ReservationController::class, 'update']);
    Route::delete('reservation/{id}', [ReservationController::class, 'destroy']);

    Route::get('{id}/reviews', [ReviewController::class, 'show']);
    Route::get('review', [ReviewController::class, 'index']);
    Route::get('area', [AreaController::class, 'index']);
});

Route::group(['middleware' => ['api'], 'prefix' => '/v1/owners'], function() {
    Route::post('register', [AuthController::class, 'ownerRegister']);
    Route::post('login', [AuthController::class, 'ownerLogin']);
    Route::post('{id}/shop', [ShopController::class, 'store']);
    Route::get('', [OwnerController::class, 'index']);
    Route::get('{id}', [OwnerController::class, 'show']);
    Route::get('{id}/reservations', [ReservationController::class, 'shop_reservation']);
});
