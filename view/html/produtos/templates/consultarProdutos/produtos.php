<tr class='radioVendasTr'>
    <td class="text-start">{{id}}</td>
    <td class="text-start">{{produto}}</td>
    <td class="text-center">{{medida}}</td>
    <td class="text-center valor">{{valor}}</td>
    <td class="text-end">
        <a href='#' onclick="carregarModalEditar('{{id}}')" class='btn editar  btn-sm' data-toggle="modal" data-target="#editar"><i class="fas fa-edit" style="font-size:20px;color:#BDB76B" title="editar"></i></a>
        <a href='#' onclick="carregarModalExcluir('{{id}}')" class='btn excluir  btn-sm' data-toggle="modal" data-target="#excluir" id="excluir{{id}}"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color: red;" title="excluir"></i>
        </a>
    </td>
</tr>