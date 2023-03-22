<?php

namespace App\regraDeNegocio\vendas\ajax;

use App\db\Model;
use App\codigosProntos\CriarTabela\CriarTabela;


/**
 * REPONSAVEL PELA FILTRO AJAX DOS CAMPOS CLIENTES E PRODUTOS, CADASTRAR E EDITAR VENDAS NO BANCO DE DADOS
 */
 class ajaxFiltro
{
    /**
     * METHODO RESPONSAVEL POR CHAMAR A ESTANCIA DO BANCO DE DADOS PASSANDO OS PARAMETROS DO FILTRO-AJAX DOS CLIENTES
     *
     * @param string $id
     * @return void
     */
    function listarClientes($id){
        $where = "WHERE(id LIKE '$id' or cliente LIKE '$id' or endereco LIKE '$id' or bairro LIKE '$id' or cidade LIKE '$id' or estado LIKE '$id' or cep LIKE '$id' or telefone LIKE '$id' or email LIKE '$id' or obs LIKE '$id') ORDER BY cliente asc";

        $caminhoArquivoHtml  = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\clientes.php';
        $tabelaVendaClientes = CriarTabela::CriarTabela('clientes', $where, '', '', $caminhoArquivoHtml );
        $pagina = $tabelaVendaClientes;
        echo $pagina;
    }

    /**
     * METHODO RESPONSAVEL POR CHAMAR A ESTANCIA DO BANCO DE DADOS PASSANDO OS PARAMETROS DO FILTRO-AJAX DOS PRODUTOS
     * @param string $id
     * @return void
     */
    function listarProdutos($id){
        $where = "WHERE (id LIKE '$id' or produto LIKE '$id' or valor LIKE '$id') ORDER BY produto asc";
        $caminhoArquivoHtml  = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\produtos.php';
        $tabelaVendaClientes = CriarTabela::CriarTabela('produtos', $where, '', '', $caminhoArquivoHtml );
        $pagina = $tabelaVendaClientes;
        echo $pagina;
    }

    /**
     * CADASTRAR VENDA NO BANCO DE DADOS 
     * @param array $vendaArray
     * @return object
     */
    static function cadastrarVenda($vendaArray){
        $venda = [];
        $venda['clienteCod'] = $vendaArray['cliente'][0];
        $venda['clienteNome'] = $vendaArray['cliente'][1]; 
        $venda['clienteTelefone'] = $vendaArray['cliente'][2]; 
        $venda['funcionario'] = $vendaArray['funcionario']; 
        $venda['desconto'] = $vendaArray['desconto']; 
        $venda['entrega'] = $vendaArray['entrega']; 
        $venda['observacao'] = $vendaArray['observacao']; 
        $venda['dataEntregaProduto'] = $vendaArray['dataEntregaProduto']; 
        $venda['produtosFinais'] = json_encode($vendaArray['produtosFinais']);

        $venda['valorTotal'] = $vendaArray['valorTotal'];
        $venda['contaFinal'] = $vendaArray['contaFinal'];
        $venda['statusPagamento'] = $vendaArray['statusPagamento']; 
        $venda['formaPagamento'] = $vendaArray['formaPagamento']; 
        
        return Model::inserir('vendas',$venda);

    }

    /**
     * ATUALIZAR VENDA (EDITA) NO BANCO DE DADOS
     * @param array $vendaArray
     * @return object
     */
    static function updateVenda($vendaArray){

        $venda = [];
        $venda['clienteCod'] = $vendaArray['cliente'][0];
        $venda['clienteNome'] = $vendaArray['cliente'][1]; 
        $venda['clienteTelefone'] = $vendaArray['cliente'][2]; 
        $venda['funcionario'] = $vendaArray['funcionario']; 
        $venda['desconto'] = $vendaArray['desconto']; 
        $venda['entrega'] = $vendaArray['entrega']; 
        $venda['observacao'] = $vendaArray['observacao']; 
        $venda['dataEntregaProduto'] = $vendaArray['dataEntregaProduto']; 
        $venda['produtosFinais'] = json_encode($vendaArray['produtosFinais']);

        $venda['valorTotal'] = $vendaArray['valorTotal'];
        $venda['contaFinal'] = $vendaArray['contaFinal']; 
        $venda['statusPagamento'] = $vendaArray['statusPagamento'];
        $venda['formaPagamento'] = $vendaArray['formaPagamento'];

        
         $retornoUpdate = Model::update('vendas',$venda,'id='.$vendaArray['id']);
         if($retornoUpdate == 1){
            return $vendaArray['id'];
        //    return $vendaArray['id'];
         }
    }
}
