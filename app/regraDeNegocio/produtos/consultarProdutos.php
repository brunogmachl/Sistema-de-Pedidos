<?php

namespace App\regraDeNegocio\produtos;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;

class consultarProdutos
{

    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp,inicio]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarProdutos($parametrosQuery)
    {
        $table =  $parametrosQuery[0];
        $where = $parametrosQuery[1];
        $paginacao = $parametrosQuery[2] != '' ? $parametrosQuery[2] : '' ; 
        $limite = $parametrosQuery[3];
        $ajaxOuHttp= isset($parametrosQuery[4]) ? $parametrosQuery[4] : '' ; 
        $inicio = ($paginacao * $limite);

        $inicio = ($paginacao * $limite);
        
        
       $caminhoArquivoHtml = 'C:\xampp\htdocs\lenny\view\html\produtos\templates\consultarProdutos\produtos.php';
        $itemFinal = CriarTabela::CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml);

        //SE FOR INSTANCIADO VIA AJAX
        if($ajaxOuHttp == 'ajax'){
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\produtos\conteudoAjaxSemFiltro\consultarProdutoSemFiltro.php');
            $paginaHtml = str_replace(['{{produtos}}'], [$itemFinal], $consultarVendas);
      
        //SE FOR INSTANCIADO VIA GET    
        }else{
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\produtos\consultarProdutos.php');
            $filterConsultarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\produtos\botaoPaginação\filterConsultarProduto.php');
            $paginaHtml = str_replace(['{{produtos}}', '{{filterConsultarProduto}}'], [$itemFinal, $filterConsultarVenda], $consultarVendas);
        }

        $inicioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\produtos\botaoPaginação\inicioBotaoPaginacao.php';
        $meioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\produtos\botaoPaginação\meioBotaoPaginacao.php';
        $fimBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\produtos\botaoPaginação\fimBotaoPaginacao.php';
        $getPaginacao = new Paginacao($table,$where,$paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao);
        echo $getPaginacao->getPaginacao();
    }

}