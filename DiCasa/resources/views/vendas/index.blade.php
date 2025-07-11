@extends('vendas.layout.app')
@section('titulo','Vendas')
@section('conteudo')
<div class="caixa-principal">
    <div class="caixa-topo">
        <h1 class="titulo-texto">Vendas</h1>
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
                    <th class="textos-tabela">Pedido</th>
                    <th class="textos-tabela">Hora/data</th>
                    <th class="textos-tabela">Preço</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendas as $venda)
                <tr class="item-venda">
                    <td class="textos-tabela">{{ $venda->nome }}</td>
                    <td class="textos-tabela">{{ $venda->pedido }}</td>
                    <td class="textos-tabela">{{$venda->created_at->format('H:i d/m')}}</td>
                    <td class="textos-tabela">{{ $venda->preco_convertido() }}</td>
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
