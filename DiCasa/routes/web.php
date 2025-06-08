<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PratoController;

Route::post('/pratos', [PratoController::class, 'store'])->name('pratos.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/TelaPrincipal', function () {
    return view('TelaPrincipal');
})->middleware(['auth', 'verified'])->name('telaprincipal');

Route::get('/CadastrarPedidos', function () {
    return view('cadastrar_pedidos');
})->middleware(['auth', 'verified'])->name('cadastrarpedidos');

Route::get('/ConsultarPedidos', function () {
    return view('consultar_pedidos');
})->middleware(['auth', 'verified'])->name('consultarpedidos');



Route::middleware('auth')->group(function () {
    Route::get('/ConsultarPedidos', [PedidosController::class, 'index'])->name('consultarpedidos');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/consultar-vendas',[PedidosController::class,'consultarVendas'])->name('consultarvendas');
    Route::get('/cadastrar-prato',[PratoController::class,'criarPrato'])->name('criarprato');
    Route::post('/armazenar-prato',[PratoController::class,'armazenarPrato'])->name('armazenarprato');
    
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    Route::patch('/pedidos/{id}/status', [PedidosController::class, 'updateStatus'])->name('pedidos.updateStatus');
});

require __DIR__.'/auth.php';
