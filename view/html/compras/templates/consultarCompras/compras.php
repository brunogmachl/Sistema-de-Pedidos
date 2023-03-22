<tr class='radioVendasTr'>
    <td>{{id}}</td>
    <td>{{compra}}</td>
    <td>{{data}}</td>
    <td>{{formaCompra}}</td>
    <td>{{parcelaCompra}}</td>
    <td class="valor">{{valor}}</td>
    <td class="text-end">
        <a href='#' onclick="carregarModalVerificar('{{id}}')" class='btn verificar  btn-sm' data-toggle="modal" data-target="#verificar"><i class="fa fa-info-circle text-secondary" style="font-size:20px;color:blue" title="detalhes"></i></a>
        <a href='#' onclick="carregarModalEditar('{{id}}')" class='btn editar  btn-sm' data-toggle="modal" data-target="#editar"><i class="fas fa-edit" style="font-size:20px;color:#BDB76B" title="editar"></i></a>
        <a href='#' onclick="carregarModalExcluir('{{id}}')" class='btn excluir  btn-sm' data-toggle="modal" data-target="#excluir" id="excluir{{id}}"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color: red;" title="excluir"></i>
        </a>
    </td>
</tr>