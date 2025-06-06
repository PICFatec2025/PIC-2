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
    // dd(precoConvertidoEmReais(1234.56));
    // Buscar o Pedido que ja foi entregue e virou venda
    //with para facilitat a busca dos pratos
    $query = Pedido::with('pedidoPrato.prato')
        ->where('foi_entregue', 1);
    //a partir da url da pagina
    if ($request->vendas === 'mensal') {
        // faz a busca de vendas mensal
        $query->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);

    } elseif ($request->vendas === 'diarias') {
        // faz a busca das venda de hoje
        $query->whereDate('created_at', now());

    } elseif ($request->has(['data_inicio', 'data_fim'])) {
        // faz as buscas das venddas endas entre datas personalizadas
        $query->whereBetween('created_at', [
            Carbon::parse($request->data_inicio)->startOfDay(),
            Carbon::parse($request->data_fim)->endOfDay()
        ]);
    }
    //junta a busca com a query e coloca o paginate
    $vendas = $query
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->appends($request->query()); 
    //retorna a tela com as venads
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