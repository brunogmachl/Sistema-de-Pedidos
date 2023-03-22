<tr class='radioVendasTr'>
    <td>{{id}}</td>
    <td>{{clienteNome}}</td>
    <td>{{clienteTelefone}}</td>
    <td class="valor">{{contaFinal}}</td>
    <td>{{dataEntregaProduto}}</td>
    <td>{{formaPagamento}}</td>
    <td>{{statusPagamento}}</td>
    <td class="text-center">
        <a href='index.php?metodo=editarVendas&id={{id}}' class='btn btn-sm'><i class="fas fa-edit" style="font-size:20px;color:#BDB76B" title="editar"></i></a>

        <a href='#' onclick="carregarModalRecibo('{{id}}')" class='btn verificar  btn-sm' data-toggle="modal" data-target="#recibo"><i class="fa fas fa-receipt" style="font-size:20px;color:blue" title="recibo"></i></a>
        
        <a href='#' onclick="carregarModalReciboNf('{{id}}')" class='btn verificar  btn-sm' data-toggle="modal" data-target="#notaFiscal"><i class="fa fas fa-receipt" style="font-size:20px;color:pink" title="nota fiscal"></i></a>

        <a href='#' onclick="carregarModalExcluir('{{id}}')" class='btn excluir  btn-sm' data-toggle="modal" data-target="#excluir" id="excluir{{id}}"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color: red;" title="excluir"></i>
        </a>

        <!-- <a href='index.php?metodo=editarVendas&id={{id}}' class='btn btn-sm'><i class="fas fa-receipt" style="font-size:20px;color:blue" title="recibo"></i></a> -->

    </td>
</tr>

<!-- <td class="text-end">
        <a href='#' onclick="carregarModalVerificar('{{id}}')" class='btn verificar  btn-sm' data-toggle="modal" data-target="#verificar"><i class="fa fa-info-circle text-secondary" style="font-size:20px;color:blue" title="detalhes"></i></a>
        <a href='#' onclick="carregarModalEditar('{{id}}')" class='btn editar  btn-sm' data-toggle="modal" data-target="#editar"><i class="fas fa-edit" style="font-size:20px;color:#BDB76B" title="editar"></i></a>
        <a href='#' onclick="carregarModalExcluir('{{id}}')" class='btn excluir  btn-sm' data-toggle="modal" data-target="#excluir" id="excluir{{id}}"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color: red;" title="excluir"></i>
        </a>
    </td> -->