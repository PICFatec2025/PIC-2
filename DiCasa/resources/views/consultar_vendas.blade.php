@extends('layouts.consultar_vendas')
@section('titulo', 'Vendas')
@section('conteudo')
    <div class="barra_navegador">
        @include('layouts.navigation')
    </div>
    <div class="caixa-principal">
        <div class="caixa-topo">
            <h1 class="titulo-texto">Vendas</h1>
            {{-- botao de fechar volta para a tela anterior --}}
            <button class="botao-fechar" onclick="window.location.href='{{ route('telaprincipal') }}'">sair</button>
        </div>
        <!-- espaco dos botoes -->
        <div class="caixa-botao-vendas">
            <!-- botao que vai exibir as vendas mensais -->
            <form method="GET" action="{{ url()->current() }}">
                <input type="hidden" name="vendas" value="mensal">
                <input class="vendas-mensal-botao" type="submit" value="Vendas mensal">
            </form>

            <form method="GET" action="{{ url()->current() }}">
                <input type="hidden" name="vendas" value="diarias">
                <input class="vendas-diarias-botao" type="submit" value="Vendas diárias">
            </form>
            <!-- botao que vai exibir as vendas por data -->
            <form method="GET" action="{{ url()->current() }}" class="buscar-por-data-form">
                <div class="buscar-por-data">
                    <label class="buscar-por-data-texto">Buscar por data:</label>

                    <input type="date" name="data_inicio" required>
                    <span>até</span>
                    <input type="date" name="data_fim" required>

                    <input class="buscar-por-data-enviar" type="submit" value="Buscar">
                </div>
            </form>

        </div>
        <!-- espaco que exibe a tabela de produtos vendidos -->
        <!-- apenas mostra as venads diarias, adicionar os outros -->
        <div class="tabela-scroll">
            <table class="tabela-vendas">
                <thead class="tabela-topo">
                    <tr class="item-venda">
                        <th class="textos-tabela">Nome</th>
                        <th class="texto-tabela-pedido">Pedido</th>
                        <th class="textos-tabela">Data/Hora</th>
                        <th class="textos-tabela">Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendas as $venda)
                        <tr class="item-venda">
                            <td class="textos-tabela">{{$venda->cliente->nome}}</td>
                            {{-- busca todas os pratos daquele pedido, coleta os nomes dos pratos e faz a juncao --}}
                            <td class="textos-tabela texto-tabela-pedido">
                                {{ $venda->pedidoPrato->pluck('prato.nome_prato')->filter()->join(' - ') ?? 'sem prato' }}</td>
                            <td class="textos-tabela">{{$venda->created_at->format('d/m H:i')}}</td>
                            {{-- a funcao de conversao de preco esta no arquivo app/helpers.php --}}
                            <td class="textos-tabela">{{ precoConvertidoEmReais($venda->total_preco) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tabela-paginacao">
            {{$vendas->links()}}
        </div>
    </div>
@endsection