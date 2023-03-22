<?php

namespace App\regraDeNegocio\funcionarios;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;

class consultarFuncionarios
{

    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp,inicio]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarFuncionarios($parametrosQuery)
    {

        $table =  $parametrosQuery[0];
        $where = $parametrosQuery[1];
        $paginacao = $parametrosQuery[2] != '' ? $parametrosQuery[2] : '' ; 
        $limite = $parametrosQuery[3];
        $ajaxOuHttp= isset($parametrosQuery[4]) ? $parametrosQuery[4] : '' ; 
        $inicio = ($paginacao * $limite);

        $inicio = ($paginacao * $limite);
        
        
       $caminhoArquivoHtml = 'C:\xampp\htdocs\lenny\view\html\funcionarios\templates\consultarFuncionarios\funcionarios.php';
        $itemFinal = CriarTabela::CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml);
        

        //SE FOR INSTANCIADO VIA AJAX
        if($ajaxOuHttp == 'ajax'){
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\funcionarios\conteudoAjaxSemFiltro\consultarFuncionariosemFiltro.php');
            $paginaHtml = str_replace(['{{funcionarios}}'], [$itemFinal], $consultarVendas);
            
      
        //SE FOR INSTANCIADO VIA GET    
        }else{
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\funcionarios\consultarFuncionarios.php');
            $filterConsultarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\funcionarios\botaoPaginação\filterConsultarFuncionario.php');
            $paginaHtml = str_replace(['{{funcionarios}}', '{{filterConsultarFuncionario}}'], [$itemFinal, $filterConsultarVenda], $consultarVendas);
           
        }
        

        $inicioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\funcionarios\botaoPaginação\inicioBotaoPaginacao.php';
        $meioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\funcionarios\botaoPaginação\meioBotaoPaginacao.php';
        $fimBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\funcionarios\botaoPaginação\fimBotaoPaginacao.php';
        $getPaginacao = new Paginacao($table,$where,$paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao);
        echo $getPaginacao->getPaginacao();
    }

}