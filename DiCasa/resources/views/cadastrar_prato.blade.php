@extends('layouts.cadastrar_prato')    
@section('titulo','Cadastrar prato')
@section('conteudo')
    <div class="main">
        <div class="container">
            @include('partials.titulo_texto',['titulo' => 'Cadastrar Prato'])
            <form action="{{ route('armazenarprato') }}" method="POST">
                @csrf
                @include('partials.form_prato', [
                    'values' => [
                        'nome_prato' => old('nome_prato'),
                        'descricao' => old('descricao'),
                        'preco_p' => old('preco_p'),
                        'preco_m' => old('preco_m'),
                        'preco_g' => old('preco_g'),
                    ],
                    'selected' => [],
                    'textoDoBotao' => 'Cadastrar Prato'
                ])
            </form>
        </div>
    </div>
@endsection
