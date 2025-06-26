<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Di Casa</title>
    @vite(['resources/js/filtroPratos.js','resources/css/style.css','resources/css/app.css', 'resources/js/app.js'])
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
                @foreach($pedidos as $pedido)
                    <div class="item">
                        <p class="nome">{{ $pedido->cliente->nome }}</p>
                        <p class="pedido">{{ $pedido->pedidoPrato->pluck('prato.nome_prato')->filter()->join(' - ') ?? "Sem pedido"}}</p>
                        <div class="horario">{{ $pedido->created_at->format('d/m H:i') }}</div>
                    </div>
                @endforeach
            </div>
            <div class="btnVerMais">
                <button type="button" onclick="window.location.href='{{ route('consultarpedidos') }}'">Ver mais</button>
            </div>
        </div>

        <div class="cardapio pedidos">
            <h3>Cardápio</h3>
            <div class="container">
                <div class="semanal">
                    
                    <div class="selecao">
                        <select name="diaDaSemana" id="seletorDia" onchange="mudarDia(this.value)">
                            <option value="terca_feira" {{ $diaAtual == 'terca_feira' ? 'selected' : '' }}>Terça-feira</option>
                            <option value="quarta_feira" {{ $diaAtual == 'quarta_feira' ? 'selected' : '' }}>Quarta-feira</option>
                            <option value="quinta_feira" {{ $diaAtual == 'quinta_feira' ? 'selected' : '' }}>Quinta-feira</option>
                            <option value="sexta_feira" {{ $diaAtual == 'sexta_feira' ? 'selected' : '' }}>Sexta-feira</option>
                            <option value="sabado" {{ $diaAtual == 'sabado' ? 'selected' : '' }}>Sábado</option>
                            <option value="domingo" {{ $diaAtual == 'domingo' ? 'selected' : '' }}>Domingo</option>
                        </select>


                    </div>
                    <div class="listaSemanal" id="listaPratos">
                          @forelse ($pratos as $prato)
                                <div class="diaSemana cadPadrao" style="display: flex;">
                                    <div class="nome">
                                        <h4>{{ $prato->nome_prato }}</h4>
                                    </div>
                                    <p>{{ $prato->descricao }}</p>
                                   <a href="{{ route('editar_prato', $prato->id) }}">
                                        <button>
                                            <img width="15vw" src="/imgs/iconEditar.png" alt="Editar">
                                        </button>
                                    </a>                      
                                </div>
                            @empty
                                <div class="semPratos">
                                    <p>Nenhum prato cadastrado para este dia.</p>
                                </div>
                            @endforelse
                    </div>
                  
                    <div class="adicao">
                        <button onclick="window.location.href='{{ route('criarprato') }}'" class="addPratos">Adicionar Prato</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rodape">
        <div class="vendas">
            <h4>Marmitas vendidas hoje:</h4><h4>{{ $contagemDeMarmitas }}</h4><button type='button' onclick="window.location.href='{{ route('consultarvendas') }}'" class="btn-adicionar">Ver mais</button>
        </div>
    </div>
</div>

<script>
    function mudarDia(dia) {
    window.location.href = '?dia=' + dia;
}
</script>
</body>
</html>
