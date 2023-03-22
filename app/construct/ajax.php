<?php
require '../../vendor/autoload.php';

use App\construct\Controller;
use App\regraDeNegocio\vendas\consultarVendas;
use App\regraDeNegocio\clientes\consultarClientes;
use App\regraDeNegocio\produtos\consultarProdutos;
use App\regraDeNegocio\compras\consultarCompras;
use App\regraDeNegocio\aportes\consultarAportes;
use App\regraDeNegocio\funcionarios\consultarFuncionarios;
use App\regraDeNegocio\relatorios\consultarRelatorios;
use App\regraDeNegocio\vendas\ajax\ajaxFiltro;
use App\regraDeNegocio\recibos\recibos;
use App\db\Model;
use App\regraDeNegocio\fiscal\fiscal;

/**
 * REALIZA OS FILTROS DE CLIENTES E PRODUTOS EM CADASTRAR VENDA E ATUALIZAR VENDA
 */
class chamadaAjax
{
    public $arrayPrincipalPost;
    public $cliente;

    /**
     * REALIZA OS FILTROS DE CLIENTES E PRODUTOS EM CADASTRAR VENDA E ATUALIZAR VENDA
     * @param array $arrayPost POST QUE VEM DO JAVASCRIPT
     */
    function ajaxFiltroConsultaCadastoVenda($arrayPost)
    {
        $ajax = (!empty($arrayPost[2])) ? '%' . $arrayPost[2] . '%' : '%' . '' . '%';
        $metodo = $arrayPost[3];
        Controller::$metodo($ajax);
    }


