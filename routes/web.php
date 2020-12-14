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
    //Route::get('/create/{orcamento_id}', [OrdemServicoController::class, 'create'])->name('ordemservico.create');
    Route::get('/show/{id}', [OrdemServicoController::class, 'show'])->name('ordemservico.show');
    Route::get('/edit/{id}', [OrdemServicoController::class, 'edit'])->name('ordemservico.edit');
    Route::get('/getAll', [OrdemServicoController::class, 'getAll'])->name('ordemservico.getAll');
    Route::get('/getAbertas', [OrdemServicoController::class, 'getAbertas'])->name('ordemservico.getAbertas');
    
    Route::post('/store/{orcamento_id}', [OrdemServicoController::class, 'store'])->name('ordemservico.store');
    Route::put('/update/{id}', [OrdemServicoController::class, 'update'])->name('ordemservico.update');
    Route::post('/delete', [OrdemServicoController::class, 'delete'])->name('ordemservico.delete');
});

Route::prefix('orcamento')->group(function(){
    Route::get('/', [OrcamentoController::class, 'index'])->name('orcamento.index');
    Route::get('/create/{celular_id}', [OrcamentoController::class, 'create'])->name('orcamento.create');
    Route::get('/show/{id}', [OrcamentoController::class, 'show'])->name('orcamento.show');
    Route::get('/edit/{id}', [OrcamentoController::class, 'edit'])->name('orcamento.edit');
    Route::get('/getAll', [OrcamentoController::class, 'getAll'])->name('orcamento.getAll');
    
    Route::post('/solicitar', [OrcamentoController::class, 'solicitarOrcamento'])->name('orcamento.solicitar');
    Route::put('/update/{id}', [OrcamentoController::class, 'update'])->name('orcamento.update');
});

Route::prefix('peca')->group(function(){
    Route::get('/', [PecaController::class, 'index'])->name('peca.index');
    Route::get('/show/{id}', [PecaController::class, 'show'])->name('peca.show');
    Route::get('/create', [PecaController::class, 'create'])->name('peca.create');     
    Route::get('/show/{id}', [PecaController::class, 'show'])->name('peca.show');
    Route::get('/getAll', [PecaController::class, 'getAll'])->name('peca.getAll');
    Route::get('/edit/{id}', [PecaController::class, 'edit'])->name('peca.edit');
    Route::post('/store', [PecaController::class, 'store'])->name('peca.store');
    Route::put('/update/{id}', [PecaController::class, 'update'])->name('peca.update');
    Route::post('/delete/{id}', [PecaController::class, 'destroy'])->name('peca.delete');
});

Route::prefix('celular')->group(function(){
    Route::get('/', [CelularController::class, 'index'])->name('celular.index');
    Route::get('/create/{id}', [CelularController::class, 'create'])->name('celular.create'); 
    Route::get('/show/{id}', [CelularController::class, 'show'])->name('celular.show');
    Route::get('/getAll', [CelularController::class, 'getAll'])->name('celular.getAll');
    Route::get('/edit/{id}', [CelularController::class, 'edit'])->name('celular.edit');
    
    Route::post('/store', [CelularController::class, 'store'])->name('celular.store');
    Route::put('/update/{id}', [CelularController::class, 'update'])->name('celular.update');
    Route::post('/delete/{id}', [CelularController::class, 'destroy'])->name('celular.delete');
});

Route::prefix('cliente')->group(function(){
    Route::get('/', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/create', [ClienteController::class, 'create'])->name('cliente.create');
    Route::get('/show/{id}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::get('/getAll', [ClienteController::class, 'getAll'])->name('cliente.getAll');
    Route::get('/getCelulares/{id}', [ClienteController::class, 'getCelulares'])->name('cliente.getCelulares');

    Route::post('/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::post('/delete/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
});