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
                <td>2x</td> 
                <td>Macarrão sem molho</td>
                <td>Média</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
    </div>

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


