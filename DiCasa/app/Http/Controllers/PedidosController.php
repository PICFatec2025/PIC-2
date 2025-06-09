<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::
            with('pedidoPrato.prato')->
            where('foi_entregue', 0)->
            orderBy('created_at', 'desc')->get();
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
        $pedido = Pedido::find($id);
        if (!$pedido) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }
        try {
            $pedido->pedidoPrato()->delete();
            $pedido->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error("Erro ao excluir pedido ID $id: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao excluir o pedido'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        try {
            if ($request->has('produzindo')) {
                $pedido->esta_produzindo = $request->input('produzindo');
                if (!$pedido->esta_produzindo) {
                    $pedido->foi_produzido = false;
                    $pedido->foi_entregue = false;
                }
            }

            if ($request->has('pronto')) {
                $pedido->foi_produzido = $request->input('pronto');
                if (!$pedido->foi_produzido) {
                    $pedido->foi_entregue = false;
                }
            }

            if ($request->has('entregue')) {
                $pedido->foi_entregue = $request->input('entregue');
            }

            $pedido->save();

            // Retorna "finalizado: true" se o pedido chegou até entregue
            return response()->json([
                'success' => true,
                'finalizado' => $pedido->foi_entregue
            ]);
        } catch (\Exception $e) {
            \Log::error("Erro ao atualizar status do pedido ID $id: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o status do pedido'], 500);
        }
    }
}