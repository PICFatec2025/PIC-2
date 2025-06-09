<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>{{ isset($prato) ? 'Editar Prato' : 'Cadastrar Prato' }}</title>
    <link rel="stylesheet" href="{{ asset('css/cadastrar_prato.css') }}">
</head>
<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        <div class="main">
            <div class="container">
                <h1 class="titulo-texto">{{ isset($prato) ? 'Editar Prato' : 'Cadastrar Prato' }}</h1>

                <form 
                    action="{{ isset($prato) ? route('atualizarprato', $prato->id) : route('armazenarprato') }}" 
                    method="POST">
                    @csrf
                    @if(isset($prato))
                        @method('PUT')
                    @endif

                    <div class="corpo">
                        <div class="linha1">
                            <label for="nome">Nome: </label>
                            <input type="text" name="nome_prato" class="campo-input" placeholder="Nome do Prato"
                                maxlength="50" value="{{ old('nome_prato', $prato->nome_prato ?? '') }}">
                        </div>

                        <div class="linha1">
                            <label for="descricao">Descrição: </label>
                            <input type="text" name="descricao" class="campo-input" placeholder="Descrição do Prato"
                                maxlength="200" value="{{ old('descricao', $prato->descricao ?? '') }}">
                        </div>

                        <div class="linha1">
                            <label for="preco_p">Preço P: </label>
                            <input type="number" step="0.01" name="preco_p" class="campo-input" inputmode="decimal"
                                placeholder="Preço para o tamanho P" value="{{ old('preco_p', $prato->preco_p ?? '') }}">
                        </div>

                        <div class="linha1">
                            <label for="preco_m">Preço M: </label>
                            <input type="number" step="0.01" name="preco_m" class="campo-input" inputmode="decimal"
                                placeholder="Preço para o tamanho M" value="{{ old('preco_m', $prato->preco_m ?? '') }}">
                        </div>

                        <div class="linha1">
                            <label for="preco_g">Preço G: </label>
                            <input type="number" step="0.01" name="preco_g" class="campo-input" inputmode="decimal"
                                placeholder="Preço para o tamanho G" value="{{ old('preco_g', $prato->preco_g ?? '') }}">
                        </div>

                        <label for="dias">Disponível em: </label>
                        @php
                            $dias = [
                                'terca_feira' => 'Terça-feira',
                                'quarta_feira' => 'Quarta-feira',
                                'quinta_feira' => 'Quinta-feira',
                                'sexta_feira' => 'Sexta-feira',
                                'sabado' => 'Sábado',
                                'domingo' => 'Domingo',
                            ];

                            $diasDisponiveis = old('dias', isset($prato) && $prato->disponibilidade ? $prato->disponibilidade->toArray() : []);
                        @endphp

                        @foreach ($dias as $nome => $label)
                            <div>
                                <label>
                                    <input type="checkbox" name="dias[{{ $nome }}]" value="1"
                                        {{ !empty($diasDisponiveis[$nome]) ? 'checked' : '' }}>
                                    {{ $label }}
                                </label>
                            </div>
                        @endforeach

                        <button type="submit" class="botaoAceitar">
                            {{ isset($prato) ? 'Editar Prato' : 'Adicionar Prato' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
