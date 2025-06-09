<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvaPratoRequest;
use App\Models\Prato;
use Carbon\Carbon;

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

    public function armazenarPrato(SalvaPratoRequest $request)
    {
        $prato = new Prato($request->validated());
        $prato->user_id = auth()->id();
        $prato->save();
        $prato->disponibilidade()->create($request->dias);
        return redirect()->route('telaprincipal')->with('success', 'Prato adicionado com sucesso');
    }

    public function toggleDisponibilidade($id)
    {
        $prato = Prato::findOrFail($id);
        // Aqui você pode fazer toggle true/false
        $prato->disponivel = !$prato->disponivel;
        $prato->save();

        return redirect()->route('telaprincipal')->with('success', 'Disponibilidade do prato alterada.');
    }

    public function tornarIndisponivelHoje($id)
    {
        $prato = Prato::findOrFail($id);

        $diaHoje = match (Carbon::now()->locale('pt_BR')->dayName) {
            'segunda-feira' => null,
            'terça-feira' => 'terca_feira',
            'quarta-feira' => 'quarta_feira',
            'quinta-feira' => 'quinta_feira',
            'sexta-feira' => 'sexta_feira',
            'sábado' => 'sabado',
            'domingo' => 'domingo',
            default => null,
        };

        if (!$diaHoje) {
            return redirect()->back()->with('error', 'Não é possível tornar indisponível em segunda-feira.');
        }

        $disponibilidade = $prato->disponibilidade;
        if (!$disponibilidade) {
            $disponibilidade = $prato->disponibilidade()->create([
                'terca_feira' => false,
                'quarta_feira' => false,
                'quinta_feira' => false,
                'sexta_feira' => false,
                'sabado' => false,
                'domingo' => false,
            ]);
        }

        $disponibilidade->$diaHoje = false;
        $disponibilidade->save();

        return redirect()->back()->with('success', 'Prato marcado como indisponível para hoje.');
    }
}
