<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Di Casa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .oculto {
            display: none;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="cabecalho">
        @include('layouts.navigation')
    </div>
    <div class="corpo">
        <div class="pedidos">
            <h3>Pedidos</h3>
            <div class="addPedido">
                <button type="button" onclick="window.location.href='{{ route('cadastrarpedidos') }}'">Adicionar pedido</button>
            </div>
            <div class="lista">
                @for ($i = 0; $i < 10; $i++)
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                @endfor
            </div>
            <div class="btnVerMais">
                <button type="button" onclick="window.location.href='{{ route('consultarpedidos') }}'">Ver mais</button>
            </div>
        </div>

        <div class="cardapio pedidos">
            <h3>Cardápio</h3>
            <div class="container">
                <div class="semanal">
                    <h5>Semanal</h5>
                    <hr class="hr">
                    <div class="listaSemanal">
                        @php
                            $dias = [
                                'segunda' => 'Segunda-Feira',
                                'terca' => 'Terça-Feira',
                                'quarta' => 'Quarta-Feira',
                                'quinta' => 'Quinta-Feira',
                                'sexta' => 'Sexta-Feira',
                                'sabado' => 'Sábado',
                                'domingo' => 'Domingo',
                            ];
                        @endphp

                        @foreach ($dias as $diaId => $diaNome)
                            <div id="edit-{{ $diaId }}" class="diaDaSemana diaSemana oculto">
                                <h4>{{ $diaNome }}</h4>
                                <div class="container">
                                    <p id="listaPratos-{{ $diaId }}" class="listaPratos"></p>
                                    <input type="text" id="inputPrato-{{ $diaId }}" class="input-padrao selecionadoInp" placeholder="Digite o nome do prato...">
                                    <button type="button" onclick="adicionarPrato('{{ $diaId }}')" class="btn-adicionar selecionadoBtn" title="Adicionar prato">+</button>

                                    <form method="POST" action="{{ route('pratos.store') }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="pratos[{{ $diaId }}]" id="pratosInput-{{ $diaId }}">
                                        <button type="submit" id="btnOk-{{ $diaId }}" style="display: none;" class="btn-confirmar">Ok</button>
                                    </form>
                                </div>
                            </div>
                            <div id="padrao-{{ $diaId }}" class="diaSemana cadPadrao">
                                <h4 class="nome">{{ $diaNome }}</h4>
                                <p>Comida boa 1, macarrão, etc.</p>
                                <button type="button" onclick="mostrarEdicao('{{ $diaId }}')" id="btnEditar-{{ $diaId }}" class="btn-adicionar">Editar</button>
                            </div>
                        @endforeach
                    </div>

                    <div class="especial">
                        <h5>Especial</h5>
                        <hr class="hr">
                        <div class="listaEspecial">
                            <div class="item">
                                <h4 class="nome">Festa Junina</h4>
                                <p>Comida boa 1, macarrão, etc.</p>
                                <button type="button" class="btn-adicionar">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="addEspecial">
                <button type="button" class="btn-adicionar">Adicionar</button>
            </div>
        </div>
    </div>
    <div class="rodape">
        <div class="vendas">
            <h4>Marmitas vendidas:</h4><h4>0</h4><button type='button' onclick="window.location.href='{{ route('consultarvendas') }}'" class="btn-adicionar">Ver mais</button>
        </div>
    </div>
</div>

<script>
    const pratosPorDia = {};

    function adicionarPrato(diaId) {
        const input = document.getElementById(`inputPrato-${diaId}`);
        const nome = input.value.trim();
        if (!pratosPorDia[diaId]) pratosPorDia[diaId] = [];

        if (nome !== "") {
            pratosPorDia[diaId].push(nome);
            atualizarVisualizacao(diaId);
            input.value = "";
        }
    }

    function atualizarVisualizacao(diaId) {
        const p = document.getElementById(`listaPratos-${diaId}`);
        const hiddenInput = document.getElementById(`pratosInput-${diaId}`);
        p.textContent = pratosPorDia[diaId].join(', ');
        hiddenInput.value = JSON.stringify(pratosPorDia[diaId]);
    }

    function mostrarEdicao(diaId) {
        document.getElementById(`edit-${diaId}`).classList.remove('oculto');
        document.getElementById(`edit-${diaId}`).style.display = 'inline-block';
        document.getElementById(`padrao-${diaId}`).classList.add('oculto');
        document.getElementById(`btnEditar-${diaId}`).style.display = 'none';
        document.getElementById(`edit-${diaId}`).style.flexDirection  = "column";
        document.getElementById(`btnOk-${diaId}`).style.display = 'inline-block';
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Botão "Ok" de todos os dias esconde edição
        const dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];
        dias.forEach(dia => {
            const btnOk = document.getElementById(`btnOk-${dia}`);
            if (btnOk) {
                btnOk.addEventListener('click', () => {
                    document.getElementById(`edit-${dia}`).classList.add('oculto');
                    document.getElementById(`edit-${diaId}`).style.display = 'inline-block';
                    document.getElementById(`padrao-${dia}`).classList.remove('oculto');
                    document.getElementById(`btnEditar-${dia}`).style.display = 'inline-block';
                    btnOk.style.display = 'none';
                });
            }
        });
    });
</script>

</body>
</html>