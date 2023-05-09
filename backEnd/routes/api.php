<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', function (Request $request) {
    return json_encode($request->header('Authorization'));
    // dd($request->headers);
    // dd(Socialite::driver('keycloak'));
    // return Socialite::driver('keycloak')->redirect();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/app', function (Request $request) {
    //    dd(Auth::token());
    return 'ola';
    });
});
