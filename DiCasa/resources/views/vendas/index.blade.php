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
            <form action="./vendas-mensal" class="vendas-mensal">
                <input class="vendas-mensal-botao" type="submit" value="Vendas mensal">
            </form>
            <!-- botao que vai exibir as vendas diarias -->
            <form action="./vendas-diarias" class="vendas-diarias">
                <input class="vendas-diarias-botao" type="submit" value="vendas-diarias">
            </form>
            <!-- botao que vai exibir as vendas por data -->
            <form id="form-buscar-data" class="buscar-por-data-form">
                <div class="buscar-por-data">
                    <label class="buscar-por-data-texto">Buscar por data: </label>
                    <!-- esse eh o input que cria o calendario -->
                    <input type="date" id="buscar-por-data-botao" name="data" value="<?php echo date('Y-m-d'); ?>">
                    <!-- esse eh o input que envia a data que o javacript busca -->
                    <input class="buscar-por-data-enviar" type="submit" value="Buscar">
                </div>
            </form>
        </div>
        <!-- espaco que exibe a tabela de produtos vendidos -->
        <!-- apenas mostra as venads diarias, adicionar os outros -->
        <div class="caixa-inferior">
            <table class="tabela-vendas">
                <thead>
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Pedido</th>
                    <th class="px-4 py-2">Preço</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vendas as $venda)
                    <tr class=\"item-venda\">
                        <td class=\"nome-venda\">{{$venda->nome}} </td>
                        <td class=\"pedido-venda\">{{$venda->pedido}}</td>
                        <td class=\"valor-total-1\">{{$venda->preco}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- espaco ue mostra a quantidade de vendas das marmitas -->
    <div class="caixa-vendas-marmitas">
        <div class="total-vendas-marmitas">
            <h2 class="vendas-marmitas-texto">Marmitas vendidas: </h2>
            <div class="vendas-marmitas-contador"> 14</div>
        </div>
        <button class="ver-mais-botao">Ver mais</button>
    </div>
@endsection


