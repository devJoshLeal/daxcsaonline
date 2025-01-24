<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
*/
Route::get('/dashboard', function () {
    return redirect()->route('dashboard');
});
Route::middleware([
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
Route::group(['prefix' => 'api'], function () {
    Route::middleware('api.token')->controller(App\Http\Controllers\OrderController::class)->group(function () {
        Route::get('/test','test');
        Route::get('/order/track/{trackId}', 'orderByTrack');
        Route::get('/order/byUser/', 'listByUser')->name('api-listByUser');

    });
    Route::middleware('api.token')->controller(App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/getproduct/{publicId}', 'getProduct');

    });
});
