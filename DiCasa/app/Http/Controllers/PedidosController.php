<?php

namespace App\Http\Controllers;

use App\Models\Pedido; 
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();
        return view('consultar_pedidos', compact('pedidos'));
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