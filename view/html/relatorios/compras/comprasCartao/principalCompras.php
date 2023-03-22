<div class="filterVendaForm" id="filterVendaForm">
    <div class="buscarVendaForm" id="buscarVendaForm">
        <table class=" col-md-12 consultarVenda" id="consultarVenda">
            <thead class="">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Descrição da compra</th>
                    <th scope="col">Data 1 parcela</th>
                    <th scope="col">Forma da compra</th>
                    <th scope="col">Parcela</th>
                    <th scope="col">Valor da compra</th>
                </tr>
            </thead>
            <tbody id="vendas" class="bodyForm">
                {{compras}}
                {{resultadoFinal}}
            </tbody>
        </table>
      <!--  -->
    </div>
</div>
{{inicio}}
{{meio}}
{{fim}}

<div class="d-flex justify-content-center">
    <div class="card" style="width: 18rem;" >
        <img class="card-img-top" src="" alt="">
        <div class="card-body text-center" style="background-color: papayawhip;">
            <span>{{titulo ValorTotal}}</span>
            <p class="card-text">R$ {{valorTotalFinalSomado}}</p>
        </div>
    </div>
</div>
