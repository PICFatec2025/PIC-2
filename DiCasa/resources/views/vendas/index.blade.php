@extends('vendas.layout.app')
@section('titulo','Vendas')
@section('conteudo')
    <div class="caixa-principal">
        <div class="caixa-topo">
            <h1 class="titulo-texto">Vendas</h1>
            <button class="botao-sair">Fechar</button>
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
                    <input type="date" name="data" value="{{ date('Y-m-d') }}">
                    <input class="buscar-por-data-enviar" type="submit" value="Buscar">
                </div>
            </form>
        </div>
        <!-- espaco que exibe a tabela de produtos vendidos -->
        <!-- apenas mostra as venads diarias, adicionar os outros -->
        <div class="overflow-auto max-h-96">
            <table class="tabela-vendas table-fixed w-full">
                <thead class="bg-gray-100 sticky top-0">
                <tr>
                    <th class="px-4 py-2 w-1/3 text-left">Nome</th>
                    <th class="px-4 py-2 w-1/3 text-left">Pedido</th>
                    <th class="px-4 py-2 w-1/3 text-left">Preço</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vendas as $venda)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $venda->nome }}</td>
                        <td class="px-4 py-2">{{ $venda->pedido }}</td>
                        <td class="px-4 py-2">{{ $venda->preco_convertido() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{$vendas->links()}}
        </div>
    </div>
    <!-- espaco ue mostra a quantidade de vendas das marmitas -->
    <div class="caixa-vendas-marmitas">
        <div class="total-vendas-marmitas">
            <h2 class="vendas-marmitas-texto">Marmitas vendidas: </h2>
            <div class="vendas-marmitas-contador"> {{$contagem}}</div>
        </div>
        <button class="ver-mais-botao">Ver mais</button>
    </div>
@endsection


