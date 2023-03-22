<div class='filtroSelect d-flex justify-content-between'>
    <div class="">
        <button onclick="modalCadastrar()" type="button" class="btn btn-primary cadastrar" data-toggle="modal" data-target="#cadastrar"> Cadastrar Funcionario</button>
    </div>
    <div class='filter d-flex justify-content-end'>
        <div >
            <input type='text' id='filterVendaInput' placeholder='Filtro Funcionario'>
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
        <table class=' col-md-12 tableconsultarVenda' id="consultarVenda" style="border: 1px solid blue">
            <thead class=''>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Funcionario</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Telefone</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>