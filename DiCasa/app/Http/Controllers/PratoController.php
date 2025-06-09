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


        return redirect()->back()->with('message', 'Pratos adicionados com sucesso!');
    }
    public function criarPrato(Request $request){
        return view('cadastrar_prato');
    }
    public function armazenarPrato(SalvaPratoRequest $request){
        //cria um prato novo
        $prato = new Prato($request->validated());
        //busca o id do usuario atual
        $prato->user_id = auth()->id();
        //salva o prato
        $prato->save();
        //cria o está disponível do respectivo prato
        $prato->estaDisponivel()->create($request->dias);
        //volta para a tela principal com mensagem de sucesso
        return redirect()->route('telaprincipal')->with('message','Prato adicionado com sucesso');
    }
    public function editarPrato(string $id){
        //se nao encontrar o prato, ele volta para a tela principal
        if(!$prato = Prato::find($id)){
            return redirect()->route('telaprincipal')->with('message','Prato não encontrado');
        }
        //se encontrar vai para a tela de edicao
        return view('editar_prato',compact('prato'));
    }
    public function alterarPrato(SalvaPratoRequest $request, string $id){
        //se nao encontrar o prato, ele volta para a tela principal
        if(!$prato = Prato::find($id)){
            return redirect()->route('telaprincipal')->with('message','Prato não encontrado');
        }
        //caso haja uma verificacao de usuario, implementaremos essa funcao
        // if (!$prato || $prato->user_id !== auth()->id()) {
        //     return redirect()->route('telaprincipal')->with('message','Acesso negado ao prato');
        // }
        //atualiza o prato
        $prato->update($request->validated());
        //se existe o esta disponivel, atualiza, se não, cria um novo
        if ($prato->estaDisponivel) {
            $prato->estaDisponivel()->update($request->dias);
        } else {
            $prato->estaDisponivel()->create($request->dias);
        }
        //volta para a tela principal com mensagem de sucesso
        return redirect()->route('telaprincipal')->with('message','Prato alterado com sucesso');
    }
}
