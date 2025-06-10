    <?php

use App\Http\Controllers\ClienteController;
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




Route::get('/ConsultarPedidos', function () {
    return view('consultar_pedidos');
})->middleware(['auth', 'verified'])->name('consultarpedidos');


Route::middleware('auth')->group(function () {
    
    Route::get('/cadastrar-pedidos', [PedidosController::class, 'create'])->name('cadastrarpedidos');
    Route::get('/pedidos/create', [PedidosController::class, 'create']);
    Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
    Route::get('/prato/{id}/precos', [PratoController::class, 'getPrecos'])->name('prato.precos');
    Route::patch('/prato/{id}/toggle-disponibilidade', [PratoController::class, 'toggleDisponibilidade'])->name('prato.toggleDisponibilidade');
    Route::patch('/prato/{id}/indisponivel-hoje', [PratoController::class, 'tornarIndisponivelHoje'])->name('prato.indisponivelHoje');
    Route::get('/ConsultarPedidos', [PedidosController::class, 'index'])->name('consultarpedidos');
    Route::get('/consultar-vendas', [PedidosController::class, 'consultarVendas'])->name('consultarvendas');
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    Route::patch('/pedidos/{id}/status', [PedidosController::class, 'updateStatus'])->name('pedidos.updateStatus');
    Route::get('/clientes',[ClienteController::class,'index'])->name('consultarclientes');
    Route::get('/clientes/criar',[ClienteController::class,'criarCliente'])->name('criarcliente');
    Route::delete('/prato/{id}', [PratoController::class, 'destroy'])->name('pratos.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/consultar-vendas',[PedidosController::class,'consultarVendas'])->name('consultarvendas');
    Route::get('/cadastrar-prato',[PratoController::class,'criarPrato'])->name('criarprato');
    Route::post('/armazenar-prato',[PratoController::class,'armazenarPrato'])->name('armazenarprato');
    Route::get('/editar-prato/{id}',[PratoController::class,'editarPrato'])->name('editar_prato');
    Route::put('/alterar-prato/{id}', [PratoController::class,'alterarPrato'])->name('alterar_prato');
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    Route::patch('/pedidos/{id}/status', [PedidosController::class, 'updateStatus'])->name('pedidos.updateStatus');
});

require __DIR__.'/auth.php';
