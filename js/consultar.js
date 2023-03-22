window.onload = function () {
    //CONVERTE PARA MOEDA NACIONAL NA PAGINACAO
    converterMoedaNacional()
    //AJUSTA HORA PARA O HORARIO PADRAO, REMOVENDO O PADRAO DO BANCO DE DADOS
    ajustandoHoraConsultar()
    //CARREGA O DATATABLE
    carregaDataTable()

    //AJUSTANDO FORMA DE COMPRA DA PAGINA COMPRAS
    if (metodoUrlAtual() == 'compras') {

        ajusteFormaCompras()
    }
    //CHAMANDO PAGINA DE DASHBORADS
    if (metodoUrlAtual() == 'dashboards') {
        teste()
    }


}

//AJUSTANDO FORMA DE COMPRA DA PAGINA COMPRAS
function ajusteFormaCompras() {
    listaTabela = [...document.querySelectorAll('.radioVendasTr')]
    console.log(listaTabela)
    listaTabela.map((value) => {
        let armazenandoStringFormaCompra = value.children[3].innerHTML
        armazenandoStringFormaCompra = armazenandoStringFormaCompra.replace('Compras', '')
        value.children[3].innerHTML = armazenandoStringFormaCompra
    })
}


//VARIAVEIS DE REFERENCIA
let armazenaIDparaAtualizarCliente = ''

//ARMAZENA A PAGINA ATUAL
let limit = [0, 10]

//RESGATANDO VALOR DO SELECT ATUAL
function pegandoValordoSelect() {
    let selectPaginacao = document.getElementById("linhaPaginaConsulta");
    let selectPaginacaoValor = selectPaginacao.options[selectPaginacao.selectedIndex].value;
    return selectPaginacaoValor
}

//FUNCAO RESPONSAVEL POR ENTREGAR O METODO ATUAL NA URL DA PAGINA
function metodoUrlAtual() {
    const urlParams = new URLSearchParams(window.location.search);
    let tabela = ''
    if (urlParams.get('metodo') == 'consultarClientes') {
        tabela = 'clientes'
    } else if (urlParams.get('metodo') == 'consultarVendas') {
        tabela = 'vendas'
    } else if (urlParams.get('metodo') == 'consultarProdutos') {
        tabela = 'produtos'
    } else if (urlParams.get('metodo') == 'consultarFuncionarios') {
        tabela = 'funcionarios'
    } else if (urlParams.get('metodo') == 'consultarCompras') {
        tabela = 'compras'
    } else if (urlParams.get('metodo') == 'consultarAportes') {
        tabela = 'aportes'
    } else if (urlParams.get('metodo') == 'consultarRelatorios') {
        tabela = 'relatorios'
    } else if (urlParams.get('metodo') == 'consultarDashboards') {
        tabela = 'dashboards'
    }
    return tabela
}

//PAGINA DE RELATORIOS NAO TEM TODOS OS ELEMENTOS DAS DEMAIS PAGINAS DEVIDO A ISSO FOI FEITA ESSA EXEÇAO
if (metodoUrlAtual() != 'relatorios' && metodoUrlAtual() != 'dashboards') {
    limparPagina()
}

