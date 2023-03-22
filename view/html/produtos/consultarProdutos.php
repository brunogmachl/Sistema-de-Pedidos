<div class='container-fluid mt-1 mb-1 content' id='content'>
    <div class='filtroSelect d-flex justify-content-between'>
        <div class="">
            <button type="button" class="btn btn-primary cadastrar" onclick="modalCadastrar()">Cadastrar Produto</button>
        </div>
        <div class='filter d-flex justify-content-end'>
            <div>
                <input type='text' id='filterVendaInput' placeholder='Filtro Produto' class="form-control">
            </div>
            <div class='linhaPaginaConsulta'>
                <select class='form-select' id='linhaPaginaConsulta' name='rowsPagina'>
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
                <tbody id="vendas">
                    {{produtos}}
                </tbody>
            </table>
        </div>
    </div>
    {{inicio}}
    {{meio}}
    {{fim}}
</div>
<div class="modal fade" id="editar" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Produto<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioEditarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="obrigatorio">Produto: </label>
                            <input type="text" class="form-control form-control-editar" id="produtoEditar" name="produto" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Medida: </b></span>
                            <select class="form-select form-control-editar" id="medidaEditar" name="medida" required>
                                <option value='' selected='selected' disabled='disabled'>Selecione</option>
                                <option value="CENTO">CENTO</option>
                                <option value="UNIDADE">UNIDADE</option>
                                <option value="Kg">Kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Valor: </b></span>
                            <input class="form-control form-control-editar" id="valorEditar" name="valor" onkeyup="formatarMoeda('valorEditar')" maxlength="9" required></input>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning m-3">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cadastrar -->
<div class="modal fade" id="cadastrar" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar Produto<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioCadastrarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="obrigatorio">Produto: </label>
                            <input type="text" class="form-control form-control-cadastrar" id="produtoCadastrar" name="produto" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Medida: </b></span>
                            <select class="form-select form-control-cadastrar" id="medidaCadastrar" name="medida" required>
                                <option value='' selected='selected' disabled='disabled'>Selecione</option>
                                <option value="CENTO">CENTO</option>
                                <option value="UNIDADE">UNIDADE</option>
                                <option value="Kg">Kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Valor: </b></span>
                            <input class="form-control form-control-cadastrar" id="valorCadastrar" name="valor" onkeyup="formatarMoeda('valorCadastrar')" maxlength="8" required></input>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <img width="250px" id="target_mostrar">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning m-3">Cadastrar</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src='js/jquery.js'></script>

<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="dataTable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="dataTable/jszip.min.js"></script>
<!-- <script type="text/javascript" src="dataTable/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="dataTable/vfs_fonts.js"></script> -->
<script type="text/javascript" src="dataTable/buttons.html5.min.js"></script>
<script type="text/javascript" src="dataTable/buttons.print.min.js"></script>

<script src='js/consultar.js'></script>
