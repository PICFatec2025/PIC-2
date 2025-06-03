<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!cria resposividade-->
    <title>Pedidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-box">
        <div class="header">  
            <h1>Pedidos</h1>
            <button class="close">sair</button> 
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
    
            <div class="orders">
                <div>Cliente</div>
                <div>Frango Assado</div>
                <div>12:45</div>
                <div>Retirada</div>
                <div class="checkbox-container"><input type="checkbox" name="status" value="produzindo"></div>
                <div class="checkbox-container"><input type="checkbox" name="status" value="pronto"></div>
                <div class="checkbox-container"><input type="checkbox" name="status" value="entregue"></div>
                <div class="actions"><button title="cancelar pedido" onclick="abrirModal()" class="cancel-btn">🗑️</button></div>
            </div>

                <div id="meuModal" class="modal">
                    <div class="modal-content">
                        <p>Deseja excluir o pedido selecionado?</p>
                        <button onclick="fecharModal()">Sim</button>
                        <button onclick="fecharModal()">Não</button>
                    </div>
                </div>
            
        </div> 
    </div>

    <div class="vendas">
        <div class="header">
            <h2>Marmitas Vendidas:</h2>
            <div class="contador">14</div>
        </div>
        <button class="ver-mais">Ver mais</button>
    </div>

    <script>
        function abrirModal(){
            document.getElementById('meuModal').style.display = 'block';
        }
        function fecharModal(){
            document.getElementById('meuModal').style.display = 'none';
        }
        window.onclick = function(event) {
    const modal = document.getElementById('meuModal');
    if (event.target === modal) {
        fecharModal();
    }
}
    </script>
</body>
</html>