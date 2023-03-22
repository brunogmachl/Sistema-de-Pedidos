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
                       {{produtosFinais}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class='relatorioProdutoEscolhido'>
        {{contaPedido}}
    </div>
</div>
</div>
<script src='js/cadastrarEditarVendaComun.js'></script>