    /**
     * RESPONSAVEL PELO AJAX DO INPUT, SELECT E BOTOES DE PAGINACAO
     * @param array $arrayPost
     * @return void
     */
    function ajaxFiltroInputConsulta($arrayPost)
    {

        if ($arrayPost[2] == 'clientes') {
            $consultarVenda = new consultarClientes;
            $consultarVenda->consultarClientes([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        } else if ($arrayPost[2] == 'vendas') {
            $consultarVenda = new consultarVendas;
            $consultarVenda->consultarVendas([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        } else if ($arrayPost[2] == 'produtos') {
            $consultarVenda = new consultarProdutos;
            $consultarVenda->consultarProdutos([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        } else if ($arrayPost[2] == 'funcionarios') {
            $consultarVenda = new consultarFuncionarios;
            $consultarVenda->consultarFuncionarios([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        } else if ($arrayPost[2] == 'compras') {
            $consultarVenda = new consultarCompras;
            $consultarVenda->consultarCompras([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        } else if ($arrayPost[2] == 'aportes') {
            $consultarVenda = new consultarAportes;
            $consultarVenda->consultarAportes([$arrayPost[2], $arrayPost[3], $arrayPost[4], $arrayPost[5], 'ajax']);
        }
    }

    /**
     * ALTERA E CADASTRA AS VENDAS
     * @param array $arrayPost
     * @return void
     */
    function atualizarCadastrarVenda($arrayPost)
    {


        $vendaArray = json_decode(($arrayPost[2]), true);
        $metodo = $arrayPost[3];
        $retornoId = ajaxFiltro::$metodo($vendaArray);
        echo "Cadastrado com sucesso! ID = $retornoId";
    }


    /**
     * LISTA INFORMCOES DO BANCO DE DADOS
     * @param array $arrayPost
     * @return void
     */
    function listarBancoDeDados($arrayPost)
    {

        print_r(json_encode(Model::listar($arrayPost[2], $arrayPost[3])));
    }



    /**
     * FUNCAO QUE DECIDE SE IRA OU NAO REALIZAR UPDATE DE ACORDO COM O VALOR DE $itemRepetido
     * @param string $itemRpetido RETORNO DO BANCO DE DADOS LISTA
     * @param array $arrayPost ARRAY COM TODOS OS ELEMENTOS DO POST
     * @param string $cliente NOME DO CLIENTE
     * @return void
     */
    function validandoDuplicidadeListarBancoAntesDeUpdate($itemRpetido, $arrayPost, $cliente = null)
    {
        if ($itemRpetido != '[]') {
            echo "Nome|Telefone ou Produto já existe no Banco de Dados, favor Verificar";
            exit();
        } else {
            //NAO EXISTE DUPLICIDADE, AGORA O UPDATE SERÁ REALIZADO
            $resultado = (json_encode(Model::update($arrayPost[2], json_decode($arrayPost[6], true), 'id=' . $arrayPost[3], $arrayPost[4], $arrayPost[5])));
            return $resultado;
        }
    }


    /**
     * BUSCARA CONTEUDO HTML PARA SER RENDERIZADO APÓS SER ATUALIZADO
     * @param boolean $resultado
     * @return void
     */
    function buscandoConteudoHtmlPosUpdate($resultado)
    {
        $arrayPost = $this->arrayPrincipalPost;
        if ($resultado == true && $arrayPost[2] != 'vendas') {
            $nomeDaClasse = "App\\regraDeNegocio\\" . $arrayPost[2] . '\consultar' . ucfirst($arrayPost[2]);
            $nomeDoMethodo = 'consultar' . ucfirst($arrayPost[2]);
            //INSTACIA PARA ATUALIZAR A PAGINA COM OS DADOS ATUALIZADOS VIA AJAX
            $atualizacaoPagina  = new $nomeDaClasse;
            $atualizacaoPagina->$nomeDoMethodo([$arrayPost[2], '', Model::$inicio, Model::$limit, 'ajax', 'update']);
            //VERIFICANDO SE A TABELA ALTERADA É DE CLIENTES, CASO SIM SERÁ NECESSARIO ALTERAR VENDAS CASO EXISTA.
        } else {
            echo "Falha ao Atualizar, repita operação!";
        }
    }

    /**
     * CASO A PAGINA DE CLIENTES SEJA ALTERADA (NOME CLIENTE) SERA VALIDADO SE EXISTE VENDA, SE SIM SERA RENOMEADO TAMBEM
     * @return void
     */
    function updateVendas()
    {
        if ($this->arrayPrincipalPost[2] == 'clientes') {
            $arrayAlterarTableFuncinario = [];
            $arrayAlterarTableFuncinario['clienteNome'] = $this->cliente;
            Model::update('vendas', $arrayAlterarTableFuncinario, 'clienteCod=' . $this->arrayPrincipalPost[3]);
        }
    }

    /**
     * ATUALIZA LINHA DO BANCO DE DADOS, RECEBE ID COMO REFERENCIA
     * @param array $arrayPost
     * @return void
     */
    function EditarBancoDeDados($arrayPost)
    {
        $this->arrayPrincipalPost = $arrayPost;
        $dados = (json_decode($arrayPost[6], true));
        if ($arrayPost[2] == 'clientes') {
            $this->cliente = $dados['cliente'];
            $cliente = $dados['cliente'];
            $query = "WHERE (cliente = '$cliente') and id != '$arrayPost[3]' ";
            //VERIFICANDO SE OS NOVOS VALORES DE CLIENTES|PRODUTOS|FUNCIONARIOS JÁ EXISTEM NO BANCO DE DADOS
            $itemRpetido = (json_encode(Model::listar($arrayPost[2], $query)));
            $resultado = $this->validandoDuplicidadeListarBancoAntesDeUpdate($itemRpetido, $arrayPost, $cliente);
            $this->buscandoConteudoHtmlPosUpdate($resultado);
            $this->updateVendas();
        } else if ($arrayPost[2] == 'funcionarios') {
            $funcionario = $dados['funcionario'];
            $query = "WHERE (funcionario = '$funcionario') and id != '$arrayPost[3]'";
            //VERIFICANDO SE OS NOVOS VALORES DE CLIENTES|PRODUTOS|FUNCIONARIOS JÁ EXISTEM NO BANCO DE DADOS
            $itemRpetido = (json_encode(Model::listar($arrayPost[2], $query)));
            $resultado = $this->validandoDuplicidadeListarBancoAntesDeUpdate($itemRpetido, $arrayPost);
            $this->buscandoConteudoHtmlPosUpdate($resultado);
        } else if ($arrayPost[2] == 'produtos') {
            $produto = $dados['produto'];
            $query = "WHERE (produto = '$produto') and id != '$arrayPost[3]'";
            //VERIFICANDO SE OS NOVOS VALORES DE CLIENTES|PRODUTOS|FUNCIONARIOS JÁ EXISTEM NO BANCO DE DADOS
            $itemRpetido = (json_encode(Model::listar($arrayPost[2], $query)));
            $resultado = $this->validandoDuplicidadeListarBancoAntesDeUpdate($itemRpetido, $arrayPost);
            $this->buscandoConteudoHtmlPosUpdate($resultado);
        } else if ($arrayPost[2] == 'compras' || $arrayPost[2] == 'aportes') {
            $resultado = (json_encode(Model::update($arrayPost[2], json_decode($arrayPost[6], true), 'id=' . $arrayPost[3], $arrayPost[4], $arrayPost[5])));
            $this->buscandoConteudoHtmlPosUpdate($resultado);
        }
    }


    /**
     * DELETA DO BANCO DE DADOS, NECESSARIO ENVIAR O ID
     * @param array $arrayPost 
     * @return void
     */
    function deletarBancoDeDados($arrayPost)
    {

        print_r(json_encode(Model::delete($arrayPost[2], $arrayPost[3])));
    //    (json_encode(Model::delete($arrayPost[2], $arrayPost[3])));
        if($arrayPost[2] == 'compras'){
            $id = $arrayPost[3];
            $where = "WHERE id = $id";
            $validandoExistencia = Model::listar('parcelasCartao', $where);
            if(count($validandoExistencia) > 1){
                Model::delete('parcelasCartao', $id);
            }
        }
    }



    function validandoDuplicidadeAntesDoCadastrar($arrayPost, $query)
    {
        $itemRpetido = (json_encode(Model::listar($arrayPost[2], $query)));
        if ($itemRpetido != '[]') {
            echo "Nome|Telefone ou Produto já existe no Banco de Dados, favor Verificar";
            exit();
        } else {
            $retornoId = (json_encode(Model::inserir($arrayPost[2], json_decode($arrayPost[6], true))));
            return str_replace('"', '', $retornoId);
        }
    }

    /**
     * CADASTRO BANCO DE DADOS
     * @param array $arrayPost 
     * @return void
     */
    function cadastrarBancoDeDados($arrayPost)
    {

        $dados = (json_decode($arrayPost[6], true));
        if ($arrayPost[2] == 'clientes') {
            $cliente = $dados['cliente'];
            $telefone = $dados['telefone'];
            $query = "WHERE cliente = '$cliente' or telefone = '$telefone'";
            $retornoId = $this->validandoDuplicidadeAntesDoCadastrar($arrayPost, $query);
            echo "Cadastrado com sucesso! ID = $retornoId";
            exit();
        } else if ($arrayPost[2] == 'funcionarios') {
            $funcionario = $dados['funcionario'];
            $telefone = $dados['telefone'];
            $query = "WHERE funcionario = '$funcionario' or telefone = '$telefone'";
            $retornoId = $this->validandoDuplicidadeAntesDoCadastrar($arrayPost, $query);
            echo "Cadastrado com sucesso! ID = $retornoId";
        } else if ($arrayPost[2] == 'produtos') {
            $produto = $dados['produto'];
            $query = "WHERE produto = '$produto'";
            $retornoId = $this->validandoDuplicidadeAntesDoCadastrar($arrayPost, $query);
            echo "Cadastrado com sucesso! ID = $retornoId ";
        } else if ($arrayPost[2] == 'compras' || $arrayPost[2] == 'aportes') {

            $retornoId = (Model::inserir($arrayPost[2], json_decode($arrayPost[6], true)));
            if (@$dados['formaCompra'] == "creditoParcelado") {
                $novoArray = array($dados);

                $date = new DateTime($novoArray[0]['dataPrimeiraParcela']);
                for ($i = 0; $i < $novoArray[0]['parcelaCompra']; $i++) {

                    $arrayCreditoFinal = [];
                    foreach ($novoArray as $resultado) {
                        //INSERINDO O ID DA OUTRA TABELA COMO REFERENCIA
                        $arrayCreditoFinal['id'] = $retornoId;

                        //DESCRIÇÃO DA COMPRA
                        $descricao = $resultado['compra'] . ' ' . ($i + 1) . '/' . $resultado['parcelaCompra'];
                        // $descricao = $resultado['compra'] . ' ' . $resultado['parcelaCompra'] . '/' . ($i + 1);
                        $arrayCreditoFinal['compra'] = $descricao;

                        //DIA QUE FOI COMPRADO
                        $data = $resultado['data'];
                        $arrayCreditoFinal['data'] = $data;

                        //FORMA DA COMPRA - CREDITO PARCELADO
                        $formaCompra = $resultado['formaCompra'];
                        $arrayCreditoFinal['formaCompra'] = $formaCompra . 'Det';


                        if ($resultado['dataPrimeiraParcela']) {
                            if($i != 0){
                                $date = ($date->add(new DateInterval('P1M')));
                                $dateNew = (array)$date;
                            }else{
                                $dateNew = (array)$date;
                            }
                            $dateNew =  str_replace(' ', 'T', (substr($dateNew['date'], 0, 10)));
                            $arrayCreditoFinal['dataPrimeiraParcela'] = $dateNew;
                        }

                        $valor = number_format($resultado['valor'] / $resultado['parcelaCompra'], 2);
                        $arrayCreditoFinal['valorFinal'] = $valor;
                    }
                    //AQUI ENTRA O BANCO DE DADOS, INSERINDO CADA PARCELA
                    Model::inserir('parcelasCartao', $arrayCreditoFinal);
                }
                echo "Cadastrado com sucesso! ID = $retornoId";
                exit();
            } else {
                echo "Cadastrado com sucesso! ID = $retornoId";
            }
        }
    }

    /**
     * METODO RESPONSAVEL POR INSTANCIAR A CLASSE RESPONSAVEL PELA CRIACAO DOS FORMULARIOS
     * @param array $arrayPost
     * @return void
     */
    function relatorios($arrayPost)
    {

        // echo '<pre>';
        // print_r($arrayPost);
        // echo '</pre>';
        // exit();

        $extraindoData = json_decode($arrayPost[6], true);
        @$data_inicio_da_manobra = str_replace("T", " ", $extraindoData['dataInicio']);
        @$data_fim_da_manobra = str_replace("T", " ", $extraindoData['dataFim']);

        $datainicio = new DateTime("$data_inicio_da_manobra");
        $inicio = $datainicio->format("U");

        $datafim = new DateTime("$data_fim_da_manobra");
        $fim = $datafim->format("U");

        if ($inicio > $fim) {
            echo 'Data Inicio maior que data Fim!';
            exit();
        }

        $classe =  'App\regraDeNegocio\relatorios\\consultarRelatorios';
        $objetoRelatorio = new $classe;
        if ($arrayPost[2] == 'consolidado' || $arrayPost[2] == 'dashboards') {
            $metodoFormulario = 'consolidado';
        } else {

            $metodoFormulario = 'consultarRelatorios';
        }
        $objetoRelatorio->$metodoFormulario($arrayPost);
    }

    /**
     * IMPRIME O RECIBO
     * @param array $arrayPost
     * @return void
     */
    function imprimirRecibos($arrayPost)
    {
        $objetoImprimir = new recibos;
        $objetoImprimir->imprimirRecibos($arrayPost[2]);
    }


    function imprimirNotaFiscal($arrayPost)
    {
        $objetoNotaFiscal = new fiscal;
        $objetoNotaFiscal->fiscal($arrayPost);
    }
}



$arrayPost = array_values($_POST);

$classe = $arrayPost[0];
$methodo = $arrayPost[1];

$objeto = new $classe;
$objeto->$methodo($arrayPost);

// echo '<pre>';
// print_r($arrayPost);
// echo '</pre>';
// exit();
