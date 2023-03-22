<?php

namespace App\regraDeNegocio\clientes;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;

class consultarClientes
{

    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarClientes($parametrosQuery)
    {

        $table =  $parametrosQuery[0];
        $where = $parametrosQuery[1];
        $paginacao = $parametrosQuery[2] != '' ? $parametrosQuery[2] : '' ; 
        $limite = $parametrosQuery[3];
        $ajaxOuHttp= isset($parametrosQuery[4]) ? $parametrosQuery[4] : '' ; 
        $inicio = ($paginacao * $limite);

        $inicio = ($paginacao * $limite);
        
        
       $caminhoArquivoHtml = 'C:\xampp\htdocs\lenny\view\html\clientes\templates\consultarClientes\clientes.php';
        $itemFinal = CriarTabela::CriarTabela($table, $where, $inicio, $limite, $caminhoArquivoHtml);

        //SE FOR INSTANCIADO VIA AJAX
        if($ajaxOuHttp == 'ajax'){
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\clientes\conteudoAjaxSemFiltro\consultarClienteSemFiltro.php');
            $paginaHtml = str_replace(['{{clientes}}'], [$itemFinal], $consultarVendas);
      
        //SE FOR INSTANCIADO VIA GET    
        }else{
            $consultarVendas = file_get_contents('C:\xampp\htdocs\lenny\view\html\clientes\consultarCliente.php');
            $filterConsultarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\clientes\botaoPaginação\filterConsultarCliente.php');
            $paginaHtml = str_replace(['{{clientes}}', '{{filterConsultarCliente}}'], [$itemFinal, $filterConsultarVenda], $consultarVendas);
        }

        $inicioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\clientes\botaoPaginação\inicioBotaoPaginacao.php';
        $meioBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\clientes\botaoPaginação\meioBotaoPaginacao.php';
        $fimBotaoPaginacao = 'C:\xampp\htdocs\lenny\view\html\clientes\botaoPaginação\fimBotaoPaginacao.php';
        $getPaginacao = new Paginacao($table,$where,$paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao);
        echo $getPaginacao->getPaginacao();
    }

}