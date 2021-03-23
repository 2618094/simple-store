<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::as('auth.')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login');
    Route::get('me', [\App\Http\Controllers\Api\LoginController::class, 'me'])->name('me');
});



Route::middleware('auth:api')->prefix('currencies')->as('currencies.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\CurrencyController::class, 'index'])->name('index');
    Route::get('/{currency}', [\App\Http\Controllers\Api\CurrencyController::class, 'show'])->name('show');
});
