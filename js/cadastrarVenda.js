limparPagina()

function deletandoProdutosSelecionadosAposCadastrar(){
    let inserirProduto = [...document.getElementById('inserirProdutoFinal').children]
    console.log(inserirProduto)
    if (inserirProduto.length > 0) {
        inserirProduto.map((value) => {
            value.remove()
        })
    }
    limparPagina()
}


//APLICA EVENTO NA TABLE DE PRODUTOS AO CARREGAR A PAGINA
function limparPagina() {
    document.getElementById('valorTotal').value = ''
    document.getElementById('filterProduto').value = ''
    document.getElementById('filterCliente').value = ''
    document.getElementById('entrega').value = ''
    document.getElementById('contaFinal').value = ''
    document.getElementById('desconto').value = ''
    document.getElementById('dataEntrega').value = ''
    document.getElementById('observacaoTextArea').value = ''

    try {
        document.querySelector('input[name=radioClientes]:checked').checked = false
    } catch { }

    try {
        document.querySelector('input[name=radioProdutos]:checked').checked = false
    } catch { }

    let dataDaVenda = document.getElementById('dataDaVenda')
    dataDaVenda.value = new Date().toLocaleDateString();

    //LIMPANDO O SELECT
    var text = 'Selecione';
    var select = document.querySelector('#funcionarioEscolhido');
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].text === text) {
            select.selectedIndex = i;
            break;
        }
    }

    var text = 'Selecione';
    var select = document.querySelector('#statusPagamento');
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].text === text) {
            select.selectedIndex = i;
            break;
        }
    }
}

