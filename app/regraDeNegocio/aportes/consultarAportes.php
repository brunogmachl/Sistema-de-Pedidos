<?php

namespace App\regraDeNegocio\aportes;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;

class consultarAportes
{

    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp,inicio]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarAportes($parametrosQuery)
    {
        $table =  $parametrosQuery[0];
        //TERA ORDER BY CASO SEJA ATUALIZACAO DE COMPRA
        $where = $parametrosQuery[1] == '' ? 'ORDER BY id desc' : $parametrosQuery[1];
        $paginacao = $parametrosQuery[2] != '' ? $parametrosQuery[2] : '' ; 
        $limite = $parametrosQuery[3];
        $ajaxOuHttp= isset($parametrosQuery[4]) ? $parametrosQuery[4] : '' ; 
        $inicio = ($paginacao * $limite);

        $inicio = ($paginacao * $limite);
        
        
       $caminhoArquivoHtml = 'C:\xampp\htdocs\lenny\view\html\aportes\templates\consultarAportes\aportes.php';
        $itemFinal = CriarTabela::CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml);

        //SE FOR INSTANCIADO VIA AJAX
        if($ajaxOuHttp == 'ajax'){
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\aportes\conteudoAjaxSemFiltro\consultarAporteSemFiltro.php');
            $paginaHtml = str_replace(['{{aportes}}'], [$itemFinal], $consultarVendas);
      
        //SE FOR INSTANCIADO VIA GET    
        }else{
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\aportes\consultarAportes.php');
            $filterConsultarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\aportes\botaoPaginação\filterConsultarAporte.php');
            $paginaHtml = str_replace(['{{aportes}}', '{{filterConsultarAporte}}'], [$itemFinal, $filterConsultarVenda], $consultarVendas);
        }

        $inicioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\aportes\botaoPaginação\inicioBotaoPaginacao.php';
        $meioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\aportes\botaoPaginação\meioBotaoPaginacao.php';
        $fimBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\aportes\botaoPaginação\fimBotaoPaginacao.php';
        $getPaginacao = new Paginacao($table,$where,$paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao);
        echo $getPaginacao->getPaginacao();
    }

}