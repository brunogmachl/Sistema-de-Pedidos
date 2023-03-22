<div class='container-fluid mt-1 mb-1 content' id='content'>
    <div class='filtroSelect d-flex justify-content-between'>
        <div class="">
            <button onclick="modalCadastrar()" type="button" class="btn btn-primary cadastrar" data-toggle="modal" data-target="#cadastrar"> Cadastrar Aporte</button>
        </div>
        <div class='filter d-flex justify-content-end'>
            <div>
                <input type='text' id='filterVendaInput' placeholder='Filtro Aporte' class="form-control">
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
    <!-- id='filterVenda' -->
    <div class='filterVenda' id="filterVenda">
        <div class='buscarVenda' id="buscarVenda">
            <table class=' col-md-12 tableconsultarVenda' id="consultarVenda">
                <thead class=''>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Descrição do Aporte</th>
                        <th scope="col">Data do Aporte</th>
                        <th scope="col">Valor do Aporte</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                </thead>
                <tbody id='vendas'>
                    {{aportes}}
                </tbody>
            </table>
            <!-- vago -->
        </div>
    </div>
    {{inicio}}
    {{meio}}
    {{fim}}
</div>
<!-- Modal verificar -->
<div class="modal fade" id="verificar" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalhes do Aporte<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body quebra verificar">
                <div class="row">
                    <div class="col-md-12">
                        <span><b>Descrição do Aporte: </b></span>
                        <span id="aporteVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>Data do Aporte: </b></span>
                        <span id="dataVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span><b>Valor do Aporte: </b></span>
                        <span id="valorVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <img width="250px" id="target_mostrar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal editar -->
<div class="modal fade" id="editar" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Aporte<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioEditarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="obrigatorio">Descrição do Aporte: </label>
                            <input type="text" class="form-control form-control-editar" id="aporteEditar" name="aporte" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="obrigatorio"><b>Data do Aporte: </b></span>
                            <input type='date' placeholder='dd-mm-yyyy' class="form-control form-control-editar" id="dataEditar" name="data" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="obrigatorio"><b>Valor da compra R$: </b></span>
                            <input class="form-control form-control-editar" id="valorEditar" name="valor" onkeyup="formatarMoeda('valorEditar')" maxlength="9" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img width="250px" id="target_mostrar">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning m-3">Atualizar</button>
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
                <h4 class="modal-title">Cadastrar Aporte<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioCadastrarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="obrigatorio">Descrição do Aporte: </label>
                            <input type="text" class="form-control form-control-cadastrar" id="aporteCadastrar" name="aporte" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="obrigatorio"><b>Data do Aporte: </b></span>
                            <input type='date' placeholder='dd-mm-yyyy' class="form-control form-control-cadastrar" id="dataCadastrar" name="data" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="obrigatorio"><b>Valor do Aporte R$: </b></span>
                            <input class="form-control form-control-cadastrar" id="valorCadastrar" name="valor" onkeyup="formatarMoeda('valorCadastrar')" maxlength="9" required></input>
                        </div>
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