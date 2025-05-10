
<?php
echo "Olá, Mundo!";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pedido</title>
  <link rel="stylesheet" href="cadastro_pedidoss.css">


 


</head>
<body>

      <img src="https://img.freepik.com/vetores-premium/conceito-de-design-de-logotipo-de-garfo-e-colher_761413-8075.jpg?semt=ais_hybrid"
      width="100" height="100">
    
    
            <button class="sair">Sair</button>
    
    
                      <!--Essa aqui é a primeira div, a que vai cobrir tudo-->
                      <form class="div1">
    
    
                            <!-- Essa é a div 2, onde fica pedido e fechae (verde)-->
                            <div class="div2">
                            <h1>Pedido</h1>
                            <button class="fechar">Fechar</button>
                            </div>
    
    
                                  <!-- Div3 Onde fica nome, endereço, data, telefone e data/hora; (amarela) -->
                                  <div class="div3">
    
    
                                        <!-- Div4 A div para nome (     Laranja amarronzado)-->
                                        <div class="caixa div4">
                                        <h3>Nome</h3>
                                        <input type="text">
                                        </div>
    
    
              <hr>
              <h6>Entrega</h6>
    
    
                                              <!-- Div5: Essa é a div pra endereço, telefone, data e hora (Vermelho) -->
                                              <div class="caixa div5">
    
    
                                                    <!-- Div6 Pra endereço (  Azul ciano)-->
                                                    <div class="caixa div6">
                                                    <h3>Endereço</h3>
                                                    <input type="text">
                                                    </div>
    
    
                                                          <div class="tell_data">
    
    
                                                                 <!-- Div7 a do telefone ( Roxo) -->
                                                                 <div class="caixa div7">
                                                                 <h3>Telefone</h3>
                                                                 <input type="tell">
                                                                 </div>
    
    
                                                                      <!-- Div8 a de data (    Rosa)-->
                                                                      <div class="caixa div8">
                                                                      <h3>Data/Hora</h3>
                                                                      <input type="datetime-local">
                                                                      </div>
    
    
                                                          </div>
                                              </div>
                                  </div>
    
    <!-- Adicionar prato -->
<label class="adicionar-prato-toggle">
      <input type="checkbox" id="mostrar-prato-2">
      + Adicionar mais um prato
    </label>
    
    <!-- Segundo prato -->
    <div class="div10 mostrar-prato" id="prato-2">
      <div class="div11">
        <select name="comida">
          <option value="1">Strogonoff, arroz, feijão</option>
          <option value="2">Macarrão, salada</option>
        </select>
        <select class="select-pequeno">
          <option>P</option>
          <option>M</option>
          <option>G</option>
        </select>
        <select class="select-pequeno">
          <option>1</option><option>2</option><option>3</option>
          <option>4</option><option>5</option><option>6</option>
          <option>7</option><option>8</option><option>9</option><option>10</option>
        </select>
      </div>
    </div>
    
    <!-- Terceiro prato -->
    <label class="adicionar-prato-toggle">
      <input type="checkbox" id="mostrar-prato-3">
      + Adicionar mais um prato
    </label>
    
    <div class="div10 mostrar-prato" id="prato-3">
      <div class="div11">
        <select name="comida">
          <option value="1">Strogonoff, arroz, feijão</option>
          <option value="2">Macarrão, salada</option>
        </select>
        <select class="select-pequeno">
          <option>P</option>
          <option>M</option>
          <option>G</option>
        </select>
        <select class="select-pequeno">
          <option>1</option><option>2</option><option>3</option>
          <option>4</option><option>5</option><option>6</option>
          <option>7</option><option>8</option><option>9</option><option>10</option>
        </select>
      </div>
    </div>
    
        <hr>
        <h6>+</h6>
        <h6>Total R$</h6>
    
            <button class="botao-aceitar" type="submit">Aceitar</button>
                                                                            </div>
                      </form>
    
    
       
      <div class="caixa marmitas-vendidas">
          <h3>Marmitas vendidas: 14</h3>
          <button>Ver mais</button>
      </div>
    
    
    </body>
    </html>
    