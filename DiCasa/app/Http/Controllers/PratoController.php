<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvaPratoRequest;
use App\Models\Prato;
use Carbon\Carbon;
use App\Models\PedidoPrato;

class PratoController extends Controller
{


    public function criarPrato($id = null)
    {
        $prato = null;

        if ($id !== null) {
            $prato = Prato::findOrFail($id);
        }

        return view('cadastrar_prato', compact('prato'));
    }

    public function atualizarPrato(SalvaPratoRequest $request, $id)
    {
        $prato = Prato::findOrFail($id);
        $prato->update($request->validated());

        if ($prato->disponibilidade) {
            $prato->disponibilidade->update($request->dias);
        } else {
            $prato->disponibilidade()->create($request->dias);
        }

        return redirect()->route('telaprincipal')->with('success', 'Prato atualizado com sucesso');
    }

    public function armazenarPrato(SalvaPratoRequest $request){
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
