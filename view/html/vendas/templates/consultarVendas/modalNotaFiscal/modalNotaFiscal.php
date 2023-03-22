<div class="modal fade" id="notaFiscal" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content recibo-modal">
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div>
                        <table class="fiscal">
                            <tr>
                                <td colspan="5" style="text-align: center;"><img src="lenny/imagem/logoLennyMenor.PNG" alt="" height="30px"></td>
                            </tr>
                            <tr>
                                <td class="titulo cabecalho" colspan="5"><u><b>LENNY DOCES E SALGADOS</b></u></td>
                            </tr>
                            <tr>
                                <td class="titulo cabecalho" colspan="5"><u><b>TEL: 99115-5746 / 3349-6202 | CNPJ: 369754340001-54</b></u></td>
                            </tr>
                            <tr>
                                <td class="titulo cabecalho" colspan="5"><u><b>Rua Dr Carvelho de Mendonça 755</b></u></td>
                            </tr>
                            <tr>
                                <td class="titulo cabecalho" colspan="5"><u><b>Próximo ao Morro, Marapé-Santos-SP</b></u></td>
                            </tr>
                            <tr>
                                <td class="titulo cabecalho" colspan="5"><u><b>CUPOM FISCAL ELETRONICO SAT</b></u></td>
                            </tr>
                            <tr>
                                <!-- <td class="titulo" style="width: 82px"><u><b>Cliente:<u><b></td> -->
                                <td colspan="5" style="text-align: center;">=======================================================</td>
                            </tr>
                            <tr>
                                <td class="titulo" style="width: 82px"><u><b>Cliente:<u><b></td>
                                <td colspan="4" style="font-weight: 500;" id="funcionario">{{cliente}}</td>
                            </tr>
                            <tr>
                                <td class="titulo" id="tipoPessoa"><u><b><u><b></td>
                                <td colspan="4" style="font-weight: 500;" id="numeroPessoa"></td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Pedido<u><b>:</td>
                                <td style="font-weight: 500;width:222px" id="id">{{pedido}}</td>

                                <td colspan="2" class="titulo"><u><b>Entrega:<u><b> </td>
                                <td style="font-weight: 500;" id="entrega">{{entrega}}</td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Data pedido: <u><b></td>
                                <td style="font-weight: 500;" id="dataEntregaProduto">{{dataPedido}}</td>

                                <td colspan="2" class="titulo"><u><b>Troco:<u><b> </td>
                                <td style="font-weight: 500;" id="statusPagamento">0</td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Valor Total:<u><b></td>
                                <td style="font-weight: 500;" id="valorTotal">{{valorTotal}}</td>

                                <td colspan="2" class="titulo"><u><b>Desc(%): <u><b></td>
                                <td style="font-weight: 500;" id="desconto">{{desconto}}</td>
                            </tr>
                            <tr>
                                <td class="titulo"><u><b>Valor Final:<u><b></td>
                                <td style="font-weight: 500;" id="contaFinal">{{valorFinal}}</td>

                                <td colspan="2" class="titulo" style="width: 10px;"><u><b>Pgto: <u><b></td>
                                <td style="font-weight: 500;" id="formaPagamento">{{pagamento}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="width: 440px;">&nbsp;</td>
                                <!-- <td colspan="5" >&nbsp;</td> -->
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <table class="fiscal">
                        <tr>
                            <td class="titulo" style="width: 300px;"><u><b>Produto<u><b></td>
                            <td class="titulo" style="width: 50px; text-align: center"><u><b>Un<u><b></td>
                            <td class="titulo" style="width: 30px; text-align: center"><u><b>Qt<u><b></td>
                            <td class="titulo" style="width: 60px; text-align: center"><u><b>Total<u><b></td>
                        </tr>
                        <!-- aqui será inserido os produtos -->
                        {{produtos}}
                        <!-- aqui será inserido os produtos -->
                        <tr id="saudacoes">
                            <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">======================================================</td>
                        </tr>
                    </table>
                </div>
                <br>
                <br>
                <div class="text-center" id="pedidoImpresso">
                    pedido impresso
                </div>
                <br>
                <div class="row">
                    <div class='col-md-3'>
                        <select class='form-select' id='selecinandoTipoPessoa' name='rowsPagina'>
                            <option value='' selected="selected" disabled='disabled'>SELE.</option>
                            <option value='CPF'>CPF</option>
                            <option value='CNPJ'>CNPJ</option>
                        </select>
                    </div>
                    <div class="text-center col-md-6">
                        <input type='text' id='inserirNumeroPessoa' placeholder='Filtro Cliente' class="form-control">
                    </div>
                    <div class="text-center col-md-2">
                        <a class="btn btn-primary btn-md" id="impressao">IMPRIMIR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>