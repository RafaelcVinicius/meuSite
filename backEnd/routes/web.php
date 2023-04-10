<?php

use App\Classes\CustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return Socialite::driver('keycloak')->redirect();
});

Route::get('/app', function (Request $request) {
    // Socialite::driver('keycloak')->user();
    // dd($request->input("code"));

    $curl = new  CustomRequest();
    $curl->setRoute("https://auth.rafaelcoldebella.com.br/realms" ."/". config('services.keycloak.realms') . "/protocol/openid-connect/token");
    $curl->setHeaders([
        'Host'          =>  'api.rafaelcoldebella.com.br',
        'User-Agent'    =>  'null',
        'Accept'        =>  '*/*',
    ]);
    $curl->setBody([
        "code=".$request->input("code")."&grant_type=authorization_code&client_id="
        .config('services.keycloak.client_id')."&client_secret="
        .config('services.keycloak.client_secret')."&redirect_uri="
        .config('services.keycloak.base_url')
    ]);
    $curl->post();
    dd($curl);
});
