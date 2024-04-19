<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarOwnersLoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/carowners_login',
    [App\Http\Controllers\CarOwnersLoginController::class, 'login'])->name('carowners_login');

Route::post('/driver_bid',
    [App\Http\Controllers\BidsController::class, 'bids'])->name('driver_bid');
