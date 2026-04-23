<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::controller(App\Http\Controllers\WebController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    // Orders tab will be hidden if not logged in
    Route::get('/orders', 'orders')->name('orders')->middleware([
        'auth:sanctum'
    ]);
    // Uses sanctum middleware to verify auth
});
Route::group(['prefix' => 'api'], function () {
    Route::controller(TokenController::class)->group(function () {
        Route::get('/authcontrol/tokenfromuser', 'getTokenFromUser')->name('token.mytoken');

    });
    Route::middleware('api.token')->controller(App\Http\Controllers\OrderController::class)->group(function () {
        Route::get('/order/track/{trackId}', 'orderByTrack');
        Route::get('/order/byUser/', 'listByUser')->name('api-listByUser');

    });
    Route::middleware('api.token')->controller(App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/getproduct/{publicId}', 'getProduct');

    });
});
