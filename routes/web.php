<?php
use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\WebController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/dashboard', 'dashboard')->name('dashboard_2');
    // Orders tab will be hidden if not logged in
    Route::get('/orders', 'orders')->name('orders')->middleware([
        'auth:sanctum'
    ]);
    // Uses sanctum middleware to verify auth
});