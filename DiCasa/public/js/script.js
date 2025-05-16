//funcao que busca a data inserida no input do tipo date
document.getElementById('form-buscar-data').addEventListener('submit', function(e) {
    //evita o valor atual da url
    e.preventDefault();
    //recebe o valor da data do input
    const dataSelecionada = document.getElementById('buscar-por-data-botao').value;
    //insere o link com a data selecionada
    window.location.href = '/?vendas-por-data=' + encodeURIComponent(dataSelecionada);
});
