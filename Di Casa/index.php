<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Di Casa</title>
    <link rel="stylesheet" href="style_index.css">
</head>
<body>
    <div class="main">
        <div class="cabecalho">
            <div class="logo">
                <h1>LOGO</h1>
            </div>
            <div class="btnSair">
                <button type="button">Sair</button>
            </div>
        </div>
        <div class="corpo">
            <div class="pedidos">
                <h3>Pedidos</h3>
                <div class="addPedido">
                    <button type="button">Adicionar pedido</button>
                </div>
                <div class="lista">
                    <?php
                        for($i = 0; $i < 3; $i++){
                            ?>
                                <div class="item">
                                    <p class="nome">Nome</p>
                                    <p class="pedido">Pedido......</p>
                                    <div class="horario">00:00</div>
                                    <div class="btnAceitar"><button type="button">Aceitar</button></div>
                                </div>
                            <?php
                        } 
                    ?>
                </div>
                <div class="btnVerMais">
                    <button type="button">Ver mais</button>
                </div>
            </div>
            <div class="cardapio pedidos">
                <div class="semanal">
                    <h5>Semanal</h5>
                    <hr>
                    <div class="listaSemanal">
                        <div class="diaSemana">
                            <h4 class="nome">Segunda-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Terça-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Quarta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Quinta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Sexta-Feira</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Sabádo</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                        <div class="diaSemana">
                            <h4 class="nome">Domingo</h4>
                            <p>Comida boa 1, macarrão, etc.</p>
                            <div class="Editar"><button type="button">Editar</button></div>
                        </div>
                    </div>
                </div>
                <div class="especial">
                    <h5>Especial</h5>
                    <hr>
                    <div class="listaEspecial">
                        <?php
                            for($i = 0; $i < 1; $i++){
                                ?>
                                   <div class="item">
                                        <h4 class="nome">Festa Junina</h4>
                                        <p>Comida boa 1, macarrão, etc.</p>
                                        <div class="Editar"><button type="button">Editar</button></div>
                                    </div>
                                <?php
                            } 
                        ?>
                    </div>
                    <div class="addEspecial">
                        <button type="button">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="rodape">
            <div class="vendas">
                <?php
                    $vendas = 0;
                    echo "<h4>Vendidas: {$vendas} </h4> <button type='button'>Ver mais</button>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>