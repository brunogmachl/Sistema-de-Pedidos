//##IMPORTANTE##  AO EDITAR UMA COMPRA P VALOR TOTAL É EDITADO NO PHP PARA O FORMATO DE MOEDA BR//
window.onload = function () {
    //CONVERTENDO PRODUTOS PARA MOEDA NACIONAL NO CARREGAMENTO DA PAGINA
    converterMoedaNacional()
    //DIRECIONANDO O MOUSE PARA O FILTRO CLIENTE
    document.getElementById('filterCliente').focus()
}
let produtoSelecionado = []

//ARMAZENA O VALOR DOS PRODUTOS SELECIONADO,
let valorReferencia = []


//COLETA AS INFORMACOES AO ADICIONAR UM PRODUTO E INSERE NO ARRAY DE PRODUTO SELECIONADO
function escolhendoProduto() {
    let produtoSelecionadoRadio = document.querySelector('input[name=radioProdutos]:checked')
    if (produtoSelecionadoRadio) {
        produtoSelecionado['id'] = produtoSelecionadoRadio.parentElement.parentElement.children[1].innerHTML
        produtoSelecionado['produto'] = produtoSelecionadoRadio.parentElement.parentElement.children[2].innerHTML
        produtoSelecionado['valor'] = totalReferencia(produtoSelecionadoRadio.parentElement.parentElement.children[3].innerHTML)
    } else {
        alert('Necessario selecionar um produto')
        return false
    }
}


//ARMAZENANDO REFERENCIA DO VALOR TOTAL PARA CALCULOS
function totalReferencia(referenciaValorTotal) {
    if (referenciaValorTotal.length < 7) {
        referenciaValorTotal = dezanaUSA(referenciaValorTotal)
    } else {
        referenciaValorTotal = milharUSA(referenciaValorTotal)
    }
    return referenciaValorTotal
}

//FUNCAO QUE TRANFORMA NUMERO MILHAR EM FORMATO US
function milharUSA(totalInicial) {
    return (totalInicial.replace(/^(\d*)?(.)(\d*)?(,|.)(\d*)?$/, "$1$3.$5"))
}

//FUNCAO QUE TRANFORMA NUMERO DEZENA EM FORMATO US
function dezanaUSA(totalInicial) {
    return totalInicial.replace(',', '.')

}

//SOMANDO OU SUBTRAINDO VALOR TOTAL
function SomaSubtracaoValorTotal(valorAtual, valorProduto, operador = "") {
    if (operador == '+') {
        valorAtual = parseFloat(valorAtual) + parseFloat(valorProduto)
    } else {
        valorAtual = parseFloat(valorAtual) - parseFloat(valorProduto)
    }
    inserirValor = document.getElementById('valorTotal')
    document.getElementById('valorTotal').value = valorAtual.toLocaleString('pt-br', { minimumFractionDigits: 2 })
    document.getElementById('contaFinal').value = valorAtual.toLocaleString('pt-br', { minimumFractionDigits: 2 })
    let referenciaValorTotal = valorAtual.toLocaleString('pt-br', { minimumFractionDigits: 2 })
    let retornoValor = totalReferencia(referenciaValorTotal)
    valorReferencia.push(retornoValor)
}

//AJAX ATUALIZAR VENDA
function ajaxCadastrarPedidoFinal(tabelaProdutosFinal) {
    //PEGANDO METHODO DA URL PRA USAR COMO REFERENCIA SE É ATUALIZAR OU CADASTRAR UMA VENDA
    const urlParams = new URLSearchParams(window.location.search);
    let metodo = urlParams.get('metodo') == 'editarVendas' ? 'atualizar' : 'cadastrar';
    let instancia = urlParams.get('metodo') == 'editarVendas' ? 'updateVenda' : 'cadastrarVenda';
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '/lenny/app/construct/ajax.php', false)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send('classe=' + 'chamadaAjax'
        + '&metodo=' + 'atualizarCadastrarVenda'
        + `&${metodo}=` + JSON.stringify(tabelaProdutosFinal)
        + '&instancia=' + instancia
    )

    if (xhr.readyState == 4 && xhr.status == 200) {
        alert((xhr.response))
        window.location.href = "/lenny/index.php?metodo=consultarVendas";
        // window.history.back(false)
    }
}

