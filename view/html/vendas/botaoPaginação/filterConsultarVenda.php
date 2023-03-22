<div class='filtroSelect d-flex justify-content-between'>
    <div class="">
    <a href="index.php?metodo=cadastrarVendas"><button type="button" class="btn btn-primary cadastrar" >Cadastrar Venda</button></a>
    </div>
    <div class='filter d-flex justify-content-end'>
        <div >
            <input type='text' id='filterVendaInput' placeholder='Filtro Venda'>
        </div>
        <div class='linhaPaginaConsulta'>
            <select class='' id='linhaPaginaConsulta' name='rowsPagina'>
                <option value='10' selected="selected">10</option>
                <option value='15'>15</option>
                <option value='20'>20</option>
                <option value='25'>25</option>
                <option value='50'>50</option>
            </select>
        </div>
    </div>
</div>
<!-- id='filterVenda' -->
<div  class='filterVenda' id="filterVenda">
    <div class='buscarVenda' id="buscarVenda">
        <table class='col-md-12 consultarVenda' id="consultarVenda">
            <thead class=''>
                <tr>
                    <th scope='col'>Id</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Telefone</th>
                    <th scope='col'>Total R$</th>
                    <th scope='col'>Data Entrega</th>
                    <!-- <th scope='col'>Observação</th> -->
                    <th scope='col'>Status Pagamento</th>
                    <th scope='col'>Ações</th>
                </tr>
            </thead>