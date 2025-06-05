<?php

namespace App\Http\Controllers;

use App\Models\Pedido; 
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();
        return view('consultar_pedidos', compact('pedidos'));
        
    }
    
public function consultarVendas(Request $request)
{
    $query = Pedido::with('pedidoPrato.prato')
        ->where('foi_entregue', 1);

    if ($request->vendas === 'mensal') {
        // Vendas do mês atual
        $query->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);

    } elseif ($request->vendas === 'diarias') {
        // Vendas do dia atual
        $query->whereDate('created_at', now());

    } elseif ($request->has(['data_inicio', 'data_fim'])) {
        // Vendas entre datas personalizadas
        $query->whereBetween('created_at', [
            Carbon::parse($request->data_inicio)->startOfDay(),
            Carbon::parse($request->data_fim)->endOfDay()
        ]);
    }

    $vendas = $query
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->appends($request->query()); 

    return view('consultar_vendas', compact('vendas'));
}

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        
        $finalizado = false;
        if ($request->entregue) {
            $pedido->update([
                'finalizado' => true,
                'finalizado_em' => now()
            ]);
            $finalizado = true;
        }
        
        return response()->json(['finalizado' => $finalizado]);
    }
}