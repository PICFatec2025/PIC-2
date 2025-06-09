<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;

class TelaPrincipalController extends Controller
{
    
    public function index(Request $request)
    {
        
        $diaSelecionado = strtolower($request->get('dia', $this->getDiaAtual()));
        
       $pratos = Prato::whereHas('disponibilidade', function($query) use ($diaSelecionado) {
            $query->where($diaSelecionado, true);
        })->with('disponibilidade')->get();


        return view('TelaPrincipal', [
            'pratos' => $pratos,
            'diaAtual' => $diaSelecionado
        ]);

    }

    private function getDiaAtual()
    {
        return match (strtolower(now()->locale('pt_BR')->dayName)) {
            'terça-feira'   => 'terça_feira',
            'quarta-feira'  => 'quarta_feira',
            'quinta-feira'  => 'quinta_feira',
            'sexta-feira'   => 'sexta_feira',
            'sábado'        => 'sabado_feira',
            'domingo'       => 'domingo_feira',
            default         => 'terca_feira'
        };
    }
}