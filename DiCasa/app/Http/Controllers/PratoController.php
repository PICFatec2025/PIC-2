<?php

namespace App\Http\Controllers;
use App\Models\Prato;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    //use App\Models\Prato;
    

    public function store(Request $request)
    {
        $nomes = json_decode($request->input('pratos'));

        foreach ($nomes as $nome) {
            Prato::create([
                'nome_prato' => $nome,
                'descricao' => 'Adicionado via interface rápida',
                'preco_p' => null,
                'preco_m' => null,
                'preco_g' => null,
                'cliente_id' => null
            ]);
        }

        return redirect()->back()->with('success', 'Pratos adicionados com sucesso!');
    }

}
