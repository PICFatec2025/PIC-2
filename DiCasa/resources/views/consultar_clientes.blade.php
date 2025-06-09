@extends('layouts.consultar_vendas')
@section('titulo', 'Clientes')
@section('conteudo')
    
    <div class="caixa-principal">
        <div class="caixa-topo">
            <h1 class="titulo-texto">Clientes</h1>
            {{-- botao de fechar volta para a tela anterior --}}
            <button class="botao-fechar" onclick="window.location.href='{{ route('telaprincipal') }}'">sair</button>
        </div>
        <div class="tabela-scroll">
            <table class="tabela-vendas">
                <thead class="tabela-topo">
                    <tr class="item-venda">
                        <th class="textos-tabela">Nome</th>
                        <th class="texto-tabela">Logradouro</th>
                        <th class="textos-tabela">Bairro</th>
                        <th class="textos-tabela">Complemento</th>
                        <th class="textos-tabela">Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="item-venda">
                            <td class="textos-tabela">{{$cliente->nome}}</td>
                            {{-- busca todas os endereços daquele cliente e faz a juncao --}}
                            <td class="textos-tabela">{{$cliente->enderecos()->pluck('logradouro')->join(' | ')}}</td>
                            <td class="textos-tabela">{{$cliente->enderecos()->pluck('bairro')->join(' | ')}}</td>
                            <td class="textos-tabela">{{$cliente->enderecos()->pluck('complemento')->join(' | ')}}</td>
                            {{-- busca todas os telefones daquele cliente e faz a juncao --}}
                            <td class="textos-tabela">{{$cliente->telefones()->pluck('telefone')->join(' | ')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tabela-paginacao">
            {{$clientes->links()}}
        </div>
    </div>
@endsection