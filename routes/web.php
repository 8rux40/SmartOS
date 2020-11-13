<?php

use App\Http\Controllers\OrcamentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemServicoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('orcamento')->group(function(){
    Route::get('/', [OrcamentoController::class, 'index']);
    Route::get('/create', [OrcamentoController::class, 'create']);
    Route::get('/show/{id}', [OrcamentoController::class, 'show']);
});
