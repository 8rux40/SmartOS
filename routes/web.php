<?php

use App\Http\Controllers\PecaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\CelularController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemServicoController;

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('ordemservico')->group(function(){
    Route::get('/', [OrdemServicoController::class, 'index'])->name('ordemservico.index');
    Route::get('/create/{orcamento_id}', [OrcamentoController::class, 'create'])->name('ordemservico.create');
    Route::get('/show/{id}', [OrdemServicoController::class, 'show'])->name('ordemservico.show');
    Route::get('/edit/{id}', [OrdemServicoController::class, 'edit'])->name('ordemservico.edit');
    Route::get('/getAll', [OrdemServicoController::class, 'getAll'])->name('ordemservico.getAll');
    
    Route::put('/update', [OrdemServicoController::class, 'update'])->name('ordemservico.update');
    Route::delete('/delete', [OrdemServicoController::class, 'delete'])->name('ordemservico.delete');
});

Route::prefix('orcamento')->group(function(){
    Route::get('/', [OrcamentoController::class, 'index'])->name('orcamento.index');
    Route::get('/create/{cliente_id}/{celular_id}', [OrcamentoController::class, 'create'])->name('orcamento.create');
    Route::get('/show/{id}', [OrcamentoController::class, 'show'])->name('orcamento.show');
    Route::get('/edit/{id}', [OrcamentoController::class, 'edit'])->name('orcamento.edit');
    Route::get('/getAll', [OrcamentoController::class, 'getAll'])->name('orcamento.getAll');
    
    Route::post('/solicitar', [OrcamentoController::class, 'solicitarOrcamento'])->name('orcamento.solicitar');
    Route::put('/update', [OrcamentoController::class, 'update'])->name('orcamento.update');
});

Route::prefix('peca')->group(function(){
    Route::get('/', [PecaController::class, 'index'])->name('peca.index');
    Route::get('/create', [PecaController::class, 'create'])->name('celular.create'); 
    Route::get('/getAll', [PecaController::class, 'getAll'])->name('celular.getAll');

    Route::post('/store', [PecaController::class, 'store'])->name('celular.store');
    Route::put('/update', [PecaController::class, 'update'])->name('celular.update');
    Route::delete('/delete', [PecaController::class, 'delete'])->name('celular.delete');
});

Route::prefix('celular')->group(function(){
    Route::get('/', [CelularController::class, 'index'])->name('celular.index');
    Route::get('/create', [CelularController::class, 'create'])->name('celular.create'); 
    Route::get('/getAll', [CelularController::class, 'getAll'])->name('celular.getAll');

    Route::post('/store', [CelularController::class, 'store'])->name('celular.store');
    Route::put('/update', [CelularController::class, 'update'])->name('celular.update');
    Route::delete('/delete', [CelularController::class, 'delete'])->name('celular.delete');
});

Route::prefix('cliente')->group(function(){
    Route::get('/', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/create', [ClienteController::class, 'create'])->name('cliente.create');
    Route::get('/show/{id}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::get('/getAll', [ClienteController::class, 'getAll'])->name('cliente.getAll');

    Route::post('/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('/update', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/delete', [ClienteController::class, 'delete'])->name('cliente.delete');
});
