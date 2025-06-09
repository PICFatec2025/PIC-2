
export function filtrarPratosPorDia(diaSelecionado) {
    const listaPratos = document.getElementById('listaPratos');
    const itensPrato = listaPratos.querySelectorAll('.diaSemana');
    const semPratosMsg = document.getElementById('semPratos');
    let pratosVisiveis = 0;

    itensPrato.forEach(prato => {
        const diasDisponiveis = JSON.parse(prato.dataset.dias);
        const deveMostrar = Array.isArray(diasDisponiveis)
            ? diasDisponiveis.includes(diaSelecionado)
            : diasDisponiveis[diaSelecionado] === true;

        prato.style.display = deveMostrar ? 'flex' : 'none';

        if (deveMostrar) pratosVisiveis++;
    });

    semPratosMsg.style.display = pratosVisiveis > 0 ? 'none' : 'block';
}

