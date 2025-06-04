<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', action: function () {
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
});

require __DIR__.'/auth.php';
