<?php

namespace App\regraDeNegocio\dashboards;



class consultarDashboards
{

    /**
     * TRAZ OS VALORES DO CONSOLIDADO (COMPRAS / VENDAS) -> GRAFICOS
     * @param array $parametrosQuery
     * @return void
     */
    function consultarDashboards($parametrosQuery)
    {

        // echo 'ola';

        $arquivoHtml = file_get_contents('C:\xampp\htdocs\lenny\view\html\dashboard\cabecalhoDaPagina.php');
        echo $arquivoHtml;


        // $query = $parametrosQuery[3];
        // $valorTotalFinal = ((Model::queryPronta($query)));
        // $graficosConsolidado = file_get_contents('C:\xampp\htdocs\lenny\view\html\relatorios\consolidade\consolidado.php');
        // print_r(json_encode($valorTotalFinal[0]));
    }
}
