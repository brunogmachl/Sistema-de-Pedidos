<div class='container-fluid mt-1 mb-1 content' id='content'>
    <div class='filtroSelect d-flex justify-content-between'>
        <div class="">
            <a href="index.php?metodo=cadastrarVendas"><button type="button" class="btn btn-primary cadastrar">Cadastrar Venda</button></a>
        </div>
        <div class='filter d-flex justify-content-end'>
            <div>
                <input type='text' id='filterVendaInput' placeholder='Filtro Venda' class="form-control">
            </div>
            <div>
                <select name="relatorios" class="form-select form-control-relatorio" id="tabelaVendasOpcoesSelectPagVendas" required="">
                    <!-- <option value="" disabled="disabled" selected="selected">Selecione</option> -->
                    <option value="Em aberto" selected="selected"> Em aberto </option>
                    <option value="Finalizado"> Finalizado </option>
                    <option value="Cancelado"> Cancelado </option>
                </select>
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
            <table class='col-md-12 consultarVenda' id="consultarVenda">
                <thead class=''>
                    <tr>
                        <th scope='col'>Id</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Telefone</th>
                        <th scope='col'>Total R$</th>
                        <th scope='col'>Data Entrega</th>
                        <th scope='col'>Forma Pagamento</th>
                        <th scope='col'>Status Pagamento</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody id='vendas'>
                    {{vendas}}
                </tbody>
            </table>
            <!-- vago -->
        </div>
    </div>
    {{inicio}}
    {{meio}}
    {{fim}}
</div>

<!-- Modal recibo -->
<div class="modal fade" id="recibo" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content recibo-modal">

            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <table class="recibo">
                        <div>
                            <tr>
                                <td colspan="5" style="text-align: center;"><img src="/lenny/imagem/logoLennyMenor.PNG" alt="" height="30px"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Cliente:</b></u></td>
                                <td colspan="4" style="font-weight: 500;" id="clienteNome"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Vendedor:<u><b></td>
                                <td colspan="4" style="font-weight: 500;" id="funcionario"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Pedido<u><b>:</td>
                                <td style="font-weight: 500;" id="id"></td>

                                <td colspan="2" class="titulo"><u><b>Entrega:<u><b> </td>
                                <td style="font-weight: 500;" id="entrega"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Data pedido: <u><b></td>
                                <td style="width: 170px;font-weight: 500;" id="dataEntregaProduto"></td>

                                <td colspan="2" class="titulo"><u><b>Status:<u><b> </td>
                                <td style="font-weight: 500;" id="statusPagamento"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Valor Total:<u><b></td>
                                <td style="font-weight: 500;" id="valorTotal"></td>

                                <td colspan="2" class="titulo"><u><b>Desc(%): <u><b></td>
                                <td style="font-weight: 500;" id="desconto"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Valor Final:<u><b></td>
                                <td style="font-weight: 500;" id="contaFinal"></td>

                                <td colspan="2" class="titulo"><u><b>Forma Pgto: <u><b></td>
                                <td style="font-weight: 500;" id="formaPagamento"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Obs.:</b></u></td>
                                <td colspan="4" style="font-weight: 500;" id="observacao"></td>
                            </tr>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="titulo"><u><b>Produto<u><b></td>
                                <td style="width: 40px;" class="titulo"><u><b>Qtd:<u><b></td>
                                <td class="titulo"><u><b>Valor:<u><b></td>
                            </tr>
                            <!-- aqui será inserido os produtos -->
                            <tr id="saudacoes">
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center;"><u><b>TEL(13) 3349-6202 / 99115-5746<u><b></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center;"><u><b>VOLTE SEMPRE!<u><b></td>
                            </tr>
                        </div>
                    </table>
                </div>
                <br>
                <br>
                <div class="text-center" id="pedidoImpresso">
                    pedido impresso
                </div>
                <br>
                <div class="text-center">
                    <a class="btn btn-primary btn-sm" id="impressao">IMPRIMIR</a>
                    <!-- <input type="hidden" id="impressaoId"> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div id="notaFiscal"> -->
<!-- <fim"> -->


<script src='js/jquery.js'></script>

<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="dataTable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="dataTable/jszip.min.js"></script>
<!-- <script type="text/javascript" src="dataTable/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="dataTable/vfs_fonts.js"></script> -->
<script type="text/javascript" src="dataTable/buttons.html5.min.js"></script>
<script type="text/javascript" src="dataTable/buttons.print.min.js"></script>

<script src='js/consultar.js'></script>