<div class="filterVendaForm" id="filterVendaForm">
    <div class="buscarVendaForm" id="buscarVendaForm">
        <table class=" col-md-12 consultarVenda" id="consultarVenda">
            <thead class="">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Total R$</th>
                    <th scope="col">Data Entrega</th>
                    <th scope="col">Forma pagamento</th>
                    <th scope="col">Status Pagamento</th>
                </tr>
            </thead>
            <tbody id="vendas" class="bodyForm">
                {{vendas}}
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
