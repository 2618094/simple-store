<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Web\IndexController::class);

Route::get('/checkout/{product}', \App\Http\Controllers\Web\CheckoutController::class)->name('checkout');

Route::prefix('products')->as('products.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\ProductController::class, 'index'])->name('index');
});

Route::prefix('orders')->as('orders.')->group(function () {
    Route::get('/{order}', [\App\Http\Controllers\Web\OrderController::class, 'show'])->name('show');
    Route::post('/', [\App\Http\Controllers\Web\OrderController::class, 'store'])->name('store');
});



