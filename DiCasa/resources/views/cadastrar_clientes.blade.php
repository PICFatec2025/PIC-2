@extends('layouts.cadastrar_prato')    
@section('titulo','Cadastrar Cliente')
@section('conteudo')
    <div class="main">
        <div class="container">
            @include('partials.titulo_texto',['titulo' => 'Cadastrar Cliente'])
            <form action="{{ route('armazenarprato') }}" method="POST">
                @csrf
                @include('partials.form_cliente',[
                    'values' =>[
                        'nome_cliente' => old('nome_cliente'),
                        'logradouro_cliente' => old('logradouro_cliente'),
                        'bairro_cliente' => old('bairro_cliente'),
                        'complemento_cliente' => old('complemento_cliente'),
                        'telefone_cliente' => old('telefone_cliente'),
                        
            ],
            'mascara' => "(99)99999-9999"
                ])
        </div>
    </div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('[data-mask]').forEach(function(input) {
                Inputmask(input.dataset.mask).mask(input);
            });
        });
    </script>
@endsection
@endsection