<div class="content container-fluid">
    <div class="row mt-3 justify-content-between">
        <div class='col-md-2'>
            <span>Tabela:</span>
            <select id="tabelaRelatorios" name="relatorios" class="form-select form-control-relatorio" required="">
                <option value="" disabled="disabled" selected="selected">Selecione</option>
                <option value="vendas"> Vendas </option>
                <option value="compras"> Compras </option>
                <option value="aportes"> Aportes </option>
                <option value="consolidado"> Consolidado </option>
            </select>
        </div>
        <div class='col-md-2' id="tabelaVendasOpcoes">
            <span>Opções de vendas:</span>
            <select name="relatorios" class="form-select form-control-relatorio" id="tabelaVendasOpcoesSelect" required="">
                <option value="" disabled="disabled" selected="selected">Selecione</option>
                <option value="em aberto"> Em aberto </option>
                <option value="cancelado"> Cancelado </option>
                <option value="finalizado"> Finalizado </option>
                <optgroup label="Finalizado Opções">
                    <option value="debito"> Debito </option>
                    <option value="credito"> Credito </option>
                    <option value="pix"> Pix </option>
                    <option value="dinheiro"> Dinheiro </option>
                </optgroup>
                <!-- <option value="todos">Todos</option> -->
            </select>
        </div>
        <div class='col-md-2' id="tabelaComprasOpcoes">
            <span>Opções de Compras:</span>
            <select name="relatorios" class="form-select form-control-relatorio" id="tabelaComprasOpcoesSelect" required="">
                <option value="" disabled="disabled" selected="selected">Selecione</option>
                    <option value="debitoCompras"> Debito </option>
                    <option value="creditoVista"> Credito a vista </option>
                    <option value="creditoParcelado"> Credito parcelado resumo</option>
                    <option value="creditoParceladoDet"> Credito parcelado detalhado</option>
                    <option value="pixCompras"> Pix </option>
                    <option value="dinheiroCompras"> Dinheiro </option>

            </select>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Data Inicio</label>
                <input type="date" class="form-control" placeholder="dd-mm-yyyy" id="dataInicioFormulario" name="dataInicioFormulario" placeholder="">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Data Fim</label>
                <input type="date" class="form-control" placeholder="dd-mm-yyyy" id="dataFimFormulario" name="dataFimFormulario" placeholder="">
            </div>
        </div>
        <div class='linhaPaginaConsulta col-md-1'>
            <label for="exampleInputEmail1">Linhas</label>
            <select class='form-select' id='linhaPaginaConsulta' name='rowsPagina'>
                <option value='10' selected="selected">10</option>
                <option value='15'>15</option>
                <option value='20'>20</option>
                <option value='25'>25</option>
                <option value='50'>50</option>
            </select>
        </div>
        <div class="col-md-2" style="text-align:right">
            <div class=" mt-4">
                <button type="submit" class="btn  btn-primary btn-md botaochamado" id="botaoEnviarDadosRelataorio" style="border: 1px solid red;text-align:center">SOLICITAR</button>
            </div>
        </div>
    </div>


    <div id="scrollRelatorios">
        <div class="mt-2" id="relatorio"></div>
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