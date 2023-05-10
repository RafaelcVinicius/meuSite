<?php

use App\Http\Controllers\WalletController;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/login', function (Request $request) {
    return json_encode($request->header('Authorization'));
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return "ddd";
        });
    });

    Route::prefix('wallet')->group(function () {
        Route::post('/', [WalletController::class, 'store']);
        Route::get('/', [WalletController::class, 'showAll']);
        Route::prefix('{id}')->group(function () {
            Route::get('/', [WalletController::class, 'show']);
        });
    });
});

