<?php

namespace App\construct;

use App\regraDeNegocio\vendas\ajax\ajaxFiltro;

class Controller
{
    /**
     * RESPONSVEL POR INSTANCIAR AS CLASSES RECEBIDAS VIA GET E ENCAMINHAR OS PARAMETROS VIA ARRAY (SETADO NO ARQUIVO ROUTE)
     * @param array $rota
     * @return void
     */
    static function direction($rota)
    {
        // echo '<pre>';
        // print_r($_SERVER['HTTP_HOST']) ;
        // echo '</pre>';
        // exit();
        $retornaTodasVariaveis = parse_url($_SERVER['REQUEST_URI']);
        parse_str($retornaTodasVariaveis['query'], $apenasVariaveisUrl);
        foreach($rota as $rota){
            if($apenasVariaveisUrl['metodo'] == $rota['url'] ){
                $pasta = $rota['pasta'];
                $metodoConsultarVenda =  "App\\regraDeNegocio\\$pasta\\" . $apenasVariaveisUrl['metodo'];
                $objetoDinamico = new  $metodoConsultarVenda;
                $metodo = $rota['metodo'];
                $objetoDinamico->$metodo($rota['parametros']);
            }
        }
    }

    /**
     * RESPONSAVEL PELO FILTRO AJAX DO BANCO DE DADOS CLIENTE
     * @param string $ajax
     * @return void
     */
    static function ajaxFiltro($ajax)
    {
        $cadastrarProduto = new ajaxFiltro;
        $cadastrarProduto->listarClientes($ajax);
    }


    /**
     * RESPONSAVEL PELO FILTRO AJAX DO BANCO DE DADOS PRODUTO
     * @param string $ajax
     * @return void
     */
    static function ajaxProdutos($ajax)
    {
        $cadastrarProduto = new ajaxFiltro;
        $cadastrarProduto->listarProdutos($ajax);
    }


    /**
     * METODO RESPONSAVEL POR CADASTRAR A VENDA
     *
     * @param array $ajax
     * @return void
     */
    static function cadastrarProduto($ajax)
    {
        $cadastrarProduto = new ajaxFiltro;
        $cadastrarProduto->listarProdutos($ajax);
    }
}
