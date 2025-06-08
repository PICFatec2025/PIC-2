<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Prato</title>
    <link rel="stylesheet" href="{{ asset('css\cadastro_pedidos.css') }}">
</head>

<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        <div class="main">
            <div class="container">
                <h1>Prato</h1>

                <div class="corpo">
                    <div class="linha1">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome_prato" placeholder="Nome do Prato" maxlength="50"
                            value="{{ old('nome_prato') }}">
                    </div>
                    <div class="linha2">
                        <label for="nome">Descrição: </label>
                        <input type="text" name="descricao_prato" placeholder="Descriçao do Prato" maxlength="200"
                            value="{{ old('descricao_prato') }}">
                    </div>
                    <div class="linha1">
                        <label for="nome">Preco P: </label>
                        <input type="number" name="preco_p" placeholder="Preço para o tamanho P" maxlength="6"
                            inputmode="decimal" value="{{ old('preco_p') }}">
                    </div>
                    <div class="linha1">
                        <label for="nome">Preco M: </label>
                        <input type="number" name="preco_m" placeholder="Preço para o tamanho M" maxlength="6"
                            inputmode="decimal" value="{{ old('preco_p') }}">
                    </div>
                    <div class="linha1">
                        <label for="nome">Preco G: </label>
                        <input type="number" name="preco_m" placeholder="Preço para o tamanho G" maxlength="6"
                            inputmode="decimal" value="{{ old('preco_p') }}">
                    </div>
                </div class="linha1">
                <label for="nome">Disponível em: </label>
                @php
                    $dias = ['terca' => 'Terça-feira', 'quarta' => 'Quarta-feira', 'quinta' => 'Quinta-feira', 'sexta' => 'Sexta-feira', 'sabado' => 'Sábado', 'domingo' => 'Domingo'];
                @endphp

                @foreach($dias as $nome => $label)
                    <div>
                        <label>
                            <input type="checkbox" name="dias[{{ $nome }}]" value="1" {{ old("dias.$nome") ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button class="botaoAceitar">Adicionar prato</button>
        </div>
    </div>
    </div>
</body>


</html>