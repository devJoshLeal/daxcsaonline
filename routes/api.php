<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(TokenController::class)->group(function () {
    Route::get('/authcontrol/tokenfromuser', 'getTokenFromUser')->name('token.mytoken');
});

Route::middleware('api.token')->controller(OrderController::class)->group(function () {
    Route::get('/order/track/{trackId}', 'orderByTrack');
    Route::get('/order/byUser/', 'listByUser')->name('api-listByUser');
    Route::post('/order/newOrder', 'newOrder')->name('api-newOrder');
});

Route::middleware('api.token')->controller(ProductController::class)->group(function () {
    Route::get('/getproduct/{publicId}', 'getProduct');
});

