<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Prato;
use Illuminate\Http\Request;

class TelaPrincipalController extends Controller
{

    public function index(Request $request)
    {

        $diaSelecionado = strtolower($request->get('dia', $this->getDiaAtual()));

        $pratos = Prato::whereHas('disponibilidade', function ($query) use ($diaSelecionado) {
            $query->where($diaSelecionado, true);
        })->with('disponibilidade')->get();

        $pedidos = Pedido::with('pedidoPrato.prato')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $marmitasVendidas = Pedido::whereBetween('created_at', [
            now()->startOfDay(),
            now()->endOfDay()
        ])->where('foi_entregue', 1)->count();
        return view('TelaPrincipal', [
            'pratos' => $pratos,
            'diaAtual' => $diaSelecionado,
            'pedidos' => $pedidos,
            'contagemDeMarmitas' => $marmitasVendidas
        ]);

    }

    private function getDiaAtual()
    {
        return match (strtolower(now()->locale('pt_BR')->dayName)) {
            'segunda-feira' => 'segunda_feira',
            'terça-feira' => 'terca_feira',
            'quarta-feira' => 'quarta_feira',
            'quinta-feira' => 'quinta_feira',
            'sexta-feira' => 'sexta_feira',
            'sábado' => 'sabado',
            'domingo' => 'domingo',
            default => 'terca_feira'
        };
    }
}