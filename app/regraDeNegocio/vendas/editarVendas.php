<?php

namespace App\regraDeNegocio\vendas;
use App\codigosProntos\CriarTabela\CriarTabela;

use App\db\Model;


 class editarVendas{
    public $pagina;
    public $id;
    public $produtosFinais;
    public $valoresFinal;
    //INSERIDO APOS ERRO ENCONTRADO HOJE DIA 06/11/2023
    public $idVenda;
    public $idCliente;

    /**
     * RECEBE O PARAMETRO ID QUE FOI ENVIADO VIA HTTP GET
     * @param integer $parametroId
     * @return void
     */
    function editarVendas($parametroId)
    {
        $this->id = "WHERE id='$parametroId'";
        $this->idVenda = "$parametroId";
        $this->editarClientes();
        $this->listarProdutosFinais();
        $this->listarvaloresFinais();
        $this->listarProdutosEditar();
    }

    /**
     *FUNÇÃO RESPONSAVEL POR CARREGAR TODAS AS INFORMCOES DA VENDA, INCLUIDO O FILTRO DO CLIENTE DE ACORDO COM O ID.
     * @return string
     */
    private function editarClientes(){
        $rowVenda = Model::listar('vendas',$this->id,'');
        $this->valoresFinal = $rowVenda;
        $this->produtosFinais = json_decode($rowVenda[0]['produtosFinais']);
        
        //COLETANDO ID DO CLIENTE PRA INSERIR O NOME DO CLIENTE NA TABELA
        $this->idCliente = 'WHERE ID='. $rowVenda[0]['clienteCod'];
        $editarVenda = file_get_contents('C:\xampp\htdocs\lenny\view\html\vendas\editarVendas.php');
        $caminhoArquivoHtml  = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\clientes.php';
        $tabelaVendaClientes = CriarTabela::CriarTabela('clientes',$this->idCliente , '', '', $caminhoArquivoHtml );
        //VERIFICANDO SE O DONO DA ENCOMENDA EXISTE NO BANCO DE DADOS DE CLIENTES(PODE TER SIDO REMOVIDO POR ACIDENTE)
        $tabelaVendaClientes = $tabelaVendaClientes == '' ? "<td>Cliente Deletado, Necessário inseri-lo novamente e recadastra-lo nessa venda ID = $this->idVenda </td>" : $tabelaVendaClientes;
        $this->pagina = str_replace('{{clientes}}', $tabelaVendaClientes,$editarVenda);

    }


    /**
     * LISTA OS PRODUTOS DA VENDA QUE SERA EDITADA SENDO INCLUIDA NA PAGINA
     * @return void
     */
    private function listarProdutosFinais(){
        
        $itemFinal = "";
        foreach($this->produtosFinais as $produto){
                $item = file_get_contents('C:\xampp\htdocs\lenny\view\html\vendas\templates\editarVendas\editarVendas.php');
                $item = str_replace('{{codProdutos}}',$produto[0],$item);
                $item = str_replace('{{nomeProduto}}',$produto[1],$item);
                $item = str_replace('{{quantidade}}',$produto[2],$item);
                $item = str_replace('{{preco}}',$produto[3],$item);

                $itemFinal .=  $item;
                }
                
                $this->pagina = str_replace('{{produtosFinais}}', $itemFinal,$this->pagina);
    }

    /**
     * LISTANDO VALORES FINAIS
     *
     * @return void
     */
    private function listarvaloresFinais(){
        $desconto = $this->valoresFinal[0]['desconto'];
        $entrega = $this->valoresFinal[0]['entrega'];
        $observacao = $this->valoresFinal[0]['observacao'];
        $dataEntregaProduto = $this->valoresFinal[0]['dataEntregaProduto'];
        $statusPagamento = $this->valoresFinal[0]['statusPagamento'];
        $formaPagamento = $this->valoresFinal[0]['formaPagamento'];
        $funcionario = $this->valoresFinal[0]['funcionario'];

        $dataPedido = $this->valoresFinal[0]['data'];
		$dia = (str_replace(" ","T",$dataPedido));
		$diaNew = date('d/m/Y H:i',  strtotime($dia));

        $valorTotal = number_format($this->valoresFinal[0]['valorTotal'], 2, ',', '.');
        //PASSANDO PARA MOEDA - REAL
        $contaFinal = number_format($this->valoresFinal[0]['contaFinal'], 2, ',', '.');
        

        $item = file_get_contents('C:\xampp\htdocs\lenny\view\html\vendas\templates\editarVendas\contafinal.php');
        $item = str_replace("{{total}}",$valorTotal, $item);
        $item = str_replace('{{desconto}}',$desconto, $item);
        $item = str_replace('{{entrega}}',$entrega, $item);
        $item = str_replace('{{final}}',$contaFinal, $item);
        $item = str_replace('{{observacao}}',$observacao, $item);
        $item = str_replace('{{dataDaVenda}}',$diaNew, $item);
        $item = str_replace('{{dataDaEntrega}}',$dataEntregaProduto, $item);
        $item = str_replace('{{statusPagamento}}',$statusPagamento, $item);
        $item = str_replace('{{formaPagamento}}',$formaPagamento, $item);
        $item = str_replace('{{funcionario}}',$funcionario, $item);

        $this->pagina = str_replace('{{contaPedido}}', $item ,$this->pagina);
    }

    /**
     * METHODO RESPONSAVEL POR CARREGAR OS PRODUTOS NA PAGINA DE CADASTRO
     * @return string
     */
    private function listarProdutosEditar(){
        $caminhoArquivoHtml  = 'C:\xampp\htdocs\lenny\view\html\vendas\templates\cadastrarVendas\produtos.php';
        $tabelaVendaClientes = CriarTabela::CriarTabela('produtos', '', '', '', $caminhoArquivoHtml );
        $this->pagina = str_replace('{{produtos}}', $tabelaVendaClientes,$this->pagina);
        echo $this->pagina;

    }
}
