<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Di Casa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
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
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                    <div class="item">
                        <p class="nome">Nome</p>
                        <p class="pedido">Pedido......</p>
                        <div class="horario">00:00</div>
                    </div>
                </div>
                <div class="btnVerMais">
                    <button type="button" onclick="window.location.href='{{ route('consultarpedidos') }}'">Ver mais</button>
                </div>
            </div>
            <div class="cardapio pedidos">
                <h3> Cardápio</h3>
                <div class="semanal">
                    <h5>Semanal</h5>
                    <hr class="hr">
                    <div class="listaSemanal">
                        <div class="diaSemana">
                            <h4 class="nome">Segunda-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Terça-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                          <button type="button">Editar</button>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Quarta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                        <div  class="diaSemana">
                            <h4 class="nome">Quinta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                        <div  class="diaSemana">
                            <h4 class="nome">Sexta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                        <div  class="diaSemana">
                            <h4 class="nome">Sabádo</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Domingo</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <button type="button">Editar</button>
                        </div>
                    </div>
                </div>
                <div class="especial">
                    <h5>Especial</h5>
                    <hr class="hr">
                    <div class="listaEspecial">
                                                           <div class="item">
                                        <h4 class="nome">Festa Junina</h4>
                                        <p>Comida boa 1, macarrão, etc.</p>
                                        <button type="button">Editar</button>
                                    </div>
                                                    </div>
                    <div class="addEspecial">
                        <button type="button" >Adicionar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="rodape">
            <div class="vendas">
                <h4>Marmitas vendidas:</h4><h4>0</h4><button type='button'>Ver mais</button>          
            </div>
        </div>
    </div>
</body>
</html>