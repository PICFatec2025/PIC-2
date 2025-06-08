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

            Prato::create([
                'nome_prato' => 'nome',
                'descricao' => 'descricao',
                'preco_p' => null,
                'preco_m' => null,
                'preco_g' => null,
                'cliente_id' => null
            ]);
            
        dd($request->input('pratos'));


        return redirect()->back()->with('success', 'Pratos adicionados com sucesso!');
    }
    public function criarPrato(Request $request){
        return view('cadastrar_prato');
    }
}
