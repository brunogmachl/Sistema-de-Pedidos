<?php
namespace App\regraDeNegocio\recibos;
// require __DIR__.'/vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Exception;
use App\db\Model;



/**
 * CLASSE RESPONSAVEL POR IMPRIMIR COMPROVANTE DE COMPRA
 */
class recibos{

    
    public function miguelEspacos($produto,$numeroDeCasas){
        if(strlen($produto) < $numeroDeCasas){
            $qtdAserPrenchido = $numeroDeCasas - strlen($produto);
            $qtdEspacos = "";
            for($i=0; $i<$qtdAserPrenchido; $i++){
                $qtdEspacos .= " ";
            }
            $produtoNew = ($produto . $qtdEspacos);
            return $produtoNew;
        }else{
            return substr($produto,0,$numeroDeCasas);
        }
    }


    /**
     * METODO RESPONSAVEL POR IMPRIMIR COMPROVANTE DE COMPRA
     */
    function imprimirRecibos($id){
            $retornoId = Model::listar('vendas',"WHERE id=$id");
            $arrayDeProdutos = json_decode($retornoId[0]['produtosFinais']);
            
        try{
            $connector = new WindowsPrintConnector("TP-450"); //REDE LOCAL
            $printer = new Printer($connector);
            // $printer->setTextSize(2,2);
            $id = $retornoId[0]['id']; 
            $clienteCod = $retornoId[0]['clienteCod']; 
            $clienteNome = $retornoId[0]['clienteNome']; 
            $clienteTelefone = $retornoId[0]['clienteTelefone'];
            $statusPagamento = $retornoId[0]['statusPagamento']; 
            $funcionario = $retornoId[0]['funcionario']; 
            $desconto = $retornoId[0]['desconto'];
            $entrega = $retornoId[0]['entrega']; 
            $observacao = $retornoId[0]['observacao'];

            $valorTotal = $retornoId[0]['valorTotal'];
            $valorTotal = number_format($valorTotal, 2, ',', '.');

            $contaFinal = $retornoId[0]['contaFinal'];
            $contaFinal = number_format($contaFinal, 2, ',', '.');

            $dataEntregaProduto = $retornoId[0]['dataEntregaProduto']; 
            $dataPedido = $dataEntregaProduto;
            $dia = (str_replace(" ","T",$dataPedido));
            $diaNew = substr(date('d/m/Y H:i',  strtotime($dia)),0,10);

            $produtosFinais = $retornoId[0]['produtosFinais'];


            $printer->text("================================================\n");
            $printer->setEmphasis(true);
            $printer->text("             LENNY DOCES E SALGADOS             \n");
            $printer->setEmphasis(false);
            $printer->text("Cliente: $clienteNome \n");
            $printer->text("Vendedor: $funcionario\n");
            $printer->text("Pedido: $id\n");
            $printer->text("Data Pedido: ".$this->miguelEspacos($diaNew,19)."Entrega: $entrega\n");
            $printer->text("Valor Total: ".$this->miguelEspacos($valorTotal,19)."Desc(%): $desconto\n");
            $printer->text("Valor Final: ".$this->miguelEspacos($contaFinal,19)."Troco: 0\n");
            // $printer->text("Obs. $observacao\n");
            // $printer->text("\n");
            // $printer->text("\n");
            // // $printer->setUnderline(Printer::UNDERLINE_DOUBLE);
            // $printer->setEmphasis(true);
            // $printer->text("PRODUTOS                             Qt.  VALOR \n");
            // $printer->setEmphasis(false);
            // // $printer->setUnderline(false);
            // foreach($arrayDeProdutos as $indice){
            // $printer->text($this->miguelEspacos($indice[1],36).' '.$this->miguelEspacos($indice[2],3 ).'  '.$indice[3]."\n");
            // };
            // $printer->text("================================================\n");

                $printer->cut();
                $printer->close();
                echo "impresso com sucesso";
            }catch(Exception $e){
                echo "falha ao imprimir" . $e-> getMessage() . "\n"; 
            }

    }

}
?>
