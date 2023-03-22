<div class="filterVendaForm" id="filterVendaForm">
    <div class="buscarVendaForm" id="buscarVendaForm">
        <table class=" col-md-12 consultarVenda" id="consultarVenda">
            <thead class="">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Descrição da aporte</th>
                    <th scope="col">Data da aporte</th>
                    <th scope="col">Valor da aporte R$</th>
                </tr>
            </thead>
            <tbody id="vendas" class="bodyForm">
                {{aportes}}
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
            <span>Valor total dos Aportes</span>
            <p class="card-text">R$ {{valorTotalFinalSomado}}</p>
        </div>
    </div>
</div>