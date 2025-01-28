<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(App\Http\Controllers\WebController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/orders', 'orders')->name('orders')->middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ]);

});
Route::group(['prefix' => 'api'], function () {
    Route::controller(App\Http\Controllers\TokenController::class)->group(function () {
        Route::get('/authcontrol/tokenfromuser', 'getTokenFromUser')->name('token.mytoken');

    });
    Route::middleware('api.token')->controller(App\Http\Controllers\OrderController::class)->group(function () {
        Route::get('/test','test');
        Route::get('/order/track/{trackId}', 'orderByTrack');
        Route::get('/order/byUser/', 'listByUser')->name('api-listByUser');

    });
    Route::middleware('api.token')->controller(App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/getproduct/{publicId}', 'getProduct');

    });
});
