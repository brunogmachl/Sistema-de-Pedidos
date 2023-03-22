<div class='container-fluid mt-1 mb-1 content' id='content'>
    <div class='filtroSelect d-flex justify-content-between'>
        <div class="">
            <button onclick="modalCadastrar()" type="button" class="btn btn-primary cadastrar" data-toggle="modal" data-target="#cadastrar"> Cadastrar Funcionario</button>
        </div>
        <div class='filter d-flex justify-content-end'>
            <div>
                <input type='text' id='filterVendaInput' placeholder='Filtro Funcionario' class="form-control">
            </div>
            <div class='linhaPaginaConsulta'>
                <select class="form-select" id='linhaPaginaConsulta' name='rowsPagina'>
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
                        <th scope="col">Funcionario</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Telefone</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                </thead>
                <tbody id='vendas'>
                    {{funcionarios}}
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
                <h4 class="modal-title">Detalhes do Funcionario<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body quebra verificar">
                <div class="row">
                    <div class="col-md-12">
                        <span><b>Funcionario: </b></span>
                        <span id="funcionarioVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>Endereço: </b></span>
                        <span id="enderecoVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span><b>Bairro: </b></span>
                        <span id="bairroVerificar"></span>
                    </div>
                    <div class="col-md-4">
                        <span><b>Cidade: </b></span>
                        <span id="cidadeVerificar"></span>
                    </div>
                    <div class="col-md-2">
                        <span><b>Estado: </b></span>
                        <span id="estadoVerificar"></span>
                    </div>
                    <div class="col-md-2">
                        <span><b>Cep: </b></span>
                        <span id="cepVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>Telefone: </b></span>
                        <span id="telefoneVerificar"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Email: </b></span>
                        <span id="emailVerificar"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span><b>Perfil: </b></span>
                        <span id="perfilVerificar"></span>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-md-6">
                        <span><b>Observação: </b></span>
                        <span id="obsVerificar"></span>
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
                <h4 class="modal-title">Editar Funcionario<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioEditarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="obrigatorio">Funcionario: </label>
                            <input type="text" class="form-control form-control-editar" id="funcionarioEditar" name="funcionario" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="obrigatorio"><b>Endereço: </b></span>
                            <input class="form-control form-control-editar" id="enderecoEditar" name="endereco" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="obrigatorio"><b>Bairro: </b></span>
                            <input class="form-control form-control-editar" id="bairroEditar" name="bairro" required></input>
                        </div>
                        <div class="col-md-4">
                            <span class="obrigatorio"><b>Cidade: </b></span>
                            <input class="form-control form-control-editar" id="cidadeEditar" name="cidade" required></input>
                        </div>
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Estado: </b></span>
                            <!-- <input class="form-select form-control-editar" id="estadoEditar" name="estado"></input> -->
                            <select id="estadoEditar" name="estado" class="form-select form-control-editar" required>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                <option value="EX">Estrangeiro</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Cep: </b></span>
                            <input class="form-control form-control-editar" id="cepEditar" name="cep" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Telefone: </b></span>
                            <input type="tel" maxlength="15" class="form-control form-control-editar" id="telefoneEditar" name="telefone" required></input>
                        </div>
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Email: </b></span>
                            <input class="form-control form-control-editar" id="emailEditar" name="email" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Perfil: </b></span>
                            <select id="perfilEditar" class="form-select form-control-editar" name="perfil" required>
                                <option value='' disabled='disabled' selected='selected'>Selecione</option>
                                <option value="administrador">Administrador</option>
                                <option value="funcionario">Funcionario</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Senha: </b></span>
                            <input type="password" class="form-control form-control-editar" id="senhaEditar" name="senha" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span><b>Observação: </b></span>
                            <input class="form-control form-control-editar" id="obsEditar" name="obs"></input>
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
                <h4 class="modal-title">Cadastrar Funcionario<span id="nome_dados"></span></h4>
                <button id="btn-fechar-perfil" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formularioCadastrarVenda" method="POST">
                <div class="modal-body quebra">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="obrigatorio">Funcionario: </label>
                            <input type="text" class="form-control form-control-cadastrar" id="funcionarioCadastrar" name="funcionario" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="obrigatorio"><b>Endereço: </b></span>
                            <input class="form-control form-control-cadastrar" id="enderecoCadastrar" name="endereco" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="obrigatorio"><b>Bairro: </b></span>
                            <input class="form-control form-control-cadastrar" id="bairroCadastrar" name="bairro" required></input>
                        </div>
                        <div class="col-md-4">
                            <span class="obrigatorio"><b>Cidade: </b></span>
                            <input class="form-control form-control-cadastrar" id="cidadeCadastrar" name="cidade" required></input>
                        </div>
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Estado: </b></span>
                            <!-- <input class="form-select form-control-editar" id="estadoEditar" name="estado"></input> -->
                            <select id="estadoCadastrar" name="estado" class="form-select form-control-cadastrar" required>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                                <option value="EX">Estrangeiro</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <span class="obrigatorio"><b>Cep: </b></span>
                            <input class="form-control form-control-cadastrar" id="cepCadastrar" name="cep" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Telefone: </b></span>
                            <input type="tel" maxlength="15" class="form-control form-control-cadastrar" id="telefoneCadastrar" name="telefone" required></input>
                        </div>
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Email: </b></span>
                            <input class="form-control form-control-cadastrar" id="emailCadastrar" name="email" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Perfil: </b></span>
                            <select id="perfilCadastrar" class="form-select form-control-cadastrar" name="perfil" required>
                                <option value='' disabled='disabled' selected='selected'>Selecione</option>
                                <option value="administrador">Administrador</option>
                                <option value="funcionario">Funcionario</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <span class="obrigatorio"><b>Senha: </b></span>
                            <input type="password" class="form-control form-control-cadastrar" id="senhaCadastrar" name="senha" required></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span><b>Observação: </b></span>
                            <input class="form-control form-control-cadastrar" id="obsCadastrar" name="obs"></input>
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

<script src='js/jquery.js'></script>

<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="dataTable/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="dataTable/jszip.min.js"></script>
<!-- <script type="text/javascript" src="dataTable/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="dataTable/vfs_fonts.js"></script> -->
<script type="text/javascript" src="dataTable/buttons.html5.min.js"></script>
<script type="text/javascript" src="dataTable/buttons.print.min.js"></script>

<script src='js/consultar.js'></script>