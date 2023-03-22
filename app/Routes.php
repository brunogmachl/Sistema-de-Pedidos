<?php
namespace App ;

// include('app/constantes');
use App\construct\Controller;

class Routes
{

    /**
     * CHAMA O METODO URL()
     */
    function __construct()
    {
        $this->url();
    }

    /**
     *REPOSAVEL POR DEFINIR AS ROTAS
     * @return void
     */
    function url()
    {

        
        // VERIFICANDO SE TEM ID NA URL
        $retornaTodasVariaveis = parse_url($_SERVER['REQUEST_URI']);
        if(!isset($retornaTodasVariaveis['query'])){
            echo"<script>window.location='/lenny/login.php'</script>";
            exit();
        }
            
        parse_str($retornaTodasVariaveis['query'], $apenasVariaveisUrl);
        $pag =  isset($apenasVariaveisUrl['id']) ? $apenasVariaveisUrl['id'] : '0';

        $rota['cadastrarVendas'] = array(
            'url'=> 'cadastrarVendas',
            'metodo'=>'cadastrarVendas',
            'pasta'=>'vendas',
            'parametros'=> []
        );
        //O NUMERO 10 REPRESENTA A QUANTIDADE DE LINHAS AO CARREGAR A PAGINA
        $rota['consultarVendas'] = array(
            'url'=> 'consultarVendas',
            'metodo'=> 'consultarVendas',
            'pasta'=>'vendas',
            'parametros'=> ['vendas',"WHERE statusPagamento = 'Em aberto' ORDER BY id desc",$pag,10]
        );
        $rota['editarVendas'] = array(
            'url'=> 'editarVendas',
            'metodo'=> 'editarVendas',
            'pasta'=>'vendas',
            'parametros'=> $pag
        );
        $rota['consultarClientes'] = array(
            'url'=> 'consultarClientes',
            'metodo'=> 'consultarClientes',
            'pasta'=>'clientes',
            'parametros'=> ['clientes','',$pag,10]
        );
        $rota['consultarProdutos'] = array(
            'url'=> 'consultarProdutos',
            'metodo'=> 'consultarProdutos',
            'pasta'=>'produtos',
            'parametros'=> ['produtos','',$pag,10]
        );
        $rota['consultarFuncionarios'] = array(
            'url'=> 'consultarFuncionarios',
            'metodo'=> 'consultarFuncionarios',
            'pasta'=>'funcionarios',
            'parametros'=> ['funcionarios','',$pag,10]
        );
        $rota['consultarCompras'] = array(
            'url'=> 'consultarCompras',
            'metodo'=> 'consultarCompras',
            'pasta'=>'compras',
            'parametros'=> ['Compras','ORDER BY id desc',$pag,10]
        );
        $rota['consultarAportes'] = array(
            'url'=> 'consultarAportes',
            'metodo'=> 'consultarAportes',
            'pasta'=>'aportes',
            'parametros'=> ['Aportes','ORDER BY id desc',$pag,10]
        );
        $rota['consultarRelatorios'] = array(
            'url'=> 'consultarRelatorios',
            'metodo'=> 'consultarRelatorios',
            'pasta'=>'relatorios',
            'parametros'=> []
        );
        $rota['consultarDashboards'] = array(
            'url'=> 'consultarDashboards',
            'metodo'=> 'consultarDashboards',
            'pasta'=>'dashboards',
            'parametros'=> []
        );

        Controller::direction($rota);
    }
}