<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\TelaPrincipalController;
use App\Http\Controllers\PratoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/TelaPrincipal', [TelaPrincipalController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('telaprincipal');


Route::get('/CadastrarPedidos', function () {
    return view('cadastrar_pedidos');
})->middleware(['auth', 'verified'])->name('cadastrarpedidos');

Route::get('/ConsultarPedidos', function () {
    return view('consultar_pedidos');
})->middleware(['auth', 'verified'])->name('consultarpedidos');


Route::middleware('auth')->group(function () {

    Route::patch('/prato/{id}/toggle-disponibilidade', [PratoController::class, 'toggleDisponibilidade'])->name('prato.toggleDisponibilidade');
    Route::patch('/prato/{id}/indisponivel-hoje', [PratoController::class, 'tornarIndisponivelHoje'])->name('prato.indisponivelHoje');
    Route::get('/ConsultarPedidos', [PedidosController::class, 'index'])->name('consultarpedidos');
    Route::get('/consultar-vendas', [PedidosController::class, 'consultarVendas'])->name('consultarvendas');
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    Route::patch('/pedidos/{id}/status', [PedidosController::class, 'updateStatus'])->name('pedidos.updateStatus');

    
    Route::get('/cadastrar-prato/{id?}', [PratoController::class, 'criarPrato'])->name('criarprato'); // criação e edição
    Route::post('/armazenar-prato', [PratoController::class, 'armazenarPrato'])->name('armazenarprato'); // salvar novo prato
    Route::put('/prato/{id}', [PratoController::class, 'atualizarPrato'])->name('atualizarprato'); // atualizar prato existente
    Route::delete('/prato/{id}', [PratoController::class, 'destroy'])->name('pratos.destroy');

   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
