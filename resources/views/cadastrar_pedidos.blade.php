<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Pedido</title>
  
     <link rel="stylesheet" href="{{ asset('css\cadastro_pedidos.css') }}">
</head>
<body>
  <div class="container">
    <h1>Pedido</h1>

    <div id="clientes-container">
      <div class="cliente">
        <h2>Cliente</h2>
        <label>Nome</label>
        <input type="text" placeholder="Digite o nome" />

        <label>Itens</label>
        <div class="itens">
          <select><option>Comida 1</option><option>Comida 2</option></select>
          <select><option>P</option><option>M</option><option>G</option></select>
          <select><option>1</option><option>2</option><option>3</option></select>
        </div>

        <label>Obs</label>
        <input type="text" placeholder="Observações" />
      </div>
    </div>

    <button class="botao" onclick="adicionarPessoa()">+ cliente</button>

    <div class="resumo">
      <h3>Resumo</h3>
      <div class="linha">
        <span>Nome</span><span>Pedido</span><span>00,00 R$</span>
      </div>
      <div class="total"><strong>Total:</strong> <span>00,00 R$</span></div>
    </div>

    <button class="botao" id="btnEntrega">Entrega <img src="" alt=""> </button>

    <div class="entrega" id="infoEntrega">
      <input type="text" placeholder="Endereço" />
      <div class="linha">
        <input type="tel" placeholder="Telefone" />
        <input type="datetime-local" />
      </div>
    </div>

    <button class="botao aceitar">Aceitar</button>
  </div>

  <script>
    function adicionarPessoa() {
      const container = document.getElementById("clientes-container");
      const pessoaOriginal = container.querySelector(".cliente");
      const novaPessoa = pessoaOriginal.cloneNode(true);
      const total = container.querySelectorAll(".cliente").length + 1;

      novaPessoa.querySelector("h2").textContent = `cliente ${total}`;
      novaPessoa.querySelectorAll("input").forEach(i => i.value = "");
      novaPessoa.querySelectorAll("select").forEach(s => s.selectedIndex = 0);

      const remover = document.createElement("button");
      remover.className = "remover-cliente";
      remover.textContent = "×";
      remover.onclick = () => novaPessoa.remove();
      novaPessoa.style.position = "relative";
      novaPessoa.appendChild(remover);

      container.appendChild(novaPessoa);
    }

    document.getElementById("btnEntrega").addEventListener("click", () => {
      const entrega = document.getElementById("infoEntrega");
      entrega.style.display = entrega.style.display === "block" ? "none" : "block";
    });
  </script>
</body>
</html>


