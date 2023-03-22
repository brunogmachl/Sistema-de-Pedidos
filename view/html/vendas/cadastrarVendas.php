<div class='container-fluid mt-1 mb-1 content'>
    <div class='buscarProduto'>
        <div class='filter'>
            <input type='text' id='filterCliente' placeholder='Filtro Cliente'>
        </div>
        <div class='buscaCliente'>
            <table class='table table-sm table-hover'>
                <thead class=''>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>id</th>
                        <th scope='col'>cliente</th>
                        <th scope='col'>endereco</th>
                        <th scope='col'>bairro</th>
                        <th scope='col'>cidade</th>
                        <th scope='col'>estado</th>
                        <th scope='col'>cep</th>
                        <th scope='col'>telefone</th>
                        <th scope='col'>email</th>
                        <th scope='col'>obs</th>
                    </tr>
                </thead>
                <tbody id='clientes'>
                    {{clientes}}
                </tbody>
            </table>
        </div>
    </div>
    <div class='buscarProduto'>
        <div class='filter'>
            <input type='text' id='filterProduto' placeholder='Filtro Produto'>
        </div>
        <div class='escolhaProduto'>
            <div class='buscaProduto'>
                <table class='table table-sm table-hover'>
                    <thead class=''>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>produto</th>
                            <th scope='col'>valor</th>
                        </tr>
                    </thead>
                    <tbody id='produtos'>
                        {{produtos}}
                    </tbody>
                </table>
            </div>
            <div class='addRemove'>
                <div class='caixa'>
                    <div class='row'>
                        <input type='text' name='quantidadeProduto' id='quantidadeProduto' class='' style='text-align: center; display: inline-block;'>
                    </div>
                    <div class='row'>
                        <button type='button' class='btn btn-success' id='adicionar'>ADICIONAR</button>
                    </div>
                    <div class='row'>
                        <button type='button' class='btn btn-danger' id='remover'>REMOVER</button>
                    </div>
                </div>
            </div>
            <div class='produtoFinal'>
                <table class='table table-sm table-hover'>
                    <thead class=''>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>cod</th>
                            <th scope='col'>produto</th>
                            <th scope='col'>quantidade</th>
                            <th scope='col'>preço</th>
                        </tr>
                    </thead>
                    <tbody id='inserirProdutoFinal'>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class='relatorioProdutoEscolhido'>
        <div class='primeiraLinha'>
            <div class=''>
                <label>Total R$</label>
                <input type='text' class='inputAutomatico' id='valorTotal' readonly>
            </div>
            <div class=''>
                <label>Desconto %<input type='text' class='inputManual' id='desconto'>
            </div>
            <div class=''>
                <label>Entrega R$</label>
                <input type='text' class='inputManual' id='entrega'>
            </div>
            <div class=''>
                <label>Final</label>
                <input type='text' id='contaFinal' class='inputAutomatico' readonly>
            </div>
        </div>
        <div class='segundaLinha'>
            <div class=''>
                <span>Status:</span>
                <select class='statusPagamento' id='statusPagamento' name='' required>
                    <option value='' selected='selected' disabled='disabled'>Selecione</option>
                    <option value='Em aberto'>Em aberto</option>
                    <option value='Finalizado'>Finalizado</option>
                </select>
            </div>
            <div class=''>
                <span>Forma:</span>
                <select class='formaPagamento' id='formaPagamento' name='' required>
                    <option value='' selected='selected' disabled='disabled'>Selecione</option>
                    <option value='Em aberto'>Em aberto</option>
                    <option value='Debito'>Débito</option>
                    <option value='Credito'>Crédito</option>
                    <option value='Pix'>Pix</option>
                    <option value='Dinheiro'>Dinheiro</option>
                </select>
            </div>
            <div class=''>
                <span>Funcionario:</span>
                <select class='' id='funcionarioEscolhido' name='funcionarioEscolhido' required>
                    <option value='' disabled='disabled' selected='selected'>Selecione</option>
                    <option value='Gil' name=funcionario>Gil</option>
                    <option value='Lenny' name=funcionario>Lenny</option>
                    <option value='Bruno' name=funcionario>Bruno</option>
                </select>
            </div>
            <div class=''>
                <label>Data da Venda</label>
                <input type='text' id='dataDaVenda' class='inputAutomatico' readonly>
            </div>
            <div class=''>
                <label>Data da Entrega</label>
                <input type='datetime-local' class='inputAutomatico' placeholder='dd-mm-yyyy' placeholder='' id='dataEntrega' required>
            </div>
        </div>
        <div class='terceiraLinha'>
            <div class='campoObservacao'>
                <div class='observacao'>
                    <textarea class='observacaoTextArea' id='observacaoTextArea' rows='1' placeholder='Observação...'></textarea>
                </div>
            </div>
            <div class='BotaoCadastrar'>
                <div class='cadastrar'>
                    <button class='btn btn-primary' type='submit' id='cadastrar' >Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src='js/cadastrarVenda.js'></script>
<script src='js/cadastrarEditarVendaComun.js'></script>