//FUNCAO QUE MONTA A QUERY DO WHERE PARA ENCAMINHAR VIA AJAX
function ajaxWhere(filterVenda, tabela, pagamento = '') {
    if (tabela == 'vendas') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE ${pagamento} (id LIKE ${valorDigitado} or clienteCod LIKE ${valorDigitado} or clienteNome LIKE ${valorDigitado} or clienteTelefone LIKE ${valorDigitado} or desconto LIKE ${valorDigitado} or entrega LIKE ${valorDigitado} or formaPagamento LIKE ${valorDigitado} or statusPagamento LIKE ${valorDigitado} or dataEntregaProduto LIKE ${valorDigitado} or contaFinal LIKE ${valorDigitado}) ORDER BY id desc`;
        return where

    } else if (tabela == 'clientes') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE (id LIKE ${valorDigitado} or cliente LIKE ${valorDigitado} or bairro LIKE ${valorDigitado} or cidade LIKE ${valorDigitado} or estado LIKE ${valorDigitado} or telefone LIKE ${valorDigitado})`
        return where

    } else if (tabela == 'produtos') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE (id LIKE ${valorDigitado} or produto LIKE ${valorDigitado} or medida LIKE ${valorDigitado} or valor LIKE ${valorDigitado})`
        return where

    } else if (tabela == 'funcionarios') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE (id LIKE ${valorDigitado} or funcionario LIKE ${valorDigitado} or bairro LIKE ${valorDigitado} or cidade LIKE ${valorDigitado} or estado LIKE ${valorDigitado} or telefone LIKE ${valorDigitado})`
        return where

    } else if (tabela == 'compras') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE (id LIKE ${valorDigitado} or compra LIKE ${valorDigitado} or data LIKE ${valorDigitado} or valor LIKE ${valorDigitado}) ORDER BY id desc`
        return where

    } else if (tabela == 'aportes') {
        valorDigitado = filterVenda != '' ? `'%25${filterVenda}%25'` : `'%25%25'`
        let where = `WHERE (id LIKE ${valorDigitado} or aporte LIKE ${valorDigitado} or data LIKE ${valorDigitado} or valor LIKE ${valorDigitado}) ORDER BY id desc`
        return where

    } else if (tabela == 'vendasForm') {
        //RETORNA UMA QUERY 
        where = relatorioVendas()
        return where

    } else if (tabela == 'aportesForm') {
        let dataInicio = document.getElementById('dataInicioFormulario').value
        let dataFim = document.getElementById('dataFimFormulario').value
        let where = `WHERE (data >= "${dataInicio}" and data <= "${dataFim}") ORDER BY id desc`
        return where

    } else if (tabela == 'comprasForm') {
        return relatorioCompras()
    }


}


//FUNCAO RESPONSAVEL POR CRIAR A QUERY DOS RELATORIOS DE COMPRAS
function relatorioCompras() {
    let dataInicio = document.getElementById('dataInicioFormulario')
    let dataFim = document.getElementById('dataFimFormulario')
    let tabelaComprasOpcoesSelect = document.getElementById('tabelaComprasOpcoesSelect')

    letObjetoData = {}
    letObjetoData.dataInicio = dataInicio.value
    letObjetoData.dataFim = dataFim.value
    letObjetoData.statusPagamento = tabelaComprasOpcoesSelect.value

    if (tabelaComprasOpcoesSelect.value == "debitoCompras" || tabelaComprasOpcoesSelect.value == "dinheiroCompras" || tabelaComprasOpcoesSelect.value == "pixCompras" || tabelaComprasOpcoesSelect.value == "creditoParcelado") {

        tabelaComprasOpcoesSelect = `and formaCompra = "${tabelaComprasOpcoesSelect.value}"`
        where = `WHERE data >= "${dataInicio.value}" 
            and data <= "${dataFim.value}"
            ${tabelaComprasOpcoesSelect}
            ORDER BY id desc `
        return [where, letObjetoData]

        //CREDITO VISTA
    } else if (tabelaComprasOpcoesSelect.value == "creditoVista") {
        tabelaComprasOpcoesSelect = `and formaCompra = "${tabelaComprasOpcoesSelect.value}"`
        where = `WHERE dataPrimeiraParcela >= "${dataInicio.value}" 
            and dataPrimeiraParcela <= "${dataFim.value}"
            ${tabelaComprasOpcoesSelect}
            ORDER BY id desc `
        return [where, letObjetoData]

    } else if (tabelaComprasOpcoesSelect.value == "creditoParceladoDet") {
        tabelaParcelasCartao = 'parcelascartao'
        where = `WHERE dataPrimeiraParcela >= "${dataInicio.value}" 
            and dataPrimeiraParcela <= "${dataFim.value}"
            ORDER BY id desc `
        return [where, letObjetoData]
    }
}

function relatorioVendas() {
    let dataInicio = document.getElementById('dataInicioFormulario')
    let dataFim = document.getElementById('dataFimFormulario')
    let tabelaVendasOpcoesSelect = document.getElementById('tabelaVendasOpcoesSelect')

    //CRIANDO OBJETO PARA ENVIAR VIA AJAX
    letObjetoData = {}
    letObjetoData.dataInicio = dataInicio.value
    letObjetoData.dataFim = dataFim.value
    letObjetoData.statusPagamento = tabelaVendasOpcoesSelect.value

    //INSERIDO HORARIO NOS CAMPOS DE DATA DEVIDO A DATA E HORA PARA ENTREGAR A ENCOMENDA
    if (tabelaVendasOpcoesSelect.value == "debito" || tabelaVendasOpcoesSelect.value == "credito" || tabelaVendasOpcoesSelect.value == "pix" || tabelaVendasOpcoesSelect.value == "dinheiro") {
        tabelaVendasOpcoesSelect = `and formaPagamento = "${tabelaVendasOpcoesSelect.value}" and statusPagamento = "Finalizado"`
        where = `WHERE dataEntregaProduto >= "${dataInicio.value}T00:00" 
            and dataEntregaProduto <= "${dataFim.value}T23:59"
            ${tabelaVendasOpcoesSelect}
            ORDER BY id desc `
        return [where, letObjetoData]
    } else {
        tabelaVendasOpcoesSelect = tabelaVendasOpcoesSelect.value == 'todos' ? '' : `and statusPagamento = "${tabelaVendasOpcoesSelect.value}"`
        where = `WHERE dataEntregaProduto >= "${dataInicio.value}T00:00" 
            and dataEntregaProduto <= "${dataFim.value}T23:59"
            ${tabelaVendasOpcoesSelect}
            ORDER BY id desc `
        return [where, letObjetoData]
    }
}

//FUNCAO RESPOSAVEL POR INSTANCIAR XMLHTTPREQUESTS NAS CHAMADAS AJAX
function instanciaAjaxHttp(metodo, tabela, where, numeroPagina, numeroSelect, formData) {
    let xhr = new XMLHttpRequest()
    xhr.open('POST', '/lenny/app/construct/ajax.php', false)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.send("classe=" + 'chamadaAjax'
        + '&methodo=' + metodo
        + "&tabela=" + tabela
        + "&where=" + `${where}`
        + "&numeroPagina=" + numeroPagina
        + "&numeroSelect=" + numeroSelect
        + "&formData=" + JSON.stringify(formData)
    )
    if (xhr.readyState == 4 && xhr.status == 200) {
        let conteudo = xhr.responseText
        return conteudo
    } else {
        alert(xhr.status)
    }
}

//PAGINA DE RELATORIOS NAO TEM TODOS OS ELEMENTOS DAS DEMAIS PAGINAS DEVIDO A ISSO FOI FEITA ESSA EXEÇAO
if (metodoUrlAtual() != 'relatorios' && metodoUrlAtual() != 'dashboards') {
    // AJAX |CLIENTES|PRODUTOS|FUNCIONARIOS|VENDA|COMPRAS|APORTES| -> FILTRO INPUT(1)
    let filterVenda = document.getElementById('filterVendaInput')
    filterVenda.addEventListener('input', (valor) => {
        //ZERANDO O VALOR DE REFERENCIA DO BOTAO PRA MANTER NA MESMA PAGINA APOR O CLICK
        limit[0] = 0
        //PEGANDO METHODO DA URL PRA USAR COMO TABELA E PEGAR O WHERE(QUERY)
        let tabela = metodoUrlAtual()
        //SELECT STATUS PAGAMENTO
        if (tabela == 'vendas') {
            var pagamento = document.getElementById('tabelaVendasOpcoesSelectPagVendas')
            pagamento = `statusPagamento = '${pagamento.value}' AND`
        }
        //RETORNA A QUERY MONTADA
        let where = ajaxWhere(filterVenda.value.replace(',', '.'), tabela, pagamento)
        let numeroPagina = 0
        let retornoRowsTabela = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, where, numeroPagina, pegandoValordoSelect())
        inserindoConteudoHtml(retornoRowsTabela)
        converterMoedaNacional()
        ajustandoHoraConsultar()
        carregaDataTable()
    })

    // AJAX |CLIENTES|PRODUTOS|FUNCIONARIOS|VENDA|COMPRAS|APORTES| -> SELECT NUMERO DE LINHAS POR PAGINA
    let selectPaginacao = document.getElementById("linhaPaginaConsulta");
    selectPaginacao.addEventListener('change', (valor) => {
        limit[0] = 0
        document.getElementById('filterVendaInput').value = ''
        //PEGANDO METHODO DA URL PRA USAR COMO TABELA E PEGAR O WHERE(QUERY)(2)
        let tabela = metodoUrlAtual()
        //SELECT STATUS PAGAMENTO
        if (tabela == 'vendas') {
            var pagamento = document.getElementById('tabelaVendasOpcoesSelectPagVendas').value
            pagamento = `statusPagamento = '${pagamento}' AND`
            //RETORNA A QUERY MONTADA
            let where = ajaxWhere(filterVenda.value, tabela, pagamento)
            var retornoRowsTabela = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, where, 0, pegandoValordoSelect())
        } else {
            var retornoRowsTabela = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, '', 0, pegandoValordoSelect())
        }

        inserindoConteudoHtml(retornoRowsTabela)
        converterMoedaNacional()
        ajustandoHoraConsultar()
        carregaDataTable()
    })
}



// AJAX |CLIENTES|PRODUTOS|FUNCIONARIOS|VENDA|COMPRAS|APORTES| -> PAGINAÇÃO BOTAO(3)
function paginacaoBotao(pagina, tabela) {
    let filterVenda = document.getElementById('filterVendaInput')
    //limit[0] É UM ARRAY QUE ARMAZENA A PAGIN ATUAL E SERA UTILIZADA COMO REFERENCIA NO UPDATE
    limit[0] = pagina
    //SELECT STATUS PAGAMENTO
    if (tabela == 'vendas') {
        var pagamento = document.getElementById('tabelaVendasOpcoesSelectPagVendas').value
        pagamento = `statusPagamento = '${pagamento}' AND`
    }
    //RETORNA A QUERY MONTADA
    let where = ajaxWhere(filterVenda.value, tabela, pagamento)
    let retornoRowsTabela = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, where, pagina, pegandoValordoSelect())
    inserindoConteudoHtml(retornoRowsTabela)
    converterMoedaNacional()
    ajustandoHoraConsultar()
    carregaDataTable()
}



//LOCAL PADRAO PARA RENDERIZAR OS CONTEUDOS QUE RETORNAM DO AJAX
function inserindoConteudoHtml(conteudo) {
    //APAGANDO AS ROWS QUE SAO O INDICE 2
    teste = [...(document.getElementById('content').children)][1].remove()
    //APAGANDO OS BOTOES DA PAGINACAO QUE ERAM O INDICE 3 MAS PASSARAM A SER O 2 AO APAGAR AS ROWS
    teste = [...(document.getElementById('content').children)][1].remove()
    //INSERINDO HTML
    teste = [...(document.getElementById('content').children)][0].insertAdjacentHTML('afterend', conteudo);
}

//RETORNO PARA O SELECT = 10 AO CARREGAR A PAGINA -> NUMERO DE LINHAS POR PAGINA
function limparPagina() {
    document.getElementById('filterVendaInput').value = ''
    // LIMPANDO O SELECT
    var text = '10';
    var select = document.querySelector('#linhaPaginaConsulta');
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].text === text) {
            select.selectedIndex = i;
            break;
        }
    }
}

//MODAL BOOTSTRAP CONSULTAR 
function carregarModalVerificar(id) {
    let tabela = metodoUrlAtual()
    let retornoDetalhes = (JSON.parse(instanciaAjaxHttp('listarBancoDeDados', tabela, `WHERE id=${id}`, 0, 0)))
    let retornoDetalhesNew = (Object.keys(retornoDetalhes[0]))
    for (let i = 1; i < (retornoDetalhesNew.length); i++) {
        let dado = retornoDetalhes[0][`${retornoDetalhesNew[i]}`]
        //ESCONDE A SENHA NO MODAL
        if (retornoDetalhesNew[i] == 'senha') {
            continue
            //PASSANDO MOEDA PARA O PADRAO REAL(NACIONAL)
        } else if (retornoDetalhesNew[i] == 'valor') {
            dado = parseFloat(retornoDetalhes[0][`${retornoDetalhesNew[i]}`]).toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
        //REMOVENDO PALAVRA DE FORMA DE COMPRA,  retornoDetalhesNew[i] -> REPRESENTA A COLUNA DO BANCO DE DADOS
        dado = retornoDetalhesNew[i] == 'formaCompra' ? dado.replace('Compras', '') : dado

        document.getElementById(retornoDetalhesNew[i] + 'Verificar').innerHTML = dado
        if (retornoDetalhesNew[i] == 'data') {
            ajustandoHoranoFormatoPadrao('.col-md-6', 1)
        } else if (retornoDetalhesNew[i] == 'dataPrimeiraParcela' && dado != '') {
            ajustandoHoranoFormatoPadrao('#dataPrimeiraParcelaVerificarPai', 1)
        }
    }
    $('#verificar').modal('show')
}


//MODAL BOOTSTRAP CONSULTAR 
function carregarModalRecibo(id) {
    //OCULTANDO A MENSAGEM DE IMPRESSO COM SUCESSO
    document.getElementById('pedidoImpresso').style.display = 'none'
    //REMOVENDO DUPLICATA DOS PRODUTOS AO CLICAR NOVAMENTE NA CONSULTAS DE RECIBOS
    let removendoProdutos = [...document.querySelectorAll('.removerProdutos')]
    console.log(removendoProdutos)
    if (removendoProdutos != null) {
        removendoProdutos.map((value) => {
            value.remove()
        })
    }
    let tabela = metodoUrlAtual()
    let retornoDetalhes = (JSON.parse(instanciaAjaxHttp('listarBancoDeDados', tabela, `WHERE id=${id}`, 0, 0)))
    let retornoDetalhesNew = (Object.keys(retornoDetalhes[0]))
    let produtosVendidos = (JSON.parse((((retornoDetalhes))[0]).produtosFinais))
    // console.log(retornoDetalhesNew)
    for (let i = 0; i < (retornoDetalhesNew.length); i++) {
        let dado = retornoDetalhes[0][`${retornoDetalhesNew[i]}`]
        if (retornoDetalhesNew[i] == 'clienteTelefone' || retornoDetalhesNew[i] == 'clienteCod' || retornoDetalhesNew[i] == 'data') {
            continue
        }
        else if (retornoDetalhesNew[i] == 'produtosFinais') {
            produtosVendidos.forEach(element => {
                document.getElementById('saudacoes').insertAdjacentHTML('beforebegin',
                    `<tr>
                <td class="removerProdutos quebra" colspan="3" style="font-weight: 500;">${element[1].substring(0, 33)}</td>
                <td class="removerProdutos" style="font-weight: 500; text-align: center">${element[2]}</td>
                <td class="removerProdutos" style="font-weight: 500; text-align: center">${element[3]}</td>
            </tr>`
                )
            });
            continue
        }
        if (retornoDetalhesNew[i] == 'dataEntregaProduto') {
            let data = new Date(dado);
            dado = `${data.getDate() <= 9 ? '0' + data.getDate() : data.getDate()}/${(data.getMonth() + 1) <= 9 ? '0' + (data.getMonth() + 1) : data.getMonth() + 1}/${data.getFullYear() <= 9 ? '0' + data.getFullYear() : data.getFullYear()}`
        } else if (retornoDetalhesNew[i] == 'contaFinal' || retornoDetalhesNew[i] == 'valorTotal') {
            dado = parseFloat(dado).toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
        document.getElementById(retornoDetalhesNew[i]).innerHTML = dado
    }
    $('#recibo').modal('show')
}


//ARMAZENANDO REFERENCIA DO VALOR TOTAL PARA CALCULOS
function totalReferencia(referenciaValorTotal) {
    if (referenciaValorTotal.length < 7) {
        referenciaValorTotal = dezanaUSA(referenciaValorTotal)
    } else {
        referenciaValorTotal = milharUSA(referenciaValorTotal)
    }
    // valorReferencia.push(referenciaValorTotal)
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

//CRIANDO OBJETO PARA ARMAZENAR DADOS INSERIDOS NO INPUT(FORMULARIO)
function criandoObjetoDadosInput(classe) {
    let criandoArrayFormulario = {}
    let inputsFormulario = ([...document.getElementsByClassName(classe)])
    inputsFormulario.map((input) => {
        criandoArrayFormulario[input.getAttribute('name')] = input.value
        // console.log(criandoArrayFormulario[input.getAttribute('name')])
    })
    //CASO SEJA UM FORMULARIO QUE CONTENHA VALOR (MOEDA)
    if (criandoArrayFormulario.valor) {
        criandoArrayFormulario.valor = totalReferencia(criandoArrayFormulario.valor)
    }
    return criandoArrayFormulario
}

//FUNCAO RESPONSAVEL POR APLICAR READ ONLY EM SELECT
function readOnlySelectTrue(btn,) {
    document.querySelector(`.${btn}`).disabled = true;
    console.log(document.querySelector(`.${btn}`))
}

function readOnlySelectFalse(btn,) {
    document.querySelector(`.${btn}`).disabled = false;
    console.log(document.querySelector(`.${btn}`))
}

//FUNCAO RESPONSAVEL POR OCUNTAR DIVS DA PAGINA DE COMPRAS
function ocultarDivCredito(dataParcelaIdDiv, dataParcelaId, quantidadeParcelaIdDiv, quantidadeParcelaId, selectMain) {
    let dataPrimeiraParcelaCompra = document.getElementById(dataParcelaIdDiv)
    dataPrimeiraParcelaCompra.style.display = 'none'
    let dataPrimeiraParcelaCompraValue = document.getElementById(dataParcelaId)

    let numeroParcelasCompra = document.getElementById(quantidadeParcelaIdDiv)
    numeroParcelasCompra.style.display = 'none'
    let numeroParcelasCompraValue = document.getElementById(quantidadeParcelaId)

    let formaPagamento = document.getElementById(selectMain)
    formaPagamento.addEventListener('change', (value) => {
        if (formaPagamento.value == 'creditoVista') {
            dataPrimeiraParcelaCompra.style.display = 'block'
            dataPrimeiraParcelaCompraValue.setAttribute('required', 'required')
            numeroParcelasCompra.style.display = 'none'
            numeroParcelasCompraValue.removeAttribute('required', 'required')
        } else if (formaPagamento.value == 'creditoParcelado') {
            dataPrimeiraParcelaCompra.style.display = 'block'
            dataPrimeiraParcelaCompraValue.setAttribute('required', 'required')
            numeroParcelasCompra.style.display = 'block'
            numeroParcelasCompraValue.setAttribute('required', 'required')
        } else {
            dataPrimeiraParcelaCompra.style.display = 'none'
            dataPrimeiraParcelaCompraValue.removeAttribute('required', 'required')

            numeroParcelasCompra.style.display = 'none'
            numeroParcelasCompraValue.removeAttribute('required', 'required')
        }
    })
}



//INICIO EDITAR - ABRE MODAL NO CLICK DE EDITAR -> |CLIENTES|PRODUTOS|FUNCIONARIOS|COMPRAS|APORTES| (4)
function carregarModalEditar(id) {
    let tabela = metodoUrlAtual()
    //INSERINDO ID EM VARIAVEL GLOBAL PARA SER UTILIZADA COMO REFERENCIA DE ID PARA ENVIAR O FORMULARIO DE UPDATE DE CLIENTE
    armazenaIDparaAtualizarCliente = id
    let retornoDetalhes = (JSON.parse(instanciaAjaxHttp('listarBancoDeDados', tabela, `WHERE id=${id}`, 0, 0)))
    //INSERINDO INFORMACOES NOS CAMPOS INPUT APÓS COLETA DO BANCO DE DADOS
    let retornoDetalhesNew = (Object.keys(retornoDetalhes[0]))
    console.log(retornoDetalhes)
    for (let i = 1; i < (retornoDetalhesNew.length); i++) {
        //PASSANDO PARA REAL
        let dado = retornoDetalhes[0][`${retornoDetalhesNew[i]}`]
        if (retornoDetalhesNew[i] == 'valor') {
            dado = parseFloat(retornoDetalhes[0][`${retornoDetalhesNew[i]}`]).toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
        document.getElementById(retornoDetalhesNew[i] + 'Editar').value = dado
    }

    $('#editar').modal('show')
    if (metodoUrlAtual() == 'compras') {
        //PEGANDO VALOR DA FORMA DE PAGAMENTO
        ocultarDivCredito('dataPrimeiraParcelaCompraEditar', 'dataPrimeiraParcelaEditar', 'numeroParcelasCompraEditar', 'parcelaCompraEditar', 'formaCompraEditar')

        // LOGICA QUE MANIPULA AS DIVS
        if (retornoDetalhes[0].formaCompra != 'creditoParcelado' && retornoDetalhes[0].formaCompra != 'creditoVista') {
            document.getElementById('dataPrimeiraParcelaCompraEditar').style.display = 'none'
            document.getElementById('numeroParcelasCompraEditar').style.display = 'none'

            document.getElementById('valorEditar').removeAttribute('readonly', 'readonly');
            document.getElementById('formaCompraEditar').removeAttribute('readonly', 'readonly');
            readOnlySelectFalse('btnAtualizar')

        } else if (retornoDetalhes[0].formaCompra == 'creditoParcelado') {
            document.getElementById('dataPrimeiraParcelaCompraEditar').style.display = 'block'
            document.getElementById('dataPrimeiraParcelaEditar').setAttribute('readonly', 'readonly');

            document.getElementById('numeroParcelasCompraEditar').style.display = 'block'
            document.getElementById('parcelaCompraEditar').setAttribute('readonly', 'readonly');

            document.getElementById('valorEditar').setAttribute('readonly', 'readonly');
            document.getElementById('formaCompraEditar').setAttribute('readonly', 'readonly');

            readOnlySelectTrue('btnAtualizar')
        } else if (retornoDetalhes[0].formaCompra == 'creditoVista') {
            document.getElementById('dataPrimeiraParcelaCompraEditar').style.display = 'block'
            document.getElementById('dataPrimeiraParcelaEditar').setAttribute('readonly', 'readonly');

            document.getElementById('valorEditar').setAttribute('readonly', 'readonly');
            document.getElementById('formaCompraEditar').setAttribute('readonly', 'readonly');

            document.getElementById('numeroParcelasCompraEditar').style.display = 'none'

            readOnlySelectTrue('btnAtualizar')

        }

    }
}


//SUBMIT DO FORMULARIO QUE SERA ATUALIZADO NO CAMPO CONSULTAR CLIENTE APÓS O CLICK EM ATUALIZAR COM EXECAO DE VENDAS
if (metodoUrlAtual() != 'vendas' && metodoUrlAtual() != 'relatorios' && metodoUrlAtual() != 'dashboards') {
    let filterVenda = document.getElementById('filterVendaInput')
    let formEditar = document.getElementById('formularioEditarVenda')
    formEditar.addEventListener('submit', () => {
        event.preventDefault();
        let tabela = metodoUrlAtual()
        //FUNCAO RESPONSÁVEL POR COLETAR TODAS AS INFORMACOES DO INPUT (ATUALIZAR), PARAMETRO DA FUNCAO É A CLASSE DO INPUT DO FORM
        let retornoArraydadosInput = criandoObjetoDadosInput('form-control-editar')
        console.log(retornoArraydadosInput)
        let retornoRowsTabela = instanciaAjaxHttp('EditarBancoDeDados', tabela, armazenaIDparaAtualizarCliente, limit[0], 10, retornoArraydadosInput)
        if (retornoRowsTabela == 'Nome|Telefone ou Produto já existe no Banco de Dados, favor Verificar') {
            alert(retornoRowsTabela)
            return
        } else {
            inserindoConteudoHtml(retornoRowsTabela)
            converterMoedaNacional()
            ajustandoHoraConsultar()
            carregaDataTable()
            $('#editar').modal('hide')
            // PEGANDO O VALOR DO FILTRO DO INPUT DA PAGINA ATUAL PARA APOS ATUALIZACAO RETORNAR NA MESMA PAGINA
            if (filterVenda.value != '') {
                let where = ajaxWhere(filterVenda.value, tabela)
                //ARMAZENA A PAGINA ATUAL
                let numeroPagina = limit[0]
                let retornoRowsTabelaComValorNoInputDoFiltro = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, where, numeroPagina, pegandoValordoSelect())
                inserindoConteudoHtml(retornoRowsTabelaComValorNoInputDoFiltro)
                converterMoedaNacional()
                ajustandoHoraConsultar()
                carregaDataTable()
                //CLICANDO NA ULTIMA PAGINA PRA MANTER CASO TENHA VALOR NO INPUT
                let clickElementoAlterado = document.getElementById(`clientes${limit[0]}`)
                clickElementoAlterado.click()
            }
        }
    })
}
//FIM EDITAR


//INICIO CADASTRAR - ABRE MODAL NO CLICK DE CADASTRAR E DELETA INFORMACOES DO INPUT -> |CLIENTES|PRODUTOS|FUNCIONARIOS|COMPRAS|APORTES| (5)
function modalCadastrar() {
    let dadosInpuApagar = [...document.getElementsByClassName('form-control-cadastrar')]
    dadosInpuApagar.map((laco) => {
        laco.value = ""
    })
    $('#cadastrar').modal('show')
    if (metodoUrlAtual() == 'compras') {
        //PEGANDO VALOR DA FORMA DE PAGAMENTO
        ocultarDivCredito('dataPrimeiraParcelaCompra', 'dataPrimeiraParcelaCompraValue', 'numeroParcelasCompra', 'numeroParcelasCompraValue', 'formaCompra')
    }
}


//SUBMIT DO FORMULARIO QUE SERA CADASTRADO NO CAMPO CONSULTAR CLIENTE APÓS O CLICK EM CADASTRAR COM EXECAO DE VENDAS E RELATORIOS
if (metodoUrlAtual() != 'vendas' && metodoUrlAtual() != 'relatorios' && metodoUrlAtual() != 'dashboards') {
    let formCadastrar = document.getElementById('formularioCadastrarVenda')
    formCadastrar.addEventListener('submit', (value) => {
        event.preventDefault();
        let tabela = metodoUrlAtual()
        //FUNCAO RESPONSAVEL POR COLETAR TODAS AS INFORMACOES DO INPUT (CADASTRAR/AUTALIZAR), PARAMETRO DA FUNCAO É A CLASSE DO INPUT DO FORM
        let retornoArraydadosInput = criandoObjetoDadosInput('form-control-cadastrar')
        console.log(retornoArraydadosInput)
        let retornoRowsTabela = instanciaAjaxHttp('cadastrarBancoDeDados', tabela, '', '', '', retornoArraydadosInput)
        if (retornoRowsTabela == 'Nome|Telefone ou Produto já existe no Banco de Dados, favor Verificar') {
            alert(retornoRowsTabela)
            return
        } else {
            alert(retornoRowsTabela)
            $('#cadastrar').modal('hide')
            location.reload()
        }
    })
}
//FIM CADASTRAR


//INICIO EXCLUIR - ABRE MODAL EXCLUIR NO CLICK E JÁ DELETAR APÓS CONFIRMAÇÃO -> |CLIENTES|PRODUTOS|FUNCIONARIOS|COMPRAS|APORTES|
function carregarModalExcluir(id) {
    let nomeCliente = document.getElementById(`excluir${id}`).parentElement.parentElement.children[1]
    let confirmarExclusao = confirm(`Deletar ${metodoUrlAtual().slice(0, -1)} ${nomeCliente.innerHTML}?`)
    if (confirmarExclusao == true) {
        //PEGANDO METHODO DA URL PRA USAR COMO TABELA E PEGAR O id
        let tabela = metodoUrlAtual()
        let retornoRowsTabela = instanciaAjaxHttp('deletarBancoDeDados', tabela, id, '', '', '')
        if (retornoRowsTabela == false) {
            alert(`Falha ao deletar ${nomeCliente.innerHTML}, tente novamente!`)
        }
        location.reload()
    }
}
//FIM EXCLUIR

//DELETANDO CARACTERES INVALIDOS NOS CAMPOS DE 
function deletandoCaracterInvalido(id) {
    caracterInvalido = document.getElementById(`${id}`).value
    numeroValido = caracterInvalido.substring(0, caracterInvalido.length - 1)
    caracterInvalido = document.getElementById(`${id}`).value = ""
    document.getElementById(`${id}`).value = numeroValido
}

// MACRO PRA NUMERO DE TELEFONE NO FORMATO PADRAO 
if (metodoUrlAtual() == 'clientes' || metodoUrlAtual() == 'funcionarios') {
    let cadastrar = document.getElementById('telefoneCadastrar')
    cadastrar.addEventListener('input', () => {
        cadastrar.value = phoneMask(cadastrar.value)
    })
    let editar = document.getElementById('telefoneEditar')
    editar.addEventListener('input', () => {
        editar.value = phoneMask(editar.value)
    })
    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g, '')
        value = value.replace(/(\d{2})(\d)/, "($1) $2")
        value = value.replace(/(\d)(\d{4})$/, "$1-$2")
        return value
    }

}

//MACRO PARA MOEDA NA OPCAO DE COMPRAS E APORTES
function formatarMoeda(id) {
    var elemento = document.getElementById(`${id}`);
    var valor = elemento.value;
    valor = valor + '';
    valor = (valor.replace(/[\D]+/g, ''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");
    if (valor.length > 6) {
        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }
    elemento.value = valor;
    if (valor == 'NaN') elemento.value = '';

}

//FUNCAO QUE AJUSTA A HORA NO FORMATO PADRAO
function ajustandoHoranoFormatoPadrao(classeBody, indice) {
    let hora = [...document.querySelectorAll(`${classeBody}`)]
    console.log(hora)
    hora.map((laco) => {
        let hora = laco.children[indice].innerHTML
        laco.children[indice].innerHTML = ""
        // laco.children[indice].innerHTML = hora
        if (metodoUrlAtual() == 'vendas') {
            var horaFormatada = `${hora.substring(8, 10)}-${hora.substring(5, 7)}-${hora.substring(0, 4)} as ${hora.substring(11, 16)} `
        } else {
            var horaFormatada = `${hora.substring(8, 10)}-${hora.substring(5, 7)}-${hora.substring(0, 4)}`
        }
        laco.children[indice].innerHTML = horaFormatada
    }
    )
}
//AJUSTANDO HORA DAS PAGINAS CONSULTA, PEGANDO O INDICE DO ELEMENTO FILHO
function ajustandoHoraConsultar() {
    if (metodoUrlAtual() == 'vendas') {
        indice = 4
        ajustandoHoranoFormatoPadrao('.radioVendasTr', indice)
    } else if (metodoUrlAtual() == 'compras' || metodoUrlAtual() == 'aportes') {
        indice = 2
        ajustandoHoranoFormatoPadrao('.radioVendasTr', indice)
    }
}

//AJUSTANDO HORA DAS PAGINAS DE FORMULARIO DE ACORDO COM A TABELA SELECIONADA
function ajustandoHoraForm() {
    let tabela = document.getElementById('tabelaRelatorios').value
    if (tabela == 'vendas') {
        ajustandoHoranoFormatoPadrao('.radioVendasTr', 4)
    } else if (tabela == 'compras' || tabela == 'aportes') {
        ajustandoHoranoFormatoPadrao('.radioVendasTr', 2)
        let tabela = document.getElementById('tabelaComprasOpcoesSelect').value
        if (tabela == 'creditoParceladoDet') {
            ajustandoHoranoFormatoPadrao('.radioVendasTr', 4)
        }
    }
}

//FUNCAO RESPONSAVEL PELO WHERE DO BANCO NO CONSOLIDADO, OPERADO -> SUM / COUNT
function whereConsolidado(operador, dataInicio, dataFim) {
    where = `SELECT
            
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Finalizado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59") as vendasFinalizadas,
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Em aberto' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59") as vendasEmaberto,
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Cancelado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59") as vendasCanceladas,
    
    
    
    
    (SELECT ${operador}(valor) FROM lennysalgados.compras WHERE data >= "${dataInicio}" and data <= "${dataFim}" and formaCompra != ('creditoParcelado') and formaCompra != ('creditoVista')) as compras,
    
    (SELECT ${operador}(valor) FROM lennysalgados.compras WHERE data >= "${dataInicio}" and data <= "${dataFim}" and formaCompra = 'creditoVista') as creditoVista,

    (SELECT ${operador}(valorFinal) FROM lennysalgados.parcelascartao WHERE dataPrimeiraParcela >= "${dataInicio}" and dataPrimeiraParcela <= "${dataFim}") as creditoParcelado,
    
    
    
    (SELECT ${operador}(valor) FROM lennysalgados.aportes WHERE data >= "${dataInicio}" and data <= "${dataFim}") as aportes,
    
    
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Finalizado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59" AND formaPagamento = 'Débito') as formaPagamentoDebito,
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Finalizado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59" AND formaPagamento = 'Crédito' ) as formaPagamentoCredito,
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Finalizado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59" AND formaPagamento = 'Pix' ) as formaPagamentoPix,
    
    (SELECT ${operador}(contaFinal) FROM lennysalgados.vendas WHERE statusPagamento = 'Finalizado' AND dataEntregaProduto >= "${dataInicio}T00:00" and dataEntregaProduto <= "${dataFim}T23:59" AND formaPagamento = 'Dinheiro' ) as formaPagamentoDinheiro,
    
    
    (SELECT ${operador}(valor) FROM lennysalgados.compras WHERE data >= "${dataInicio}" and data <= "${dataFim}" AND formaCompra = 'DebitoCompras') as formaComprasDebito,
    
    (SELECT ${operador}(valor) FROM lennysalgados.compras WHERE data >= "${dataInicio}" and data <= "${dataFim}" AND formaCompra = 'dinheiroCompras' ) as formaComprasDinheiro,
    
    (SELECT ${operador}(valor) FROM lennysalgados.compras WHERE data >= "${dataInicio}" and data <= "${dataFim}" AND formaCompra = 'PixCompras' ) as formaComprasPix;
    
    `
    return where
}


//FUNCAO UTILIZADA APENAS NO CLICK DO BOTAO SOLICITAR RELATORIO, AQUI NAO TEM PARTICIPACAO NA CHAMADA AJAX
if (metodoUrlAtual() == 'relatorios') {
    limit[0] = 0
    let tabela = document.getElementById('tabelaRelatorios')
    let tabelaVendasOpcoes = document.getElementById('tabelaVendasOpcoes')
    let tabelaComprasOpcoes = document.getElementById('tabelaComprasOpcoes')
    let dataInicio = document.getElementById('dataInicioFormulario')
    let dataFim = document.getElementById('dataFimFormulario')
    let botaoEnviarRelatorio = document.getElementById('botaoEnviarDadosRelataorio')

    tabelaVendasOpcoes.style.display = 'none'
    tabelaComprasOpcoes.style.display = 'none'
    dataInicio.disabled = true
    dataFim.disabled = true
    botaoEnviarRelatorio.disabled = true
    tabela.addEventListener('change', () => {
        document.getElementById('relatorio').innerHTML = ""
        if (tabela.value == 'vendas') {
            tabelaVendasOpcoes.style.display = 'block'
            tabelaComprasOpcoes.style.display = 'none'
            tabelaVendasOpcoes.addEventListener('change', () => {
                dataInicio.disabled = false
            })
        } else if (tabela.value == 'compras') {
            tabelaComprasOpcoes.style.display = 'block'
            tabelaVendasOpcoes.style.display = 'none'
            tabelaComprasOpcoes.addEventListener('change', () => {
                dataInicio.disabled = false
            })

        } else {
            tabelaVendasOpcoes.style.display = 'none'
            tabelaComprasOpcoes.style.display = 'none'
            dataInicio.disabled = false
        }
        if (tabela.value == 'consolidado') {
            document.querySelector('.linhaPaginaConsulta').style.display = 'none'
        } else {
            document.querySelector('.linhaPaginaConsulta').style.display = 'block'
        }
    })

    dataInicio.addEventListener('change', () => {
        dataFim.disabled = false
    })

    dataFim.addEventListener('change', () => {
        botaoEnviarRelatorio.disabled = false
    })

    botaoEnviarRelatorio.addEventListener('click', (laco) => {
        let where
        if (tabela.value == 'vendas') {
            //RETORNA UMA QUERY 
            whereRetorno = relatorioVendas()

        } else if (tabela.value == 'compras') {
            //RETORNA UM ARRAY QUE SERA UTILIZADO NO AJAX WHERE[0],WHERER[1]
            whereRetorno = relatorioCompras()
        }
        else if (tabela.value == 'aportes') {
            letObjetoData = {}
            letObjetoData.dataInicio = dataInicio.value
            letObjetoData.dataFim = dataFim.value
            letObjetoData.statusPagamento = tabelaComprasOpcoesSelect.value
            where = `WHERE data >= "${dataInicio.value}" and data <= "${dataFim.value}" ORDER BY id desc`
        }

        else if (tabela.value == 'consolidado') {
            let dataInicio = document.getElementById('dataInicioFormulario')
            let dataFim = document.getElementById('dataFimFormulario')
            letObjetoData = {}
            letObjetoData.dataInicio = dataInicio.value
            letObjetoData.dataFim = dataFim.value

            dataInicio = dataInicio.value
            dataFim = dataFim.value

            where = whereConsolidado('SUM', dataInicio, dataFim)

        }

        if (tabela.value == 'vendas' || tabela.value == 'compras') {
            where = whereRetorno[0]
            letObjetoData = whereRetorno[1]
        }

        retornoHtmlPost = instanciaAjaxHttp('relatorios', tabela.value, where, 0, pegandoValordoSelect(), letObjetoData)
        let paginaRenderizar = document.getElementById('relatorio')
        paginaRenderizar.innerHTML = ""
        if (retornoHtmlPost.includes('Data Inicio maior que data Fim!') || retornoHtmlPost.includes('Data Inicio ou Data Fim não podem ser maiores que a data atual!')) {
            alert(retornoHtmlPost)
        } else if (retornoHtmlPost.includes('Total encontrado 0')) {
            alert('Não há registros no período selecionado')
        } else {
            if (tabela.value == 'consolidado') {
                console.log('retornoHtmlPost')
                console.log(retornoHtmlPost)
                console.log('retornoHtmlPost')
                retornoHtmlPost = (JSON.parse(retornoHtmlPost))
                paginaRenderizar.innerHTML = `  <div style='background-color: white;'>
                                                    <div class="row">
                                                        <div class="col-md-6"
                                                            id="piechart" style="width: 500px; height: 350px;">
                                                        </div>
                                                        <div class="col-md-6"
                                                            id="piechart1" style="width: 810px; height: 350px;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"
                                                            id="piechart2" style="width: 500px; height: 350px;">
                                                        </div>
                                                        <div class="col-md-6"
                                                            id="piechart3" style="width: 810px; height: 350px;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"
                                                            id="piechart5" style="width: 500px; height: 350px;">
                                                        </div>
                                                        <div class="col-md-6"
                                                            id="piechart4" style="width: 810px; height: 350px;">
                                                        </div>
                                                    </div>
                                                <div>
                                                `
                drawChart(retornoHtmlPost)
                drawChart1(retornoHtmlPost)
                drawChart2(retornoHtmlPost)
                drawChart3(retornoHtmlPost)
                drawChart4(retornoHtmlPost)
                drawChart5(retornoHtmlPost)
                console.log(retornoHtmlPost)
                // return

            } else {
                paginaRenderizar.innerHTML = retornoHtmlPost
                carregaDataTable()
                converterMoedaNacional()
                ajustandoHoraForm()
            }


        }
    })
}

//FUNCAO UTILIZADA NO CLICK DO BOTAO DE PAGINACAO
function paginacaoBotaoForm(pagina, tabela) {
    limit[0] = pagina
    //FUNCAO RESPONSAVEL POR RETORNAR UM WHERE PARA SER UTLIZADO NA CHAMADA AJAX, RETORNA UM ARRAY WHERE[0],WHERE[1]
    let where = ajaxWhere('', tabela)
    tabela = tabela.replace('Form', '');
    if (tabela == 'compras' || tabela == 'vendas') {
        var retornoRowsTabela = instanciaAjaxHttp('relatorios', tabela, where[0], pagina, pegandoValordoSelect(), where[1])
    } else {
        var retornoRowsTabela = instanciaAjaxHttp('relatorios', tabela, where, pagina, pegandoValordoSelect(), letObjetoData)
    }
    let paginaRenderizar = document.getElementById('relatorio')
    paginaRenderizar.innerHTML = ""
    paginaRenderizar.innerHTML = retornoRowsTabela
    carregaDataTable()
    ajustandoHoraForm()
}

//FUNCAO UTILIZADA PARA TRANFORMAR TABELAS COM DINHEIRO NO FORMATO REAL(MOEDA)
function converterMoedaNacional() {
    if (metodoUrlAtual() == 'produtos' || metodoUrlAtual() == 'compras' || metodoUrlAtual() == 'aportes' || metodoUrlAtual() == 'relatorios' || metodoUrlAtual() == 'vendas') {
        let vendasTr = [...document.querySelectorAll('.valor')]
        vendasTr.map((value) => {
            //PASSANDO DO BANCO DE DADOS DO VALOR AMERICANO PARA BRASILEIRO
            let moedaNacional = parseFloat(value.innerHTML).toLocaleString('pt-br', { minimumFractionDigits: 2 })
            value.innerHTML = ''
            value.innerHTML = moedaNacional
        })
    }
}

//CARREGANDO DATATABLE DE TODAS AS TABELAS PRA CRIACAO DE EXCEL E PRINT
function carregaDataTable() {
    $('#consultarVenda').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: false,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
};


//INICIO DOS GRAFICOS QUE SERAO UTILIZADOS NA OPCAO CONSOLIDADO
// google.charts.load('current', { 'packages': ['corechart'] });
google.charts.load('current', { packages: ['corechart'], language: 'pt-BR' });
google.charts.setOnLoadCallback();


function drawChart(retornoHtmlPost) {

    compras = (retornoHtmlPost.compras) == null ? 0 : parseFloat(retornoHtmlPost.compras)
    aportes = (retornoHtmlPost.aportes) == null ? 0 : parseFloat(retornoHtmlPost.aportes)
    vendasCanceladas = (retornoHtmlPost.vendasCanceladas) == null ? 0 : parseFloat(retornoHtmlPost.vendasCanceladas)
    vendasEmaberto = (retornoHtmlPost.vendasEmaberto) == null ? 0 : parseFloat(retornoHtmlPost.vendasEmaberto)
    vendasFinalizadas = (retornoHtmlPost.vendasFinalizadas) == null ? 0 : parseFloat(retornoHtmlPost.vendasFinalizadas)

    creditoVista = (retornoHtmlPost.creditoVista) == null ? 0 : parseFloat(retornoHtmlPost.creditoVista)
    creditoParcelado = (retornoHtmlPost.creditoParcelado) == null ? 0 : parseFloat(retornoHtmlPost.creditoParcelado)
    // console.log('creditoVista + compras')
    // console.log(creditoVistacompras)
    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Compras', (compras + creditoVista + creditoParcelado)],
        ['Vendas Finalizadas', vendasFinalizadas],
        ['Lucro real', vendasFinalizadas - (compras + creditoVista)],
    ]);

    var options = {
        title: 'Consolidado Lenny Salgados',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        is3D: true,
        width: '500',
        height: '350',
        colors: ['#696969', '#006400', '#DAA520'],


    };
    google.charts.load('current', {
        packages: ['corechart'],
        language: 'pt-BR'
    });

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}

function drawChart1(retornoHtmlPost) {

    compras = (retornoHtmlPost.compras) == null ? 0 : parseFloat(retornoHtmlPost.compras)
    aportes = (retornoHtmlPost.aportes) == null ? 0 : parseFloat(retornoHtmlPost.aportes)
    vendasCanceladas = (retornoHtmlPost.vendasCanceladas) == null ? 0 : parseFloat(retornoHtmlPost.vendasCanceladas)
    vendasEmaberto = (retornoHtmlPost.vendasEmaberto) == null ? 0 : parseFloat(retornoHtmlPost.vendasEmaberto)
    vendasFinalizadas = (retornoHtmlPost.vendasFinalizadas) == null ? 0 : parseFloat(retornoHtmlPost.vendasFinalizadas)

    creditoVista = (retornoHtmlPost.creditoVista) == null ? 0 : parseFloat(retornoHtmlPost.creditoVista)
    creditoParcelado = (retornoHtmlPost.creditoParcelado) == null ? 0 : parseFloat(retornoHtmlPost.creditoParcelado)

    var data = google.visualization.arrayToDataTable([
        ['Year', 'Visitations', { role: 'style' }],
        ['Compras', (compras + creditoVista + creditoParcelado), 'color: #FF0000'],
        ['Vendas Finalizadas', vendasFinalizadas, 'color: #006400'],
        ['Renda Liquida', (vendasFinalizadas - (compras + creditoVista + creditoParcelado)), 'color: #DAA520'],
    ]);

    var options = {
        title: 'Fechamento - Graficos',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        // width: '810',
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('piechart1'));

    chart.draw(data, options);
}

function drawChart2(retornoHtmlPost) {

    pix = parseFloat(retornoHtmlPost.formaPagamentoPix)
    debito = parseFloat(retornoHtmlPost.formaPagamentoDebito)
    credito = parseFloat(retornoHtmlPost.formaPagamentoCredito)
    dinheiro = parseFloat(retornoHtmlPost.formaPagamentoDinheiro)
    //    console.log([compras,aportes,vendasCanceladas,vendasEmaberto,vendasFinalizadas])

    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Pix', pix],
        ['Dinheiro', dinheiro],
        ['Debito', debito],
        ['Credito', credito],
    ]);

    var options = {
        title: 'Formas de pagamento finalizadas',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        is3D: true,
        width: '500',
        height: '350',
        colors: ['#0000CD', '#FFD700', '#FF1493', '#000000']

    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

    chart.draw(data, options);
}

function drawChart3(retornoHtmlPost) {

    pix = parseFloat(retornoHtmlPost.formaPagamentoPix)
    debito = parseFloat(retornoHtmlPost.formaPagamentoDebito)
    credito = parseFloat(retornoHtmlPost.formaPagamentoCredito)
    dinheiro = parseFloat(retornoHtmlPost.formaPagamentoDinheiro)
    //    console.log([compras,aportes,vendasCanceladas,vendasEmaberto,vendasFinalizadas])

    var data = google.visualization.arrayToDataTable([
        ['Year', 'Visitations', { role: 'style' }],
        ['Pix', pix, 'color: #0000CD'],
        ['Dinheiro', dinheiro, 'color: #FFD700'],
        ['Debito', debito, 'color: #FF1493'],
        ['Credito', credito, 'color: #000000'],
    ]);

    var options = {
        title: 'Formas de pagamento finalizadas - Graficos',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        //  width: '810',
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('piechart3'));

    chart.draw(data, options);
}
function drawChart4(retornoHtmlPost) {

    creditoVista = (retornoHtmlPost.creditoVista) == null ? 0 : parseFloat(retornoHtmlPost.creditoVista)
    creditoParcelado = (retornoHtmlPost.creditoParcelado) == null ? 0 : parseFloat(retornoHtmlPost.creditoParcelado)

    formaComprasDebito = (retornoHtmlPost.formaComprasDebito) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasDebito)
    formaComprasDinheiro = (retornoHtmlPost.formaComprasDinheiro) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasDinheiro)
    formaComprasPix = (retornoHtmlPost.formaComprasPix) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasPix)

    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Credito a vista', creditoVista],
        ['Credito Parcelado', creditoParcelado],
        ['Debito', formaComprasDebito],
        ['Dinheiro', formaComprasDinheiro],
        ['Pix', formaComprasPix],
    ]);

    var options = {
        title: 'Compras',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        is3D: true,
        width: '500',
        height: '350',
        colors: ['#0000CD', '#FFD700', '#FF1493', '#000000', '#00BFFF']

    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart5'));

    chart.draw(data, options);
}

function drawChart5(retornoHtmlPost) {

    creditoVista = (retornoHtmlPost.creditoVista) == null ? 0 : parseFloat(retornoHtmlPost.creditoVista)
    creditoParcelado = (retornoHtmlPost.creditoParcelado) == null ? 0 : parseFloat(retornoHtmlPost.creditoParcelado)

    formaComprasDebito = (retornoHtmlPost.formaComprasDebito) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasDebito)
    formaComprasDinheiro = (retornoHtmlPost.formaComprasDinheiro) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasDinheiro)
    formaComprasPix = (retornoHtmlPost.formaComprasPix) == null ? 0 : parseFloat(retornoHtmlPost.formaComprasPix)

    var data = google.visualization.arrayToDataTable([
        ['Year', 'Visitations', { role: 'style' }],
        ['Credito a vista', creditoVista, 'color: #0000CD'],
        ['Credito Parcelado', creditoParcelado, 'color: #FFD700'],
        ['Debito', formaComprasDebito, 'color: #FF1493'],
        ['Dinheiro', formaComprasDinheiro, 'color: #000000'],
        ['Pix', formaComprasPix, 'color: #00BFFF'],
    ]);

    var options = {
        title: 'Compras - Graficos',
        // backgroundColor: '#FFE4E1',
        legend: 'none',
        //  width: '810',
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('piechart4'));

    chart.draw(data, options);
}



if (metodoUrlAtual() == 'vendas') {
    //CRIA RECIBO PRA IMPRESSAO NO BACK-END
    let impressao = document.getElementById('impressao')
    impressao.addEventListener('click', (value) => {
        let id = document.getElementById('id').innerHTML
        let retornoRowsTabela = instanciaAjaxHttp('imprimirRecibos', id)
        if (retornoRowsTabela == 'impresso com sucesso') {
            document.getElementById('pedidoImpresso').style.display = 'block'
        } else {

        }
    })
    //RENDERIZA A PAGINA DE ACORDO COM O OPCAO DE PAGAMENTO DO SELECT
    var pagamento = document.getElementById('tabelaVendasOpcoesSelectPagVendas')
    console.log(pagamento.value)
    pagamento.addEventListener('change', (value) => {
        pagamento = document.getElementById('tabelaVendasOpcoesSelectPagVendas')
        //RETORNA A QUERY MONTADA
        let tabela = metodoUrlAtual()
        pagamento = `statusPagamento = '${pagamento.value}' AND`
        let where = ajaxWhere('', tabela, pagamento)
        let retornoRowsTabela = instanciaAjaxHttp('ajaxFiltroInputConsulta', tabela, where, 0, pegandoValordoSelect())
        inserindoConteudoHtml(retornoRowsTabela)
        converterMoedaNacional()
        ajustandoHoraConsultar()
        carregaDataTable()
    })


}


//FORMANDO NOTA FISCAL DE VENDA
function carregarModalReciboNf(id) {
    let notaFiscalAjax = instanciaAjaxHttp('imprimirNotaFiscal', 'vendas', id)
    document.getElementById('recibo').insertAdjacentHTML('afterend', notaFiscalAjax);
    $('#notaFiscal').modal('show')
    //BUSCANDO CNPJ
    let selecinandoTipoPessoa = document.getElementById('selecinandoTipoPessoa')
    let inserirNumeroPessoa = document.getElementById('inserirNumeroPessoa')
    selecinandoTipoPessoa.addEventListener('change', () => {
        let tipoPessoa = document.getElementById('tipoPessoa')
        tipoPessoa.innerHTML = selecinandoTipoPessoa.value
        tipoPessoa.style.textDecoration = "underline"

    })

    inserirNumeroPessoa.addEventListener('input', () => {
        let numeroPessoa = document.getElementById('numeroPessoa')
        numeroPessoa.innerHTML = `${inserirNumeroPessoa.value}`
    })

}

//PAGINA DE DASHBORADS
if (metodoUrlAtual() == 'dashboards') {



    function teste() {
        letObjetoData = {}
        // letObjetoData.dataInicio = '2023-01-01'
        // letObjetoData.dataFim = '2023-01-31'

        // dataInicio = '2023-01-01'
        // dataFim = '2023-01-31'

        // where = whereConsolidado('COUNT', dataInicio, dataFim)
        where = `SELECT
    (SELECT sum(contaFinal) FROM lennysalgados.vendas WHERE dataEntregaProduto BETWEEN CURRENT_DATE() AND CURRENT_DATE() %2B7 AND formaPagamento = 'Em aberto') as aReceber7Dias,
    (SELECT sum(contaFinal) FROM lennysalgados.vendas WHERE  formaPagamento = 'Em aberto' and dataEntregaProduto BETWEEN CURRENT_DATE() AND CURRENT_DATE() %2B1) as aReceberHoje,
    (SELECT sum(contaFinal) FROM lennysalgados.vendas WHERE dataEntregaProduto BETWEEN CURRENT_DATE() -7 AND CURRENT_DATE() AND statusPagamento = 'Finalizado') as vendasFinalizadas7Dias,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 1 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as umDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 2 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as doisDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 3 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as tresDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 4 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as quatroDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 5 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as cincoDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 6 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as seisDia,
    (SELECT SUM(contaFinal) from lennysalgados.vendas where dataEntregaProduto LIKE (CONCAT(CONVERT(current_date() - INTERVAL 7 DAY ,CHAR),'%')) AND statusPagamento = 'Finalizado') as seteDia;
    `
        //CHAMADA AJAX
        retornoHtmlPost = instanciaAjaxHttp('relatorios', 'dashboards', where, 0, '', letObjetoData)
        retornoHtmlPost = (JSON.parse(retornoHtmlPost))
        console.log(retornoHtmlPost)
        //COLETANDO TAG HTML
        let paginaRenderizar = document.getElementById('relatorio')

        let aReceber7Dias = retornoHtmlPost.aReceber7Dias ?? 0
        aReceber7Dias = `R$${parseFloat(aReceber7Dias).toLocaleString('pt-br', { minimumFractionDigits: 2 })}`

        let aReceberHoje = retornoHtmlPost.aReceberHoje ?? 0
        aReceberHoje = `R$${parseFloat(aReceberHoje).toLocaleString('pt-br', { minimumFractionDigits: 2 })}`

        let vendasFinalizadas7Dias = retornoHtmlPost.vendasFinalizadas7Dias ?? 0
        vendasFinalizadas7Dias = `R$${parseFloat(vendasFinalizadas7Dias).toLocaleString('pt-br', { minimumFractionDigits: 2 })}`

        document.getElementById('aReceber7Dias').innerHTML = aReceber7Dias
        document.getElementById('aReceberHoje').innerHTML = aReceberHoje
        document.getElementById('vendasFinalizadas7Dias').innerHTML = vendasFinalizadas7Dias
        let graficos = `  <div style='background-color: white;'>
                        <div class="row">
                            <div class="col-md-6"
                                id="piechart11" style="width: 1000px; height: 350px;">
                            </div>
                        </div>
                        <div>
                        `
        paginaRenderizar.insertAdjacentHTML('afterend', graficos)
        drawChart11(retornoHtmlPost)
    }


    google.charts.load('current', { packages: ['corechart'], language: 'pt-BR' });
    google.charts.setOnLoadCallback();

    console.log(retornoHtmlPost)

    //INICIO DOS GRAFICOS QUE SERAO UTILIZADOS NA OPCAO CONSOLIDADO
    function drawChart11(retornoHtmlPost) {

        umDia = (retornoHtmlPost.umDia) == null ? 0 : retornoHtmlPost.umDia
        doisDia = (retornoHtmlPost.doisDia) == null ? 0 : retornoHtmlPost.doisDia
        tresDia = (retornoHtmlPost.tresDia) == null ? 0 : retornoHtmlPost.tresDia
        quatroDia = (retornoHtmlPost.quatroDia) == null ? 0 : retornoHtmlPost.quatroDia
        cincoDia = (retornoHtmlPost.cincoDia) == null ? 0 : retornoHtmlPost.cincoDia
        seisDia = (retornoHtmlPost.seisDia) == null ? 0 : retornoHtmlPost.seisDia
        seteDia = (retornoHtmlPost.seteDia) == null ? 0 : retornoHtmlPost.seteDia

        var primeiro = new Date();
        (primeiro.setDate(primeiro.getDate() - 7))

        var segundo = new Date();
        (segundo.setDate(segundo.getDate() - 6))

        var terceiro = new Date();
        (terceiro.setDate(terceiro.getDate() - 5))

        var quatro = new Date();
        (quatro.setDate(quatro.getDate() - 4))

        var cinco = new Date();
        (cinco.setDate(cinco.getDate() - 3))

        var seis = new Date();
        (seis.setDate(seis.getDate() - 2))

        var sete = new Date();
        (sete.setDate(sete.getDate() - 1))


        var data = google.visualization.arrayToDataTable([
            ['ultima semana', 'Vendas finalizadas R$', '-'],
            [`${primeiro.toLocaleString().substring(0, 2)}`, parseFloat(seteDia), 1],
            [`${segundo.toLocaleString().substring(0, 2)}`, parseFloat(seisDia), 1],
            [`${terceiro.toLocaleString().substring(0, 2)}`, parseFloat(cincoDia), 1],
            [`${quatro.toLocaleString().substring(0, 2)}`, parseFloat(quatroDia), 1],
            [`${cinco.toLocaleString().substring(0, 2)}`, parseFloat(tresDia), 1],
            [`${seis.toLocaleString().substring(0, 2)}`, parseFloat(doisDia), 1],
            [`${sete.toLocaleString().substring(0, 2)}`, parseFloat(umDia), 1],

        ]);

        var options = {
            title: 'Consolidado Lenny Salgados',

            hAxis: { title: 'Ultimos 7 dias', titleTextStyle: { color: '#333' } },
            vAxis: { minValue: 0 },
            titleTextStyle: {
                color: 'red',
                backgroundColor: '#FFE4E1',

            },

            // animation: {
            //     duration: 1000,
            //     easing: 'out',
            // },



        };

        var chart = new google.visualization.AreaChart(document.getElementById('piechart11'));
        chart.draw(data, options);
    }
}


// function drawChart11() {

//     var data = google.visualization.arrayToDataTable([
//       ['Tarefas', 'Horas por dia'],
//       ['Trabalho', 11],
//       ['Comida', 2],
//       ['Comunitário', 2],
//       ['TV', 2],
//       ['Dormir', 7]
//     ]);

//     var options = {
//       title: 'Atividades',
//     };

//     var chart = new google.visualization.PieChart(document.getElementById('piechart11'));
//     chart.draw(data, options);

//     var counter = 0;

//     var handler = setInterval(function(){
//         counter = counter + 0.1
//         options = {
//           title: 'Atividades',
//           slices: { 1: {offset: counter},
//                     3: {offset: counter},
//                     5: {offset: counter},
//           }
//         };
//         chart.draw(data, options);

//         if (counter > 0.3) clearInterval(handler);
//     }, 200);
//   } 


