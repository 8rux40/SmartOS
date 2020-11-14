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
    Route::get('/', [OrcamentoController::class, 'index'])->name('orcamento.index');
    Route::get('/create', [OrcamentoController::class, 'create'])->name('orcamento.create');
    Route::get('/show/{id}', [OrcamentoController::class, 'show'])->name('orcamento.show');
    Route::post('/solicitar', [OrcamentoController::class, 'solicitarOrcamento'])->name('orcamento.solicitar');

    Route::get('/getAll', [OrcamentoController::class, 'getAll'])->name('orcamento.getAll');
});

Route::prefix('peca')->group(function(){
    Route::get('/', function(){ return view('peca.index'); });
});