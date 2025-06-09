<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Pedido</title>
    <link rel="stylesheet" href="{{ asset('css\cadastro_pedidos.css') }}">
</head>

<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        <div class="main">
            <div class="container">
                <h1>Pedido</h1>

                <div class="corpo">
                    <div class="linha1">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nomeCliente">
                    </div>
                    <div class="linha2">
                        <label for="nome">Item</label>
                        <select name="itens" class="itens">
                            @foreach ($pratos as $prato)
                                <option value="{{ $prato->id }}">{{ $prato->nome_prato }}</option>
                            @endforeach
                        </select>

                        <select name="Tamanho" class="tamanho">
                            <option value="pequena">P</option>
                            <option value="media">M</option>
                            <option value="grande">G</option>
                        </select>
                        <input type="number" name="quantidade" value="1" class="quantidade" min="1">
                        <button type="button" class="adicionarPrato">Adicionar</button>
                    </div>
                </div>

                <div class="linha4">
                    <label for="obs">Observações</label>
                    <textarea name="obs" class="observacoes" id="observacoesTextarea"></textarea>
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="itens-tbody">
                                <!-- Itens serão adicionados aqui via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="linha5">
                    <div class="CPagamento">
                        <label for="formPag" class="formPag">Forma de pagamento</label>
                        <select name="formPag" class="itens" id="formaPagamento">
                            <option value="PIX">PIX</option>
                            <option value="CartaoDebito">Cartão débito</option>
                            <option value="CartaoCredito">Cartão crédito</option>
                            <option value="Dinheiro">Dinheiro</option>
                        </select>
                    </div>
                    <div class="CEntrega">
                        <label for="tEntrega" class="taxaEntrega">Taxa de entrega</label>
                        <select name="tEntrega" class="itens" id="taxaEntrega">
                            <option value="Perto">Perto</option>
                            <option value="Proximo">Próximo</option>
                            <option value="Longe">Longe</option>
                            <option value="Rural">Rural</option>
                        </select>
                    </div>
                </div>

                <div class="btnEntrega">
                    <button type="button" class="botaoEntrega" id="toggleEntrega">Entrega</button>
                    <img class="setaImg" src="{{ asset('imgs/setaBaixo.png') }}" alt="">
                </div>
                <hr>
                <div class="entrega">
                    <div class="endereco">
                        <label for="endereco">Endereço</label>
                        <input name="endereco" type="text" placeholder="Endereço" id="enderecoInput">
                    </div>
                    <div class="linha">
                        <label for="telefone">Telefone</label>
                        <input type="tel" name="telefone" placeholder="Telefone" id="telefoneInput">
                        <label id="dt" for="datahora">Data Hora</label>
                        <input type="datetime-local" id="dataHoraInput">
                    </div>
                </div>
                <div class="total">
                    <h3>Total: <span id="totalPedido">00,00</span> R$</h3>
                </div>
                <form method="POST" action="{{ route('pedidos.store') }}" id="formPedido">
                    @csrf
                    <button type="submit" class="botaoAceitar" id="botaoAceitar">Aceitar</button>
                    <input type="hidden" name="nome" id="hiddenNome">
                    <input type="hidden" name="obs" id="hiddenObs">
                    <input type="hidden" name="pratos_json" id="hiddenPratos">
                    <input type="hidden" name="formPag" id="hiddenFormPag">
                    <input type="hidden" name="tEntrega" id="hiddenTaxaEntrega">
                    <input type="hidden" name="endereco" id="hiddenEndereco">
                    <input type="hidden" name="telefone" id="hiddenTelefone">
                
                </form>

            </div>
        </div>
    </div>

    <!-- Formulário oculto para envio -->
   
    <script>
        const pratosSelecionados = [];
        let alternar = 1;

        // Toggle da seção de entrega
        document.getElementById('toggleEntrega').addEventListener('click', () => {
            const entrega = document.querySelector('.entrega');
            const imagem = document.querySelector('.setaImg');

            entrega.classList.toggle('mostrar');

            if (alternar === 0) {
                imagem.src = "{{ asset('imgs/setaBaixo.png') }}";
                alternar = 1;
            } else {
                imagem.src = "{{ asset('imgs/setaCima.png') }}";
                alternar = 0;
            }
        });

        // Adicionar prato à tabela
        document.querySelector('.adicionarPrato').addEventListener('click', function() {
            const pratoSelect = document.querySelector('.itens');
            const tamanhoSelect = document.querySelector('.tamanho');
            const quantidadeInput = document.querySelector('.quantidade');

            const pratoId = pratoSelect.value;
            const pratoNome = pratoSelect.options[pratoSelect.selectedIndex].text;
            const tamanho = tamanhoSelect.value;
            const quantidade = quantidadeInput.value;

            // Adiciona ao array de pratos
            pratosSelecionados.push({
                prato_id: pratoId,
                nome: pratoNome,
                tamanho: tamanho,
                quantidade: quantidade
            });

            // Atualiza a tabela
            atualizarTabela();
            atualizarTotal();
        });

        // Atualiza a tabela de itens
        function atualizarTabela() {
            const tbody = document.getElementById('itens-tbody');
            tbody.innerHTML = '';

            pratosSelecionados.forEach((item, index) => {
                const novaLinha = document.createElement('tr');
                novaLinha.innerHTML = `
                    <td class="qtdT2">${item.quantidade}x</td>
                    <td class="pratoT2">${item.nome}</td>
                    <td class="tamanhoT2">${item.tamanho}</td>
                    <td><button onclick="removerItem(${index})">Remover</button></td>
                `;
                tbody.appendChild(novaLinha);
            });

            ajustarAlturaTbody();
        }

        // Remove item da tabela
        function removerItem(index) {
            pratosSelecionados.splice(index, 1);
            atualizarTabela();
            atualizarTotal();
        }

        // Ajusta altura da tabela
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

        // Envia o formulário
        document.getElementById('formPedido').addEventListener('submit', function(e) {
            e.preventDefault();

            // Preenche os campos ocultos
            document.getElementById('hiddenNome').value = document.getElementById('nomeCliente').value;
            document.getElementById('hiddenObs').value = document.getElementById('observacoesTextarea').value;
            document.getElementById('hiddenPratos').value = JSON.stringify(pratosSelecionados);
            document.getElementById('hiddenFormPag').value = document.getElementById('formaPagamento').value;
            document.getElementById('hiddenTaxaEntrega').value = document.getElementById('taxaEntrega').value;
            document.getElementById('hiddenEndereco').value = document.getElementById('enderecoInput').value;
            document.getElementById('hiddenTelefone').value = document.getElementById('telefoneInput').value;

            this.submit();
        });


        function atualizarTotal() {
  
            const total = pratosSelecionados.reduce((sum, item) => sum + (item.quantidade * 10), 0);
            document.getElementById('totalPedido').textContent = total.toFixed(2);
        }
    </script>
</body>
</html>