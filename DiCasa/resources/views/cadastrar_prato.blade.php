<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Prato</title>
    <link rel="stylesheet" href="{{ asset('css\cadastrar_prato.css') }}">
</head>
@csrf

<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        <div class="main">
            <div class="container">
                <h1 class="titulo-texto">Prato</h1>

                <form action="{{ route('armazenarprato') }}" method="POST">
                    @csrf

                    <div class="corpo">
                        <div class="linha1">
                            <label for="nome">Nome: </label>
                            <input type="text" name="nome_prato" class="campo-input" placeholder="Nome do Prato"
                                maxlength="50" value="{{ old('nome_prato') }}">
                        </div>
                        <div class="linha1">
                            <label for="descricao">Descrição: </label>
                            <input type="text" name="descricao" class="campo-input" placeholder="Descrição do Prato"
                                maxlength="200" value="{{ old('descricao') }}">
                        </div>
                        <div class="linha1">
                            <label for="preco_p">Preco P: </label>
                            <input type="number" step="0.01" name="preco_p" class="campo-input" placeholder="Preço para o tamanho P"
                                inputmode="decimal" value="{{ old('preco_p') }}">
                        </div>
                        <div class="linha1">
                            <label for="preco_m">Preco M: </label>
                            <input type="number" step="0.01" name="preco_m" class="campo-input" placeholder="Preço para o tamanho M"
                                inputmode="decimal" value="{{ old('preco_m') }}">
                        </div>
                        <div class="linha1">
                            <label for="preco_g">Preco G: </label>
                            <input type="number" step="0.01" name="preco_g" class="campo-input" placeholder="Preço para o tamanho G"
                                inputmode="decimal" value="{{ old('preco_g') }}">
                        </div>

                        <label for="dias">Disponível em: </label>
                        @php
                            $dias = ['terca_feira' => 'Terça-feira', 'quarta_feira' => 'Quarta-feira', 'quinta_feira' => 'Quinta-feira', 'sexta_feira' => 'Sexta-feira', 'sabado' => 'Sábado', 'domingo' => 'Domingo'];
                        @endphp

                        @foreach($dias as $nome => $label)
                            <div>
                                <label>
                                    <input type="checkbox" name="dias[{{ $nome }}]" value="1" {{ old("dias.$nome") ? 'checked' : '' }}>
                                    {{ $label }}
                                </label>
                            </div>
                        @endforeach

                        <button type="submit" class="botaoAceitar">Adicionar prato</button>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>