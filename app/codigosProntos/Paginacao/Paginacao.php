<?php

namespace App\codigosProntos\Paginacao;

use App\db\Model;

class Paginacao
{
    /**
     * NOME DA TABELA
     * @var string
     */
    static $table;

    /**
     * QUERY DE WHERE(FILTROS E PAGINAÇÃO)
     * @var string
     */
    static $where;

    /**
     * RECEBE O NUMERO DA PAGINA PELA VARIAVEL PAG VIA GET(URL)
     * @var 
     */
    static $paginacao;

    /**
     * QUANTIDADE DE LINHAS POR PAGINA NA TABELA
     * @var integer
     */
    static $limite;

    /**
     * CARREGA A PAGINA HTML QUE SERA RENDERIZADO NO FINAL
     * @var string
     */
    static $paginaHtml;

    /**
     * ARMAZENA O CONTEUDO (ROWS) DO BANDO DE DADOS NO METODO CONSULTAR VENDA
     */
    static $itemFinal;


    /**
     * QUANTIDADE TOTAL DE LINHAS NO BANCO DE DADOS
     */
    static $totalrow;

    /**
     * PAGINA INICIO PAGINACAO
     */
    static $inicioBotaoPaginacao;

    /**
     * PAGINA MEIO PAGINACAO
     */
    static $meioBotaoPaginacao;

    /**
     * PAGINA FIM PAGINACAO
     */
    static $fimBotaoPaginacao;


    /**
     * CARREGA OS ATRIBUTOS
     * @param string $table 
     * @param string $where
     * @param integer $paginacao NUMERO DA PAGINA ATUAL
     * @param integer $limite QUANTIDADE DE LINHAS POR PAGINA
     * @param string $paginaHtml CONTEUDO HTML QUE SERA RENDERIZADO NA PAGINA
     * @param [type] $inicioBotaoPaginacao PAGINA INICIO PAGINACAO
     * @param [type] $meioBotaoPaginacao PAGINA MEIO PAGINACAO
     * @param [type] $fimBotaoPaginacao PAGINA FIM PAGINACAO
     */
    public function __construct($table, $where, $paginacao, $limite, $paginaHtml,$inicioBotaoPaginacao,$meioBotaoPaginacao,$fimBotaoPaginacao)
    {
        self::$table = $table;
        self::$where = $where;
        self::$paginacao = $paginacao;
        self::$limite = $limite;
        self::$paginaHtml = $paginaHtml;
        self::$inicioBotaoPaginacao = $inicioBotaoPaginacao;
        self::$meioBotaoPaginacao = $meioBotaoPaginacao;
        self::$fimBotaoPaginacao = $fimBotaoPaginacao;
   

    }

    /**
     * METODO RESPONSAVEL POR ENTREGAR OS BOTOES DA PAGINACAO
     * @return string
     */
    public function getPaginacao(){
        self::totalBancoDeDados();
        self::botaoPaginacao();
        return self::$paginaHtml;
    }

    /**
     * CRIA OS BOTOES DA PAGINACAO E O DICUMENTO HTML
     * @param array $totalrow QUANTIDADE DE LINHAS DO BANCO DE DADOS
     * @param integer $paginacao PAGINA QUE O FOI ENVIADA VIA GET
     * @param string $paginaHtml PAGINA HTML QUE SERA RENDERIZADA
     * @return string PAGINA HTML PRONTA PRA SER RENDERIZADA
     */
    private function botaoPaginacao()
    {
        $total_regPaginacao = @count(self::$totalrow);
        $num_paginas = @ceil(count(self::$totalrow) / self::$limite);
        $numeroPagina = self::$paginacao;

        $inicioBotaoPaginacao = file_get_contents(self::$inicioBotaoPaginacao);
        $meioBotaoPaginacao = file_get_contents(self::$meioBotaoPaginacao);
        $fimBotaoPaginacao = file_get_contents(self::$fimBotaoPaginacao);
        $lacoFinal = '';
        for ($i = 0; $i < $num_paginas; $i++) {
            $estilo = "";
            if ($numeroPagina >= ($i - 2) and $numeroPagina <= ($i + 2)) {
                if ($numeroPagina == $i)
                    $estilo = "active";
                $pag = $i + 1;
                @$ultimo_reg = $num_paginas - 1;
                $laco = str_replace(['{$estilo}', '{$i}', '{$pag}'], [$estilo, $i, $pag], $meioBotaoPaginacao);
                $lacoFinal .= $laco;
            }
        }

        self::$paginaHtml = str_replace(['{{inicio}}'], [$inicioBotaoPaginacao], self::$paginaHtml);
        self::$paginaHtml = str_replace(['{{meio}}'], [$lacoFinal], self::$paginaHtml);

        $fimBotaoPaginacao = @str_replace(['{$ultimo_reg}', '{{total_regPaginacao}}'], [$ultimo_reg, $total_regPaginacao], $fimBotaoPaginacao);
        self::$paginaHtml = str_replace(['{{fim}}'], [$fimBotaoPaginacao], self::$paginaHtml);
    }

    /**
     * RETORNA QUANTIDADE DE LINHAS TOTAIS PARA SER UTILIZADO NA PAGINAÇÃO
     * @param string $table
     * @return array
     */
    private function totalBancoDeDados()
    {
        $row = Model::listar(self::$table, self::$where);
        self::$totalrow = $row;
    }
}
