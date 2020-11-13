<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function(){
    Route::post('registro', [App\Http\Controllers\AutenticadorController::class, 'registro']);
    Route::post('login', [App\Http\Controllers\AutenticadorController::class, 'login']);
    
    Route::middleware('auth:api')->group(function(){
        Route::post('logout', [App\Http\Controllers\AutenticadorController::class, 'logout']);
    });
        
});

Route::get('pecas', [App\Http\Controllers\Api\PecaController::class, 'index'])->middleware('auth:api');