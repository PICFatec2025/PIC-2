<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Pedido;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rotas para Pedidos
Route::get('/consultar-pedidos', function () {
    // Cria pedidos de exemplo se não existirem
    if (Pedido::where('finalizado', false)->count() === 0) {
        Pedido::factory()->count(5)->create();
    }

    return view('consultar_pedidos', [
        'pedidos' => Pedido::where('finalizado', false)->get()
    ]);
});

Route::patch('/pedidos/{pedido}/status', function (Pedido $pedido) {
    $validated = request()->validate([
        'produzindo' => 'sometimes|boolean',
        'pronto' => 'sometimes|boolean',
        'entregue' => 'sometimes|boolean'
    ]);

    $pedido->update($validated);

    // Verifica e marca como finalizado se todas as etapas estiverem completas
    if ($pedido->produzindo && $pedido->pronto && $pedido->entregue) {
        $pedido->update([
            'finalizado' => true,
            'finalizado_em' => Carbon::now()
        ]);
        return response()->json(['finalizado' => true]);
    }

    return response()->json(['success' => true]);
});

Route::delete('/pedidos/{pedido}', function (Pedido $pedido) {
    $pedido->delete();
    return response()->json(['success' => true]);
});

Route::get('/tela_principal', function () {
    return view('tela_principal');
})->name('tela_principal');