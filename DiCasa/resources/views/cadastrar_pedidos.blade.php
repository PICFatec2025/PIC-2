<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Pedido</title>
    <link rel="stylesheet" href="{{ asset('css/cadastro_pedidos.css') }}">
</head>
<body>
    <div class="conteudo">
        <div class="cabecalho">@include('layouts.navigation')</div>
        <div class="main">
            <div class="container">
                <h1>Pedido</h1>

                <div class="corpo">
                    <div class="linha1">
                        <label for="nome">Nome do Cliente</label>
                        <input type="text" name="nome" id="nomeCliente" required>
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
                        <input type="number" name="tEntrega" id="taxaEntrega" value="0" style="padding: 0; width: 5vw; border-radius:5px;" min="0" step="0.01">
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
                    </div>
                </div>
                <div class="total">
                    <h3>Total: <span id="totalPedido">0.00</span> R$</h3>
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
                    <input type="hidden" name="modo_retirada" id="hiddenModoRetirada">
                </form>
            </div>
        </div>
    </div>

    <script>
        const pratosSelecionados = [];
        let alternar = 1;

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

        document.querySelector('.adicionarPrato').addEventListener('click', async function () {
            const pratoSelect = document.querySelector('.itens');
            const tamanhoSelect = document.querySelector('.tamanho');
            const quantidadeInput = document.querySelector('.quantidade');

            const pratoId = pratoSelect.value;
            const pratoNome = pratoSelect.options[pratoSelect.selectedIndex].text;
            const tamanho = tamanhoSelect.value;
            const quantidade = quantidadeInput.value;

            const response = await fetch(`/prato/${pratoId}/precos`);
            const precos = await response.json();

            let preco = 0;
            switch (tamanho) {
                case 'pequena': preco = precos.p; break;
                case 'media': preco = precos.m; break;
                case 'grande': preco = precos.g; break;
            }

            pratosSelecionados.push({
                prato_id: pratoId,
                nome: pratoNome,
                tamanho: tamanho,
                quantidade: quantidade,
                preco: preco
            });

            atualizarTabela();
            await atualizarTotal();
        });

        function atualizarTabela() {
            const tbody = document.getElementById('itens-tbody');
            tbody.innerHTML = '';

            pratosSelecionados.forEach((item, index) => {
                const novaLinha = document.createElement('tr');
                novaLinha.innerHTML = `
                    <td class="qtdT2">${item.quantidade}x</td>
                    <td class="pratoT2">${item.nome}</td>
                    <td class="tamanhoT2">${item.tamanho}</td>
                    <td><button type="button" onclick="removerItem(${index})">Remover</button></td>
                `;
                tbody.appendChild(novaLinha);
            });

            ajustarAlturaTbody();
        }

        async function removerItem(index) {
            pratosSelecionados.splice(index, 1);
            atualizarTabela();
            await atualizarTotal();
        }

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

        async function atualizarTotal() {
            let total = 0;
            for (const item of pratosSelecionados) {
                total += item.preco * item.quantidade;
            }

            const taxaEntrega = parseFloat(document.getElementById('taxaEntrega').value) || 0;
            total += taxaEntrega;

            document.getElementById('totalPedido').textContent = total.toFixed(2);
        }

        document.getElementById('taxaEntrega').addEventListener('change', atualizarTotal);

        document.getElementById('formPedido').addEventListener('submit', function (e) {
            e.preventDefault();

            const nome = document.getElementById('nomeCliente').value;
            const obs = document.getElementById('observacoesTextarea').value;
            const formPag = document.getElementById('formaPagamento').value;
            const taxaEntrega = document.getElementById('taxaEntrega').value;
            const endereco = document.getElementById('enderecoInput').value.trim();
            const telefone = document.getElementById('telefoneInput').value;

            const modoRetirada = endereco !== '' ? 'Entrega' : 'Retirada';

            document.getElementById('hiddenNome').value = nome;
            document.getElementById('hiddenObs').value = obs;
            document.getElementById('hiddenPratos').value = JSON.stringify(pratosSelecionados);
            document.getElementById('hiddenFormPag').value = formPag;
            document.getElementById('hiddenTaxaEntrega').value = taxaEntrega;
            document.getElementById('hiddenEndereco').value = endereco;
            document.getElementById('hiddenTelefone').value = telefone;
            document.getElementById('hiddenModoRetirada').value = modoRetirada;

            this.submit();
        });
    </script>
</body>
</html>
