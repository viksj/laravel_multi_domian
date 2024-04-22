<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\Auth\LoginController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', function () {
        return view('app.welcome');
    });

    Route::get('/login', function () {
        return view('app.auth.login');
    });

    Route::post('/login',[LoginController::class,'login']);

    Route::middleware('auth')->group(function (){
        Route::get('/home',function (){
            return view('app.home');
        });

        Route::post('/logout',[LoginController::class,'logout']);
    });
});
