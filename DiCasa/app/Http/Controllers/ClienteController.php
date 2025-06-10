<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArmazenarClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('telefones')->with('enderecos')->paginate(15);
        return view('consultar_clientes', compact('clientes'));
    }
    public function criarCliente()
    {
        return view('cadastrar_clientes');
    }
    public function armazenarCliente(ArmazenarClienteRequest $request)
    {
        $validated = $request->validated();

        $cliente = Cliente::create([
            'nome' => $validated['nome'],
            'user_id' => auth()->id(),
        ]);

        foreach ($validated['telefones'] as $tel) {
            $cliente->telefones()->create([
                'telefone' => preg_replace('/\D/', '', $tel), // limpa a máscara
            ]);
        }

        // Salvar todos os endereços
        foreach ($validated['enderecos'] as $endereco) {
            $cliente->enderecos()->create($endereco);
        }
        return redirect()->route('telaprincipal')->with('success', 'Cliente criado com sucesso.');
    }
}
