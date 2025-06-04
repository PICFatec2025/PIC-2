<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Pedido</title>

    <link rel="stylesheet" href="{{ asset('css\cadastro_pedidos.css') }}">

</head>

<body style="flex-direction: column;">
<div class="cabecalho" >@include('layouts.navigation')</div>
<div class="main" >

    <div class="container">
        <h1>Pedido</h1>

        <div class="corpo">
            <div class="linha1">
                <label for="nome">Nome</label>
                <input type="text" name="nome">
            </div>
            <div class="linha2">
                <label for="nome">Item</label>
                <select name="itens" class="itens">
                    <option value="Frango">Frango</option>
                    <option value="Mandioca">Mandioca</option>
                    <option value="Linguiça">Linguiça</option>
                </select>
                <select name="Tamanho" class="tamanho">
                    <option value="pequena">P</option>
                    <option value="media">M</option>
                    <option value="grande">G</option>
                </select>
                <input type="number" name="quantidade" value="1" class="quantidade">
                <button class="adicionarPrato">Adicionar</button>
            </div>
        </div>

        <div class="linha4">
            <label for="obs">Observações</label>
            <textarea name="obs" class="observacoes"></textarea>
        </div>
        <hr>
        <h3>Total Pedidos</h3>
        <div class="linha3">
            <div class="pedidos">
                <table>
                    <thead>
                        <tr>
                            <th class="qtdT">Qtd</th>
                            <th class="pratoT">Prato</th>
                            <th class="tamanhoT">Tamanho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="qtdT2">2x</td>
                            <td class="pratoT2">Macarrão sem molho</td>
                            <td class="tamanhoT2">Média</td>
                        </tr>
                        
                    </tbody>
                    
                </table>
            </div>
        </div>

        <div class="linha5">
            <div class="CPagamento">
                <label for="formPag" class="formPag">Forma de pagamento</label>
                <select name="formPag" class="itens">
                    <option value="PIX">PIX</option>
                    <option value="CartaoDebito">Cartão débito</option>
                    <option value="CartaoCredito">Cartão crédito</option>
                    <option value="Dinheiro">Dinheiro</option>
                </select>
            </div>
            <div class="CEntrega">
                <label for="tEntrega" class="taxaEntrega">Taxa de entrega</label>
                <select name="tEntrega" class="itens">
                    <option value="Perto">Perto</option>
                    <option value="Proximo">Próximo</option>
                    <option value="Longe">Longe</option>
                    <option value="Rural">Rural</option>
                </select>
            </div>

        </div>
        <div class="btnEntrega">
            <button class="botaoEntrega" onClick="mostraEntrega()">Entrega </button>
            <img class="setaImg" src="{{ asset('imgs/setaBaixo.png') }}" alt="">
            
        </div>
        <hr>        
        <div class="entrega">
            <div class="endereco">
                <label for="endereco">Endereço</label>
                <input name="endereco" type="text" placeholder="Endereço" />
            </div>

            <div class="linha">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" placeholder="Telefone" />
                <label id="dt" for="datahora">Data Hora</label>
                <input type="datetime-local" />
            </div>
        </div>
        <div class="total">
            <h3>Total: 00,00 R$</h3>
        </div>
        <button class="botaoAceitar">Aceitar</button>
    </div>
</div>
    <script>
        var alternar = 1;

        document.querySelector(".btnEntrega").addEventListener("click", () => {
            const entrega = document.querySelector(".entrega");
            const imagem = document.querySelector(".setaImg");

            entrega.classList.toggle("mostrar");

            if (alternar == 0) {
                imagem.src = "{{ asset('imgs/setaBaixo.png') }}";
                alternar = 1;
            } else {
                imagem.src = "{{ asset('imgs/setaCima.png') }}";
                alternar = 0;
            }
        });
        function ajustarAlturaTbody() {
            const tbody = document.querySelector('tbody');
            const linhas = tbody.querySelectorAll('tr').length;

            if (linhas === 1) {
                tbody.style.height = '6vh';
            } else if (linhas === 2) {
                tbody.style.height = '10vh';
            } else {
                tbody.style.height = '18vh';
            }
        }

        ajustarAlturaTbody();

    </script>

</body>

</html>