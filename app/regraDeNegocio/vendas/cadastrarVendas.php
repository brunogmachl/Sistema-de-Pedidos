<?php

namespace App\regraDeNegocio\vendas;
use App\codigosProntos\CriarTabela\CriarTabela;


 class cadastrarVendas{

    /**
     *FUNÇÃO RESPONSAVEL POR CARREGAR OS CLIENTES NA PAGINA DE CADASTRO
     * @return string
     */
    public function cadastrarVendas(){

        $caminhoArquivoHtml = file_get_contents('C:\xampp\htdocs\lenny\view\html\vendas\cadastrarVendas.php');

        $cadastrarVendaClientes = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\clientes.php';
        $tabelaVendaClientes = CriarTabela::CriarTabela('clientes', 'ORDER BY cliente asc', '', '', $cadastrarVendaClientes);
        $itemFinal = str_replace('{{clientes}}', $tabelaVendaClientes,$caminhoArquivoHtml);
        
        $cadastrarVendaProdutos = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\produtos.php';

        $tabelaVendaProdutos = CriarTabela::CriarTabela('produtos', 'ORDER BY produto asc', '', '', $cadastrarVendaProdutos);
        $itemFinal = str_replace('{{produtos}}', $tabelaVendaProdutos,$itemFinal);
        echo $itemFinal;
        
    }

}
