<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoPrato;
use App\Models\Prato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PedidosController extends Controller
{
    public function create()
    {
        $pratos = Prato::where('disponivel', true)->get();
        return view('cadastrar_pedidos', compact('pratos'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:50',
                'obs' => 'nullable|string|max:500',
                'modo_retirada' => 'required|in:entrega,localmente',
                'pratos_json' => 'required|json',
                'formPag' => 'required|in:credito,debito,pix,dinheiro',
                'tEntrega' => 'nullable|numeric|min:0',
                'endereco' => 'nullable|string|max:150',
                'telefone' => 'nullable|string|max:14',
            ]);

            // Criar ou encontrar o cliente
            $cliente = Cliente::firstOrCreate(
                ['nome' => $request->nome],
                ['user_id' => auth()->id()]
            );



            // Criar o pedido
            $pedido = new Pedido();
            $pedido->modo_retirada = $validated['modo_retirada'];
            $pedido->total_preco = 0; // Será calculado abaixo
            $pedido->taxa_entrega = $request->tEntrega ?? 0;
            $pedido->observacao = $request->obs;
            $pedido->forma_pagamento = $this->formatarFormaPagamento($request->formPag);
            $pedido->esta_produzindo = false;
            $pedido->modo_retirada = $validated['modo_retirada'];
            $pedido->foi_produzido = false;
            $pedido->foi_entregue = false;
            $pedido->cliente_id = $cliente->id;

            // Salvar o pedido para obter o ID
            $pedido->save();

            // Processar itens do pedido
            $pratos = json_decode($request->pratos_json, true);
            $totalPedido = 0;

            foreach ($pratos as $pratoData) {
                $prato = Prato::find($pratoData['prato_id']);
                $preco = $this->getPrecoPorTamanho($prato, $pratoData['tamanho']);
                $subtotal = $preco * $pratoData['quantidade'];
                $totalPedido += $subtotal;

                PedidoPrato::create([
                    'pedido_id' => $pedido->id,
                    'prato_id' => $pratoData['prato_id'],
                    'quantidade' => $pratoData['quantidade'],
                    'tamanho' => strtoupper(substr($pratoData['tamanho'], 0, 1)),
                    'preco' => $preco
                ]);
            }

            // Atualizar total do pedido (incluindo taxa de entrega)
            $pedido->total_preco = $totalPedido + $pedido->taxa_entrega;
            $pedido->save();

            // Atualizar informações do cliente se for entrega
            if ($request->endereco) {
                $cliente->enderecos()->updateOrCreate(
                    ['logradouro' => $request->endereco],
                    ['logradouro' => $request->endereco]
                );
            }

            if ($request->telefone) {
                $cliente->telefones()->updateOrCreate(
                    ['telefone' => $request->telefone],
                    ['telefone' => $request->telefone]
                );
            }

            return redirect()->route('consultarpedidos')->with('success', 'Pedido cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao processar pedido: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro: ' . $e->getMessage());

        }

    }

    public function index()
    {
        $pedidos = Pedido::with(['pedidoPrato.prato', 'cliente'])
            ->where('foi_entregue', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('consultar_pedidos', compact('pedidos'));
    }

    public function consultarVendas(Request $request)
    {
        $query = Pedido::with(['pedidoPrato.prato', 'cliente'])
            ->where('foi_entregue', 1);

        if ($request->vendas === 'mensal') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        } elseif ($request->vendas === 'diarias') {
            $query->whereDate('created_at', now());
        } elseif ($request->has(['data_inicio', 'data_fim'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->data_inicio)->startOfDay(),
                Carbon::parse($request->data_fim)->endOfDay()
            ]);
        }

        $vendas = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->query());

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

            return response()->json([
                'success' => true,
                'finalizado' => $pedido->foi_entregue
            ]);
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar status do pedido ID $id: " . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o status do pedido'], 500);
        }
    }

    private function formatarFormaPagamento($formaPagamento)
    {
        $formatos = [
            'pix' => 'pix',
            'debito' => 'debito',
            'Ccredito' => 'credito',
            'dinheiro' => 'dinheiro'
        ];

        return strtolower($formaPagamento);
    }

    private function getPrecoPorTamanho($prato, $tamanho)
    {
        switch ($tamanho) {
            case 'pequena':
                return $prato->preco_p;
            case 'media':
                return $prato->preco_m;
            case 'grande':
                return $prato->preco_g;
            default:
                return 0;
        }
    }
}