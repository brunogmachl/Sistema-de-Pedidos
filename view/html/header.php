<?php require_once("verificar.php");  ?>
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='utf-8'>
    <title>Lenny - Doces & Salgados</title>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta content='' name='keywords'>
    <meta content='' name='description'>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css' rel='stylesheet'>
    <!-- <link href='css/all.min.css' rel='stylesheet'> -->

    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link href='css/style.css' rel='stylesheet'>
    <script src='googleCharts/pizza.js'></script>
    
    <!-- datatable -->
    <!-- <link href='dataTable/buttons.dataTables.min.css' rel='stylesheet'> -->
    <!-- <link href='dataTable/dataTables.min.css' rel='stylesheet'> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">  
 -->

<!-- <style>
    #circulo {width: 60px;
    height: 49px;
    border-radius: 50%;
    background-color:darksalmon;
    margin: 50px;
    font-size: 38px;
    text-align: center;
    
    }
    .name{
        margin-left: 0px;
    }
</style> -->


</head>

<body>
    <div class='pai border' id="pai">
        <div class='container-fluid  p-0 header mt-1' id="primeiroFilhoPai">
            <div id='spinner' class='show  position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center'>
                <div class='spinner-border text-primary' style='width: 3rem; height: 3rem;' role='status'>
                    <span class='sr-only'>Loading...</span>
                </div>
            </div>
            <nav class='navbar navbar-expand-lg navbar-light sticky-top px-4 px-lg-5 py-lg-0 style="background-color: blue;"'>
                <a href='index.html' class='navbar-brand'>
                    <div class="name">
                        <h1 class='m-0 text-primary' id="circulo"></i></h1>
                    </div>
                </a>
                <button type='button' class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbarCollapse'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div>
                    </div>
                <div class='collapse navbar-collapse' id='navbarCollapse' >
                    <div class='navbar-nav mx-auto botao'>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Clientes</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarClientes' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Produtos</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarProdutos' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Funcionarios</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarFuncionarios' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Vendas</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarVendas' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <img src="/lenny/imagem/logoLennyMenor.png" alt="" width="140px" class="ms-1">
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Compras</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarCompras' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Aporte</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarAportes' class='dropdown-item'>Consultar</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='#' class='nav-link dropdown-toggle btn' data-bs-toggle='dropdown'>Relatorio</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                                <a href='index.php?metodo=consultarRelatorios' class='dropdown-item'>Relatorio</a>
                                <a href='index.php?metodo=consultarDashboards' class='dropdown-item'>Dashboard</a>
                            </div>
                        </div>
                        <div class='nav-item dropdown'>
                            <a href='/lenny/logout.php' class='nav-link  btn'>Encerrar</a>
                            <div class='dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0'>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>