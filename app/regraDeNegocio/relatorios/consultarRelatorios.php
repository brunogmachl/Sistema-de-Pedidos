<?php

namespace App\regraDeNegocio\relatorios;

use App\codigosProntos\Paginacao\Paginacao;
use App\codigosProntos\CriarTabela\CriarTabela;
use App\db\Model;

class consultarRelatorios
{
    /**
     * SEQUENCIA DO ARRAY [table,where,paginacao,limite,ajaxouhttp,inicio]
     * @param array $parametrosQuery
     * @return void
     */
    public function consultarRelatorios($parametrosQuery)
    {

        
 
        if (count($parametrosQuery) == 0) {
            $paginaInicial = file_get_contents('C:\xampp\htdocs\lenny\view\html\relatorios\cabecalhoDaPagina.php');
            echo $paginaInicial;
        } else {

            $table =  $parametrosQuery[2];
            $tableProvisorio = $table;
            $where = $parametrosQuery[3];
            $paginacao = $parametrosQuery[4];
            $limite = $parametrosQuery[5];
            $statusFormaPagamento = json_decode($parametrosQuery[6], true);
            $inicio = ($paginacao * $limite);

            if ((@$statusFormaPagamento['statusPagamento'] == 'em aberto')) {
                $tituloValorTotal = 'Total das vendas a receber';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'finalizado')) {
                $tituloValorTotal = 'Total das vendas finalizadas';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'cancelado')) {
                $tituloValorTotal = 'Total das vendas canceladas';
            } else if (@$statusFormaPagamento['statusPagamento'] == 'todos') {
                $tituloValorTotal = 'Soma total';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'debito')) {
                $tituloValorTotal = 'Total vendas no debito';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'credito')) {
                $tituloValorTotal = 'Total vendas no credito';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'dinheiro')) {
                $tituloValorTotal = 'Total vendas no dinheiro';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'pix')) {
                $tituloValorTotal = 'Total vendas no pix';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'pixCompras')) {
                $tituloValorTotal = 'Total compras no pix';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'dinheiroCompras')) {
                $tituloValorTotal = 'Total compras no dinheiro';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'debitoCompras')) {
                $tituloValorTotal = 'Total compras no debito';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'creditoVista')) {
                $tituloValorTotal = 'Total compras cartao a vista';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'creditoParcelado')) {
                $tituloValorTotal = 'Total compras Parceladas';
            } else if ((@$statusFormaPagamento['statusPagamento'] == 'creditoParceladoDet')) {
                $tituloValorTotal = 'Compras Parceladas Detalhes';
            }


            //REPRESENTA O NOME DA COLUNA COM O VALOR TOTAL PARA SER SOMANDO E INSERIDO NA TABELA
            if(@$parametrosQuery[2] == 'vendas'){
                $coluna = 'contaFinal';
            }else if(@$statusFormaPagamento['statusPagamento'] == 'creditoParceladoDet'){
                $coluna = 'valorFinal';
            }else{
                $coluna = 'valor';
            }

            //NESSE MOMENTO TABLE TEM QUE SER O NOME QUE VEM DO JS DEVIDO AO CAMINHO DO ARQUIVO
            if (@$statusFormaPagamento['statusPagamento'] == 'creditoVista') {
                $loopTableTd = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\\comprasCartao\\$table.php";
                $arquivoPrincipalVenda = file_get_contents("C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\comprasCartao\principal" . $table . ".php");
                
            }
             else if (@$statusFormaPagamento['statusPagamento'] == 'creditoParceladoDet') {
                $loopTableTd = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\\comprasCartaoParcelado\\$table.php";
                $arquivoPrincipalVenda = file_get_contents("C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\comprasCartaoParcelado\principal" . $table . ".php");
                            
            } 
            else {
                $loopTableTd = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\\$table.php";
                $arquivoPrincipalVenda = file_get_contents("C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\\principal" . $table . ".php");
            }


            if(@$statusFormaPagamento['statusPagamento'] == 'creditoParceladoDet'){
                $tableProvisorio = 'parcelascartao';
            }else if(@$statusFormaPagamento['statusPagamento'] == 'creditoParcelado'){
                $tableProvisorio = 'compras';
            }else{
                $tableProvisorio = $table;
            }

            $valorTotalFinal = ((Model::somar($tableProvisorio, $where, $coluna)));
            $valorTotalFinal = ($valorTotalFinal[0]["SUM($coluna)"]);
            //PASSANDO PARA MOEDA - REAL
            $valorTotalFinal = number_format($valorTotalFinal, 2, ',', '.');
            if ($table == 'vendas') {
                $htmlResultadoFinal = "<tr class='' style='background-color: #c7a4a4; color:black'><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td style='text-align:end'>R$ $valorTotalFinal</td></tr>";
            } else if ($table == 'compras') {
                $htmlResultadoFinal = "<tr class='' style='background-color: #c7a4a4; color:black'><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td style='text-align:end'>R$ $valorTotalFinal</td></tr>";
            } else if ($table == 'aportes') {
                $htmlResultadoFinal = "<tr class='' style='background-color: #c7a4a4; color:black'><td>-</td><td>-</td><td>-</td><td style='text-align:end';>R$ $valorTotalFinal</td></tr>";
            }
     

            $itemFinal = ((CriarTabela::CriarTabela($tableProvisorio, $where, $inicio, $limite, $loopTableTd)));
            $paginaHtml = str_replace(['{{' . $table . '}}', '{{valorTotalFinalSomado}}', '{{titulo ValorTotal}}', '{{resultadoFinal}}'], [$itemFinal, $valorTotalFinal, @$tituloValorTotal, $htmlResultadoFinal], $arquivoPrincipalVenda);

            $inicioBotaoPaginacao = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\botaoPaginação\inicioBotaoPaginacao.php";
            $meioBotaoPaginacao = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\botaoPaginação\meioBotaoPaginacao.php";
            $fimBotaoPaginacao = "C:\\xampp\htdocs\lenny\\view\html\\relatorios\\$table\botaoPaginação\\fimBotaoPaginacao.php";
            $getPaginacao = new Paginacao($tableProvisorio, $where, $paginacao, $limite, $paginaHtml, $inicioBotaoPaginacao, $meioBotaoPaginacao, $fimBotaoPaginacao);
            echo $getPaginacao->getPaginacao();
        }
    }

    /**
     * TRAZ OS VALORES DO CONSOLIDADO (COMPRAS / VENDAS) -> GRAFICOS
     * @param array $parametrosQuery
     * @return void
     */
    function consolidado($parametrosQuery)
    {

        $query = $parametrosQuery[3];
        $valorTotalFinal = ((Model::queryPronta($query)));
        $graficosConsolidado = file_get_contents('C:\xampp\htdocs\lenny\view\html\relatorios\consolidade\consolidado.php');
        print_r(json_encode($valorTotalFinal[0]));
    }
}