//SOMANDO VALORES DO TOTAL
function calculoValorPedidoTotal(valorProduto) {
    let valorAtual
    let totalInicial = (document.getElementById('valorTotal').value)
    // SE FOR MENOR QUE SETE NAO ESTA NA CASA DO MILHAR 
    if (totalInicial.length < 7) {
        valorAtual = totalInicial == "" ? 0.00 : dezanaUSA(totalInicial)
    } else {
        valorAtual = milharUSA(totalInicial)
    }
    //SE FOR UM ARRAY O VALOR DO PRODUTO SERA SUBTRAIDO DO VALOR TOTAL
    if (Array.isArray(valorProduto)) {
        valorProduto = valorProduto['excluido'].length > 6 ? milharUSA(valorProduto['excluido']) : dezanaUSA(valorProduto['excluido'])
        SomaSubtracaoValorTotal(valorAtual, valorProduto, '-')
    } else {
        SomaSubtracaoValorTotal(valorAtual, valorProduto, '+')
    }
}

//CRIA BLOCO TR-HTML DE PRODUTO SELECIONADO
function inserirProdutoFinal(produtoSelecionado, valorProduto) {

    let inserirProduto = document.getElementById('inserirProdutoFinal')
    let addProdutoTR = document.createElement('tr')
    addProdutoTR.setAttribute('class', 'produtosEscolhidosTr')
    inserirProduto.appendChild(addProdutoTR)

    let trTabelaProdutoFinal = inserirProduto.lastElementChild

    let addProdutoTd = document.createElement('td')
    let addProdutoInput = document.createElement('input')
    let inserindoAtributo = trTabelaProdutoFinal.appendChild(addProdutoTd).appendChild(addProdutoInput)
    inserindoAtributo.setAttribute('type', 'radio')
    inserindoAtributo.setAttribute('name', 'radioProdutosFinal')

    let addProdutoTdId = document.createElement('td')
    trTabelaProdutoFinal.appendChild(addProdutoTdId)
    addProdutoTdId.innerHTML = produtoSelecionado['id']

    let addProdutoTdProduto = document.createElement('td')
    trTabelaProdutoFinal.appendChild(addProdutoTdProduto)
    addProdutoTdProduto.innerHTML = produtoSelecionado['produto']

    let addProdutoTdQuantidadeProduto = document.createElement('td')
    trTabelaProdutoFinal.appendChild(addProdutoTdQuantidadeProduto)
    addProdutoTdQuantidadeProduto.innerHTML = produtoSelecionado['quantidadeProduto']

    let addProdutoTdTotal = document.createElement('td')
    trTabelaProdutoFinal.appendChild(addProdutoTdTotal)
    addProdutoTdTotal.innerHTML = produtoSelecionado['total']

    //DIRECIONANDO BARRA DE ROLAGEM PARA O FINAL
    let barraDeRolagem = document.querySelector('.produtoFinal')
    barraDeRolagem.scrollTop = barraDeRolagem.scrollHeight

    calculoValorPedidoTotal(valorProduto)
}

// AJAX CLIENTE
var filterCliente = document.getElementById('filterCliente')
filterCliente.addEventListener('input', (valor) => {
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '/lenny/app/construct/ajax.php', false)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send("classe=" + 'chamadaAjax' + '&metodo=' + 'ajaxFiltroConsultaCadastoVenda' + "&clientesAjax=" + filterCliente.value + '&metodoStatic=' + 'ajaxFiltro')
    if (xhr.readyState == 4 && xhr.status == 200) {
        let retorno = xhr.responseText.replace(/\"/g, '')
        let clientes = [...document.getElementById('clientes').children]
        clientes.map((value) => {
            value.remove()
        })
        let element = document.querySelector('#clientes')
        element.innerHTML = retorno
        eventClickNaLinhaProdutosClientes('clientes','filterProduto')
    }
})

//EVENTO DE ENTER NO FILTER CLIENTE
filterCliente.addEventListener('keypress', (value) => {
    if (value.key === 'Enter') {
        if (document.getElementById('clientes').firstElementChild.firstElementChild !== null) {
            let PrimeiroProdutoLista = document.getElementById('clientes').firstElementChild.firstElementChild.firstElementChild
            PrimeiroProdutoLista.checked = true
            //REDIRECIONA O MOUSE
            PrimeiroProdutoLista.focus()
        }
    }
})


