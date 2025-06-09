@extends('layouts.cadastrar_prato')
@section('titulo', 'Cadastrar Cliente')
@section('conteudo')
    <div class="main">
        <div class="container">
            @include('partials.titulo_texto', ['titulo' => 'Cadastrar Cliente'])
            <form action="{{ route('armazenarcliente') }}" method="POST">
                @csrf
                @include('partials.form_cliente', [
                    'values' => [
                        'nome_cliente' => old('nome'),
                        'logradouro_cliente' => old('enderecos[0][logradouro]'),
                        'bairro_cliente' => old('enderecos[0][bairro]'),
                        'complemento_cliente' => old('enderecos[0][complemento]'),
                        'telefone_cliente' => old('telefones.0'),

                    ],
                    'mascara' => "(99)99999-9999"
                ])
            @include('partials.botao_submit',[
                'textoDoBotao' => 'Cadastrar Cliente'
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