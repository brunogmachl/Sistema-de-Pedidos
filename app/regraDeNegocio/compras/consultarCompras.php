<?php

namespace App\regraDeNegocio\compras;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;

class consultarCompras
{

    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp,inicio]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarCompras($parametrosQuery)
    {
        $table =  $parametrosQuery[0];
        //TERA ORDER BY CASO SEJA ATUALIZACAO DE COMPRA
        $where = $parametrosQuery[1] == '' ? 'ORDER BY id desc' : $parametrosQuery[1];
        $paginacao = $parametrosQuery[2] != '' ? $parametrosQuery[2] : '' ; 
        $limite = $parametrosQuery[3];
        $ajaxOuHttp= isset($parametrosQuery[4]) ? $parametrosQuery[4] : '' ; 
        $inicio = ($paginacao * $limite);

        $inicio = ($paginacao * $limite);
        
        
       $caminhoArquivoHtml = 'C:\xampp\htdocs\lenny\view\html\compras\templates\consultarCompras\compras.php';
        $itemFinal = CriarTabela::CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml);

        //SE FOR INSTANCIADO VIA AJAX
        if($ajaxOuHttp == 'ajax'){
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\compras\conteudoAjaxSemFiltro\consultarCompraSemFiltro.php');
            $paginaHtml = str_replace(['{{compras}}'], [$itemFinal], $consultarVendas);
      
        //SE FOR INSTANCIADO VIA GET    
        }else{
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\compras\consultarCompras.php');
            $filterConsultarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\compras\botaoPaginação\filterConsultarCompra.php');
            $paginaHtml = str_replace(['{{compras}}', '{{filterConsultarCompra}}'], [$itemFinal, $filterConsultarVenda], $consultarVendas);
        }

        $inicioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\compras\botaoPaginação\inicioBotaoPaginacao.php';
        $meioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\compras\botaoPaginação\meioBotaoPaginacao.php';
        $fimBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\compras\botaoPaginação\fimBotaoPaginacao.php';
        $getPaginacao = new Paginacao($table,$where,$paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao);
        echo $getPaginacao->getPaginacao();
    }

}