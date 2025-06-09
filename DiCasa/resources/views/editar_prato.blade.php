@extends('layouts.cadastrar_prato')    
@section('titulo','Editar prato')
@section('conteudo')
    <div class="main">
        <div class="container">
            @include('partials.titulo_texto',['titulo' => 'Editar Prato'])
            <form action="{{ route('alterar_prato',$prato->id) }}" method="POST">
                @csrf
                @method('put')
                @php
                    $disponibilidade = $prato->estaDisponivel;
                    $diasSelecionados = [];

                    if ($disponibilidade) {
                        foreach (['terca_feira', 'quarta_feira', 'quinta_feira', 'sexta_feira', 'sabado', 'domingo'] as $dia) {
                            $diasSelecionados[$dia] = $disponibilidade->$dia ? true : false;
                        }
                    }
                @endphp
                @include('partials.form_prato', [
                    'values' => [
                        'nome_prato' =>  $prato->nome_prato ?? old('nome_prato'),
                        'descricao' => $prato->descricao ?? old('descricao'),
                        'preco_p' => $prato->preco_p ?? old('preco_p'),
                        'preco_m' => $prato->preco_m ?? old('preco_m'),
                        'preco_g' => $prato->preco_g ?? old('preco_g'),
                    ],
                    'selected' => old('dias', $diasSelecionados),
                    'textoDoBotao' => 'Editar Prato'
                ])
            </form>
        </div>
    </div>
@endsection