// AJAX PRODUTO
var filterProduto = document.getElementById('filterProduto')
filterProduto.addEventListener('input', (valor) => {
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '/lenny/app/construct/ajax.php', false)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send("classe=" + 'chamadaAjax' + '&metodo=' + 'ajaxFiltroConsultaCadastoVenda' + '&produtosAjax=' + filterProduto.value + '&metodoStatic=' + 'ajaxProdutos')
    if (xhr.readyState == 4 && xhr.status == 200) {
        let retorno = xhr.responseText.replace(/\"/g, '')
        let clientes = [...document.getElementById('produtos').children]
        clientes.map((value) => {
            value.remove()
        })
        let element = document.querySelector('#produtos')
        element.innerHTML = retorno
        eventClickNaLinhaProdutosClientes('produtos','quantidadeProduto')
        converterMoedaNacional()
    }
}
)


// EVENTO DE CLICK NO CHECKBOX DO PRODUTO OU CLIENTES
function eventClickNaLinhaProdutosClientes(classeTbody, idRedirecionarInput) {
    let produtoClienteRadio = [...document.getElementById(`${classeTbody}`).children]
    produtoClienteRadio.map((linhaProdutoCliente) => {
        linhaProdutoCliente.addEventListener('click', () => {
            linhaProdutoCliente.firstElementChild.firstElementChild.checked = true
        })
    })
    //EVENTO DE ENTER NO CHECKBOX DO PRODUTO
    produtoClienteRadio.map((linhaProdutoCliente) => {
        linhaProdutoCliente.addEventListener('keypress', () => {
            document.getElementById(`${idRedirecionarInput}`).focus()

        })
    })
}

//EVENTO DE ENTER NO FILTER PRODUTO
filterProduto.addEventListener('keypress', (value) => {
    if (value.key === 'Enter') {
        if (document.getElementById('produtos').firstElementChild.firstElementChild !== null) {
            let PrimeiroProdutoLista = document.getElementById('produtos').firstElementChild.firstElementChild.firstElementChild
            PrimeiroProdutoLista.checked = true
            //REDIRECIONA O MOUSE
            PrimeiroProdutoLista.focus()
        }
    }
})


//FUNCAO CHAMADA EM EVENTOS DE CLICK E ENTER NA TAG INPUT
function clickEnterVendas() {
    document.getElementById('entrega').value = ''
    document.getElementById('desconto').value = ''
    //CODIGO ABAIXO REPOEM O VALOR TOTAL AFIM DE EVITAR CONFLITO COM O CAMPO DE DESCONTO OU ENTREGA
    if (valorReferencia.length != 0) {
        document.getElementById('contaFinal').value = parseFloat(valorReferencia[(valorReferencia.length) - 1]).toLocaleString('pt-br', { minimumFractionDigits: 2 })
    }
    //VERIFICANDO SE O PRODUTO FOI SELECIONADO
    if (escolhendoProduto() == false) {
        return
    }
    produtoSelecionado['quantidadeProduto'] = document.getElementById('quantidadeProduto').value
    document.getElementById('quantidadeProduto').value = ''
    if (!produtoSelecionado['quantidadeProduto'] || isNaN(produtoSelecionado['quantidadeProduto'])) {
        return
    }
    document.getElementById(`produto${produtoSelecionado['id']}`).checked = false
    let valorTotal = parseFloat((produtoSelecionado['quantidadeProduto'] * produtoSelecionado['valor']).toFixed(2))
    if(valorTotal > 1000000){
        alert('Quantidade nao permitida!')
        return
    }
    produtoSelecionado['total'] = valorTotal.toLocaleString('pt-br', { minimumFractionDigits: 2 });
    inserirProdutoFinal(produtoSelecionado, valorTotal)
    //SE DER TUDO CERTO NA INSERCAO DO PRODUTO O MOUSE SERA REDIRECIONADO PARA O FILTER
    document.getElementById("filterProduto").focus();
    produtoSelecionado = []
}

