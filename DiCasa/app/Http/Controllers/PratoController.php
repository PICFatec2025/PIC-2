<?php

namespace App\Http\Controllers;
use App\Http\Requests\SalvaPratoRequest;
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
    public function armazenarPrato(SalvaPratoRequest $request){
        $prato = new Prato($request->validated());
        $prato->user_id = auth()->id();
        $prato->save();
        $prato->estaDisponivel()->create($request->dias);
        return redirect()->route('telaprincipal')->with('success','Prato adicionado com sucesso');
    }
}
