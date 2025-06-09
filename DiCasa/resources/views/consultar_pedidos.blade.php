<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pedidos</title>
    <link rel="stylesheet" href="{{ asset('css/consultar_pedidos.css') }}">
</head>
<body>
    <div class="conteudo">
        <div class="cabecalho">
            @include('layouts.navigation')
        </div>
        <div class="main-box">
            <div class="header">  
                <h1>Pedidos</h1>
                <button class="close" onclick="window.location.href='{{ route('telaprincipal') }}'">sair</button>
            </div>

            <div class="order-table">
                <div class="titles">
                    <div>Nome</div>
                    <div>Pedido</div>
                    <div>Hora</div>
                    <div>Entrega/Retirada</div>
                    <div>Produzindo</div>
                    <div>Pronto</div>
                    <div>Entregue</div>
                    <div></div>
                </div>
        
                @foreach($pedidos as $pedido)
                <div class="orders" data-id="{{ $pedido->id }}">
                    <div>{{ $pedido->cliente->nome }}</div>
                    <div>{{ $pedido->pedidoPrato->pluck('prato.nome_prato')->filter()->join(' - ') ?? 'sem prato' }}</div>
                    <div>{{ $pedido->created_at->format('H:i')}}</div>
                    <div>{{ $pedido->modo_retirada}}</div>
                    <div class="checkbox-container">
                        <input type="checkbox" name='esta_produzindo' class="produzindo-checkbox" 
                            {{ $pedido->esta_produzindo ? 'checked' : '' }}>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" name="foi_produzido" class="pronto-checkbox" 
                            {{ $pedido->foi_produzido ? 'checked' : '' }} 
                            {{ !$pedido->esta_produzindo ? 'disabled' : '' }}>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" name="foi_entregue" class="entregue-checkbox" 
                            {{ $pedido->foi_entregue ? 'checked' : '' }} 
                            {{ !$pedido->foi_produzido ? 'disabled' : '' }}>
                    </div>
                    <div class="actions">
                        <button title="cancelar pedido" onclick="abrirModal({{ $pedido->id }})" class="cancel-btn">🗑️</button>
                    </div>
                </div>
                @endforeach
                
                <div id="meuModal" class="modal">
                    <div class="modal-content">
                        <p>Deseja excluir o pedido selecionado?</p>
                        <div class="modal-buttons">
                            <button id="confirmarExclusao" class="confirm-btn">Sim</button>
                            <button onclick="fecharModal()" class="cancel-btn">Não</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <script>
        // Controle do Modal
        let pedidoIdParaExcluir = null;

        function abrirModal(id) {
            pedidoIdParaExcluir = id;
            document.getElementById('meuModal').style.display = 'block';
        }

        function fecharModal() {
            pedidoIdParaExcluir = null;
            document.getElementById('meuModal').style.display = 'none';
        }

        // Exclusão de Pedidos com Animação
        document.getElementById('confirmarExclusao').addEventListener('click', function() {
            if (pedidoIdParaExcluir) {
                excluirPedido(pedidoIdParaExcluir);
            }
        });

        function excluirPedido(id) {
            const row = document.querySelector(`.orders[data-id="${id}"]`);
            row.classList.add('deleting');
            
            fetch(`/pedidos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.ok) {
                    setTimeout(() => row.remove(), 600); // Remove após animação
                } else {
                    row.classList.remove('deleting');
                    alert('Erro ao excluir pedido');
                }
            })
            .catch(error => {
                row.classList.remove('deleting');
                console.error('Erro:', error);
            });
            
            fecharModal();
        }

        // Controle das Checkboxes (mantido igual)
        document.querySelectorAll('.produzindo-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('.orders');
                const prontoCheckbox = row.querySelector('.pronto-checkbox');
                const entregueCheckbox = row.querySelector('.entregue-checkbox');
                
                prontoCheckbox.disabled = !this.checked;
                
                if (!this.checked) {
                    prontoCheckbox.checked = false;
                    entregueCheckbox.checked = false;
                    entregueCheckbox.disabled = true;
                }
                
                atualizarStatus(row.dataset.id, {
                    produzindo: this.checked,
                    pronto: false,
                    entregue: false
                });
            });
        });

        document.querySelectorAll('.pronto-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('.orders');
                const entregueCheckbox = row.querySelector('.entregue-checkbox');
                
                entregueCheckbox.disabled = !this.checked;
                
                if (!this.checked) {
                    entregueCheckbox.checked = false;
                }
                
                atualizarStatus(row.dataset.id, {
                    pronto: this.checked,
                    entregue: false
                });
            });
        });

        document.querySelectorAll('.entregue-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('.orders');
                atualizarStatus(row.dataset.id, {
                    entregue: this.checked
                }).then(response => {
                    if (response.finalizado) {
                        row.classList.add('deleting');
                        setTimeout(() => row.remove(), 600);
                    }
                });
            });
        });

        function atualizarStatus(id, data) {
            return fetch(`/pedidos/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json());
        }

        // Fecha modal ao clicar fora
        window.onclick = function(event) {
            if (event.target === document.getElementById('meuModal')) {
                fecharModal();
            }
        }
    </script>
</body>
</html>