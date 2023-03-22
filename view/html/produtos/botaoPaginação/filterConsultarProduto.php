<div class='filtroSelect d-flex justify-content-between'>
    <div class="">
        <button type="button" class="btn btn-primary cadastrar" onclick="modalCadastrar()">Cadastrar Produto</button>
    </div>
    <div class='filter d-flex justify-content-end'>
        <div>
            <input type='text' id='filterVendaInput' placeholder='Filtro Produto'>
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
<div class='filterVenda' id="filterVenda">
    <div class='buscarVenda' id="buscarVenda">
        <table class='col-md-12 consultarVenda' id="consultarVenda">
            <thead class=''>
                <tr>
                    <th scope='col' class="text-start">Id</th>
                    <th scope='col' class="text-start">Produto</th>
                    <th scope='col' class="text-center">Medida</th>
                    <th scope='col' class="text-center">Valor</th>
                    <th scope='col' class="text-center"></th>
                </tr>
            </thead>