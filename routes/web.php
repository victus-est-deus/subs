<?php

use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);
Route::middleware('auth')->group(function () {
    Route::post('/subscribe/{product_id}', [SubscriptionController::class, 'subscribe']);
    Route::post('/unsubscribe/{product_id}', [SubscriptionController::class, 'cancel']);
    Route::post('/products', [ProductController::class, 'store']);
});
require __DIR__.'/auth.php';
