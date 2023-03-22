<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet" />
<style>
    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card {
        border-radius: 5px;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
        padding: 30px;
        margin: 20px;
        width: 280px;
        height: 130px;
        transition: all 0.3s ease-out;
    }
    .blue {
        border-left: 3px solid #4895ff;
    }
    .green {
        border-left: 3px solid #3bb54a;
    }
    .red {
        border-left: 3px solid #b3404a;
    }

</style>

<div class="content container-fluid">
    <div class="row">
        <div class="card green">
            <h2 id="aReceberHoje"></h2>
            <p>A receber hoje</p>
            <!-- <img class="image" src="money.png" alt="money" /> -->
        </div>

        <div class="card blue" >
            <h2 id="aReceber7Dias"></h2>
            <p>A receber próximos 7 dias</p>
            <!-- <img class="image" src="settings.png" alt="settings" /> -->
        </div>

        <div class="card red">
            <h2 id="vendasFinalizadas7Dias"></h2>
            <p>Vendas ultimos 7 dias</p>
            <!-- <img class="image" src="article.png" alt="article" /> -->
        </div>
    </div>

    <div class="row mt-3 justify-content-between">

    </div>


    <!-- <div id="scrollRelatorios"> -->

        <div class="mt-2 row" id="relatorio">
        </div>
    <!-- </div> -->
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