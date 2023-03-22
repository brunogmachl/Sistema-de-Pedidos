<?php

namespace App\regraDeNegocio\fiscal;

use App\db\Model;


class fiscal
{


    public function fiscal($arrayPost)
    {
        $id = $arrayPost[3];
        $arquivoHtml = file_get_contents('C:\xampp\htdocs\lenny\view\html\vendas\templates\consultarVendas\modalNotaFiscal\modalNotaFiscal.php');

        $retornoDadosNotaFiscal = Model::listar('vendas', "WHERE id = $id")[0];
        $cliente = $retornoDadosNotaFiscal['clienteNome'];
        $pedido = $retornoDadosNotaFiscal['id'];
        $entrega = $retornoDadosNotaFiscal['entrega'];
        $produtosFinais = json_decode($retornoDadosNotaFiscal['produtosFinais']);

        $dataPedido = $retornoDadosNotaFiscal['dataEntregaProduto'];
        $dataPedido = $dataPedido;
        $dia = (str_replace(" ", "T", $dataPedido));
        $dataPedido = substr(date('d/m/Y H:i',  strtotime($dia)), 0, 10);

        $valorTotal = $retornoDadosNotaFiscal['valorTotal'];
        $valorTotalNew = number_format($valorTotal, 2, ',', '.');

        $desconto = $retornoDadosNotaFiscal['desconto'];

        $valorFinal = $retornoDadosNotaFiscal['contaFinal'];
        $valorFinalNew = number_format($valorFinal, 2, ',', '.');

        $pagamento = $retornoDadosNotaFiscal['formaPagamento'];

        $htmlPrincipal = str_replace(
            [
                '{{cliente}}', '{{pedido}}', '{{entrega}}', '{{dataPedido}}',
                '{{valorTotal}}', '{{desconto}}', '{{valorFinal}}', '{{pagamento}}'
            ],
            [$cliente, $pedido, $entrega, $dataPedido, $valorTotalNew, $desconto, $valorFinalNew , $pagamento],
            $arquivoHtml
        );

        
        $contas = '';
        $somaProdutos = '';
        foreach ($produtosFinais as $produtos) {

            $limitandoCaracterProduto = substr($produtos[1],0,35) ;


            //PASSANDO MOEDA NACIONAL PARA AMERICANA
            $valorTotalProduto = str_replace('.','',$produtos[3]);
            $valorTotalProduto = str_replace(',','.',$valorTotalProduto);

            //PASSANDO MOEDA NACIONAL PARA AMERICANA
            $valorUnidadeProduto = str_replace('.','',$produtos[2]);
            $valorUnidadeProduto = str_replace(',','.',$valorUnidadeProduto);

            //OBTENDO VALOR DA UNIDADE DO PRODUTO
            @$resultadoFinal = $valorTotalProduto / $valorUnidadeProduto;
            $contas .= "$valorTotalProduto / $valorUnidadeProduto" . "<br>";


            $valorProdutoUnidadeNew = number_format($resultadoFinal, 2, ',', '.');
            $somaProdutos .= "<tr><td class='produtosNotaFiscal'>$limitandoCaracterProduto</td><td style='text-align: center;width: 50px' class='produtosNotaFiscal'>$valorProdutoUnidadeNew</td><td style='text-align: center;width: 30px' class='produtosNotaFiscal'>$produtos[2]</td><td style='text-align: center;width: 40px' class='produtosNotaFiscal'>$produtos[3]</td></tr>";
        };

        $htmlPrincipal = str_replace(
            [
                '{{produtos}}'
            ],
            [$somaProdutos],
            $htmlPrincipal
        );

        echo $htmlPrincipal;
        // echo $contas;
        
    }
}

?>
<!-- Array
(
    [0] => Array
        (
            [id] => 128
            [clienteCod] => 1397
            [clienteNome] => ANDERSON
            [clienteTelefone] => 991022593
            [statusPagamento] => Em aberto
            [funcionario] => Lenny
            [desconto] => 0
            [entrega] => 0
            [observacao] => ENTREGA PARA O DIA 18/01/2023 AS 03:03 ENTR EGA PARA O DIA 18/01/2023 AS 03:03 ENTREGA PARA O DIA 18/01/2023 AS 03:03 ENTREGA PARA O DIA 18/01/2023 AS 03:03 ENTREGA PARA O DIA 18/01/2023 AS 03:03 
            [valorTotal] => 1488.50
            [contaFinal] => 1488.50
            [dataEntregaProduto] => 2023-01-18T03:03
            [produtosFinais] => [["373","ASSAD  BAURUZ  PRESU  QUEIJO2","122","109,80"],["372","ASSAD  DOGUINHO","25","22,50"],["549","ESFIHA GRANDE CALABRESA COM CATUPIRY","2","12,00"],["387","BEM CASADO-BRIG BRAN\/PRETO C\/ CEREJA","1222","1.344,20"]]
            [data] => 2023-01-08 00:38:08
            [formaPagamento] => Em aberto
        )

) -->