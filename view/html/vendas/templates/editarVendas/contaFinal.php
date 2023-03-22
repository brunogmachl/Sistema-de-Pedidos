<div class='primeiraLinha'>
            <div class=''>
                <label>Total R$</label>
                <input type='text' class='inputAutomatico' id='valorTotal' value='{{total}}'>
            </div>
            <div class=''>
                <label>Desconto %<input type='text' class='inputManual' id='desconto' value={{desconto}}>
            </div>
            <div class=''>
                <label>Entrega R$</label>
                <input type='text' class='inputManual' id='entrega' value={{entrega}}>
            </div>
            <div class=''>
                <label>Final</label>
                <input type='text' id='contaFinal' class='inputAutomatico' value={{final}} readonly>
            </div>
        </div>
        <div class='segundaLinha'>
            <div class=''>
                <span>Status:</span>
                <select class='statusPagamento' id='statusPagamento' name='' required>
                    <option value='' selected='selected' disabled='disabled'>Selecione</option>
                    <option value='Em aberto'>Em aberto</option>
                    <option value='Finalizado'>Finalizado</option>
                    <option value='Cancelado'>Cancelado</option>
                </select>
            </div>
            <div class=''>
                <span>Forma:</span>
                <select class='formaPagamento' id='formaPagamento' name='' required>
                    <option value='' selected='selected' disabled='disabled'>Selecione</option>
                    <option value='Em aberto'>Em aberto</option>
                    <option value='Débito'>Débito</option>
                    <option value='Crédito'>Crédito</option>
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
                <input type='text' id='dataDaVenda' class='inputAutomatico' value='{{dataDaVenda}}' required readonly>
            </div>
            <div class=''>
                <label>Data da Entrega</label>
                <input type='datetime-local' class='inputAutomatico' placeholder='dd-mm-yyyy' placeholder='' id='dataEntrega' value={{dataDaEntrega}} required>
            </div>
        </div>
        <div class='terceiraLinha'>
            <div class='campoObservacao'>
                <div class='observacao'>
                    <textarea class='observacaoTextArea' id='observacaoTextArea' rows='1' placeholder='Observação...' value=''>{{observacao}}</textarea>
                </div>
            </div>
            <div class='BotaoCadastrar'>
                <div class='cadastrar'>
                    <button class='btn btn-primary' type='submit' id='cadastrar' >Atualizar</button>
                </div>
            </div>
        </div>

        <!-- incluindo as opcoes de select da pagina editarVenda -->
        <script>
            var text = '{{statusPagamento}}';
                var select = document.querySelector('#statusPagamento');
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].text === text) {
                        select.selectedIndex = i;
                        break;
                    }
            }

            var text = '{{formaPagamento}}';
                var select = document.querySelector('#formaPagamento');
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].text === text) {
                        select.selectedIndex = i;
                        break;
                    }
            }

            var text = '{{funcionario}}';
                var select = document.querySelector('#funcionarioEscolhido');
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].text === text) {
                        select.selectedIndex = i;
                        break;
                    }
            }

            document.getElementById('radioClientesId').checked = true

        </script>