//CRIANDO ARRAY DO PRODUTO SELECIONADO AO CLICAR EM ADICIONAR
let adicionar = document.getElementById('adicionar')
adicionar.addEventListener('click', () => {
    clickEnterVendas()
})

// DETECTANDO O ENTER DENTRO DO INPUT ENVIAR
const input = document.querySelector("#quantidadeProduto");
input.addEventListener("keyup", ({ key }) => {
    if (key === "Enter") {
        clickEnterVendas()
    }
})

//DELETANDO PRODUTO SELECIONADO
let remover = document.getElementById('remover')
let precoProdutoExcluido = []
remover.addEventListener('click', () => {
    let checkedSelecionado = document.querySelector('input[name=radioProdutosFinal]:checked')
    if (checkedSelecionado) {
        document.getElementById('entrega').value = ''
        document.getElementById('desconto').value = ''
        //CODIGO ABAIXO REPOEM O VALOR TOTAL AFIM DE EVITAR CONFLITO COM O CAMPO DE DESCONTO OU ENTREGA
        if (valorReferencia.length != 0) {
            document.getElementById('contaFinal').value = parseFloat(valorReferencia[(valorReferencia.length) - 1]).toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
        precoProdutoExcluido['excluido'] = document.querySelector('input[name=radioProdutosFinal]:checked').parentElement.parentElement.lastElementChild.innerHTML.replace(',', '.')
        calculoValorPedidoTotal(precoProdutoExcluido)
        document.querySelector('input[name=radioProdutosFinal]:checked').parentElement.parentElement.remove()
    } else {
        alert('Necessario selecionar um produto para remover')
    }

})


//DELETANDO CARACTERES INVALIDOS NOS CAMPOS DESCONTO E ENTREGA
function deletandoCaracterInvalido(id) {
    caracterInvalido = document.getElementById(`${id}`).value
    numeroValido = caracterInvalido.substring(0, caracterInvalido.length - 1)
    caracterInvalido = document.getElementById(`${id}`).value = ""
    document.getElementById(`${id}`).value = numeroValido
}


const valorTotalAtual = document.getElementById('valorTotal')
let desconto = document.getElementById('desconto')
let entrega = document.getElementById('entrega')
const contaFinal = document.getElementById('contaFinal')

//ACRESCIMO DA ENTREGA
entrega.addEventListener('input', () => {
    if (isNaN(entrega.value) && entrega.value != '0') {
        alert('Numero Inválido')
        deletandoCaracterInvalido('entrega')
        return
    }
    else if (!isNaN(entrega.value) && entrega.value != "") {
        //CODIGO INCLUIDO PRA TER VALOR FINAL DE REFERENCIA POR TER CARREGADO TODAS AS INFORMACOES DE FORMA AUTOMATICA
        if (valorReferencia.length == 0) {
            let retornoValor = totalReferencia(valorTotalAtual.value)
            valorReferencia.push(retornoValor)
        }
        let valorPosDesconto = (parseFloat(valorReferencia[(valorReferencia.length) - 1]) + parseFloat(entrega.value))
        contaFinal.value = parseFloat(valorPosDesconto - (desconto.value == "" ? 0 : (valorReferencia[(valorReferencia.length) - 1] * (desconto.value / 100)))).toLocaleString('pt-br', { minimumFractionDigits: 2 }).toString(2)
        return
    } else if (entrega.value == "") {
        let retornoValor = totalReferencia(valorTotalAtual.value)
        valorReferencia.push(retornoValor)
        let valorPosDesconto = (parseFloat(valorReferencia[(valorReferencia.length) - 1]) - 0)
        contaFinal.value = parseFloat(valorPosDesconto - (desconto.value == "" ? 0 : (valorReferencia[(valorReferencia.length) - 1] * (desconto.value / 100)))).toLocaleString('pt-br', { minimumFractionDigits: 2 }).toString(2)
        return
    }
})

//SUBTRAÇÃO DO DESCONTO 
desconto.addEventListener('input', () => {

    if (isNaN(desconto.value) && desconto.value != '0') {
        alert('Numero Inválido')
        deletandoCaracterInvalido('desconto')
        return
    }

    else if (!isNaN(desconto.value) && desconto.value != "") {
        if (valorReferencia.length == 0) {
            let retornoValor = totalReferencia(valorTotalAtual.value)
            valorReferencia.push(retornoValor)
        }
        let valorPosDesconto = ((parseFloat(valorReferencia[(valorReferencia.length) - 1]) * parseFloat(100 - parseFloat(desconto.value)) / 100)) + parseFloat(entrega.value == "" ? 0 : entrega.value)

        contaFinal.value = valorPosDesconto.toLocaleString('pt-br', { minimumFractionDigits: 2 }).toString(2)
        return
    } else if (desconto.value == "") {
        let retornoValor = totalReferencia(valorTotalAtual.value)
        valorReferencia.push(retornoValor)
        let valorPosDesconto = parseFloat(valorReferencia[(valorReferencia.length) - 1]) + parseFloat(entrega.value == "" ? 0 : entrega.value)
        contaFinal.value = valorPosDesconto.toLocaleString('pt-br', { minimumFractionDigits: 2 }).toString(2)
        return
    }
})

//INSERINDO DIA DA ENTREGA NO CAMPO OBSERVAÇÃO APARTIR DO  VALUE DO CAMPO DATA DE ENTREGA(FINAL)
let entregaPedido = (document.getElementById('dataEntrega'))
let observacao = (document.getElementById('observacaoTextArea'))
entregaPedido.addEventListener('input', (value) => {
    let data = new Date(entregaPedido.value);
    let radioClientes = document.querySelector('input[name=radioClientes]:checked')
    if (radioClientes != null) {
        var telefoneCliente = radioClientes.parentElement.parentElement.children[8].innerHTML
        telefoneCliente = `, CLIENTE Nº${telefoneCliente}`
    }else{
        telefoneCliente = ''
    }
    observacao.value = `ENTREGA PARA O DIA ${data.getDate() <= 9 ? '0' + data.getDate() : data.getDate()}/${(data.getMonth() + 1) <= 9 ? '0' + (data.getMonth() + 1) : data.getMonth() + 1}/${data.getFullYear() <= 9 ? '0' + data.getFullYear() : data.getFullYear()} AS ${data.getHours() <= 9 ? '0' + data.getHours() : data.getHours()}:${data.getMinutes() <= 9 ? '0' + data.getMinutes() : data.getMinutes()}${telefoneCliente} `
})

//ENVIANDO FORMULARIO APOS O USUARIO CADASTRAR USUARIO
let cadastrarProdutoBanco = document.getElementById('cadastrar')
cadastrarProdutoBanco.addEventListener('click', () => {
    //ARRAY PRINCIPAL
    let tabelaProdutosFinal = {}
    //VALIDANDO SE O CLIENTE FOI ADICIONADO
    let radioClientes = document.querySelector('input[name=radioClientes]:checked')
    if (radioClientes == null) {
        alert('Necessário selecionar um cliente')
        return
    } else {
        let dadosClientesArray = []
        let dadosClientes = [...radioClientes.parentNode.parentNode.children]
        dadosClientesArray.push(dadosClientes[1].innerHTML == "" ? 'nao preenchido' : dadosClientes[1].innerHTML)
        dadosClientesArray.push(dadosClientes[2].innerHTML == "" ? 'nao preenchido' : dadosClientes[2].innerHTML)
        dadosClientesArray.push(dadosClientes[8].innerHTML == "" ? 'nao preenchido' : dadosClientes[8].innerHTML)
        tabelaProdutosFinal.cliente = (dadosClientesArray)

    }
    //VALIDANDO SE TEM PRODUTO
    let produtoTr = [...document.querySelectorAll('.produtosEscolhidosTr')]
    if (produtoTr.length == 0) {
        alert('Necessário selecionar um produto')
        return
    }

    //PEGANDO O FUNCIONARIO
    let select = document.getElementById("funcionarioEscolhido");
    let funcionarioEscolhido = select.options[select.selectedIndex].value;
    if (funcionarioEscolhido == "") {
        alert('Necessario selecionar um funcionario')
        return
    }

    //PEGANDO STATUS DO PAGAMENTO
    let select1 = document.getElementById("statusPagamento");
    let statusPagamento = select1.options[select1.selectedIndex].value;
    if (statusPagamento == "") {
        alert('Necessario selecionar o status do pagamento')
        return
    }

    //PEGANDO A FORMA DE PAGAMENTO
    let select2 = document.getElementById("formaPagamento");
    let formaPagamento = select2.options[select2.selectedIndex].value;
    if (formaPagamento == "Em aberto" && statusPagamento == "Finalizado") {
        alert('Necessario selecionar o forma de pagamento pois a venda está como Finalizada')
        return
    }else if(formaPagamento != "Em aberto" && statusPagamento == "Em aberto"){
        alert('Necessario Finalizar o status da compra para inserir o tipo de pagamento')
        return
    }

    //PEGANDO HORA DA ENTREGA DO PEDIDO
    let entregaPedido = (document.getElementById('dataEntrega').value)
    if (entregaPedido == "") {
        alert('Necessario selecionar uma data para entregar o produto')
        return
    }


    //PEGANDO TEXTO DA OBSERVAÇÃO
    let observacao = (document.getElementById('observacaoTextArea').value)
    if (observacao == "") {
        alert('Necessario selecionar uma observação')
        return
    }
    


    //PEGANDO VALOR DO DESCONTO
    let desconto = (document.getElementById('desconto').value) == '' ? 0 : document.getElementById('desconto').value

    //PEGANDO VALOR DA ENTREGA
    let entrega = (document.getElementById('entrega').value) == '' ? 0 : document.getElementById('entrega').value

    //PEGANDO VALOR TOTAL DE PRODUTOS
    let valorTotal = (document.getElementById('valorTotal').value) == '' ? 0 : document.getElementById('valorTotal').value

    //PEGANDO VALOR FINAL DE PRODUTOS
    let contaFinal = (document.getElementById('contaFinal').value) == '' ? 0 : document.getElementById('contaFinal').value



    //SE CHEGOU AQUI TUDO ESTA OK
    tabelaProdutosFinal.funcionario = (funcionarioEscolhido)
    //NOVOS
    tabelaProdutosFinal.valorTotal = totalReferencia(valorTotal)
    tabelaProdutosFinal.contaFinal = totalReferencia(contaFinal)
    //FIM DOS NOVOS
    tabelaProdutosFinal.desconto = (desconto)
    tabelaProdutosFinal.entrega = (entrega)
    tabelaProdutosFinal.observacao = (observacao)
    tabelaProdutosFinal.dataEntregaProduto = (entregaPedido)
    tabelaProdutosFinal.statusPagamento = (statusPagamento)
    tabelaProdutosFinal.formaPagamento = (formaPagamento)

    //VERIFICANDO SE É CADASTRO OU ATUALIZACAO DE VENDAS
    const urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('id')
    if (id != null) {
        tabelaProdutosFinal.id = (id)
    }

    let tabelaProdutosArraiInArray = []
    produtoTr.map((value) => {
        let tabelaProdutos = []
        tabelaProdutos.push(value.children[1].innerHTML)
        tabelaProdutos.push(value.children[2].innerHTML)
        tabelaProdutos.push(value.children[3].innerHTML)
        tabelaProdutos.push(value.children[4].innerHTML)
        tabelaProdutosArraiInArray.push(tabelaProdutos)

    })
    tabelaProdutosFinal.produtosFinais = (tabelaProdutosArraiInArray)
    //FUNÇAO UTILIZADA PARA ATUALIZAR E CADASTRAR, O HTML DE AMBOS É PRATICAMENTE IGUAL
    ajaxCadastrarPedidoFinal(tabelaProdutosFinal)
    deletandoProdutosSelecionadosAposCadastrar()
})



//FUNCAO UTILIZADA NA SOMA DO VALORES NO CARREGAMENTO DA PAGINA
function converterMoedaNacional() {
    let vendasTr = [...document.querySelectorAll('.valor')]
    vendasTr.map((value) => {
        //PASSANDO DO BANCO DE DADOS DO VALOR AMERICANO PARA BRASILEIRO
        let moedaNacional = parseFloat(value.innerHTML).toLocaleString('pt-br', { minimumFractionDigits: 2 })
        value.innerHTML = ''
        value.innerHTML = moedaNacional
    })
}
