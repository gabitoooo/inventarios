<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SDC Administrador</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
<body>    
    @include('layouts/encabezado')
    <div class="row col-lg-offset-1 col-lg-10">
        <div id="">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">ADMINISTRACION DE CARDEX SDC POTOSI</h2>
                    </div>
                </div>                
                <?php $status=Session::get('status');?>
                <?php $stat=Session::get('stat');?>
                @if($stat!='ok_inicio')
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#add-pills" data-toggle="tab">Ver Inventarios</a>
                        </li>
                        <li>
                            <a href="#ver-pills" data-toggle="tab">Ver Cardex de Productos</a>
                        </li>                         
                         <li>
                            <a href="#ver-ufv" data-toggle="tab">Actuaizar UFV</a>
                        </li>
                        <li>
                            <a href="#ver-cuentas" data-toggle="tab">Ver Cuentas</a>
                        </li>  
                    </ul>
                     <div class="tab-content">
                        <div class="tab-pane fade in active" id="add-pills">
                            @include('cardex.mov_cardex.movcardex')
                        </div>
                        <div class="tab-pane fade" id="ver-pills">
                            @include('cardex.mov_cardex.vercardex')
                        </div>
                         <div class="tab-pane fade" id="ver-ufv">
                            @include('cardex.mov_cardex.ufv')
                        </div>
                        <div class="tab-pane fade" id="ver-cuentas">
                            @include('cardex.mov_cardex.cuenta')
                        </div>
                    </div>
                @endif
                @if($status=='ok_ufv')
                    <ul class="nav nav-tabs nav-justified">
                        <li >
                            <a href="#add-pills" data-toggle="tab">Ver Inventarios</a>
                        </li>
                        <li>
                            <a href="#ver-pills" data-toggle="tab">Ver Cardex de Productos</a>
                        </li>                         
                        <li class="active">
                            <a href="#ver-ufv" data-toggle="tab">Actuaizar UFV</a>
                        </li>
                        <li>
                            <a href="#ver-cuentas" data-toggle="tab">Ver Cuentas</a>
                        </li>  
                    </ul>
                <div class="tab-content">
                    <div class="tab-pane fade " id="add-pills">
                        @include('cardex.mov_cardex.movcardex')
                    </div>
                    <div class="tab-pane fade" id="ver-pills">
                        @include('cardex.mov_cardex.vercardex')
                    </div>
                    <div class="tab-pane fade in active" id="ver-ufv">
                        @include('cardex.mov_cardex.ufv')
                    </div>
                    <div class="tab-pane fade" id="ver-cuentas">
                        @include('cardex.mov_cardex.cuenta')
                    </div>
                </div>
                @endif  
 <!--               @if($status=='ok_ingreso')
                    <ul class="nav nav-tabs nav-justified">
                        <li >
                            <a href="#add-pills" data-toggle="tab">Ver Inventarios</a>
                        </li>
                        <li class="active">
                            <a href="#ver-pills" data-toggle="tab">Ver Cardex de Productos</a>
                        </li>                         
                        <li>
                            <a href="#ver-ufv" data-toggle="tab">Actuaizar UFV</a>
                        </li>
                        <li>
                            <a href="#ver-cuentas" data-toggle="tab">Ver Cuentas</a>
                        </li>  
                    </ul>
                <div class="tab-content">
                    <div class="tab-pane fade " id="add-pills">
                        @include('cardex.mov_cardex.movcardex')
                    </div>
                    <div class="tab-pane fade in active" id="ver-pills">
                        @include('cardex.mov_cardex.vercardex')
                    </div>
                    <div class="tab-pane fade" id="ver-ufv">
                        @include('cardex.mov_cardex.ufv')
                    </div>
                    <div class="tab-pane fade" id="ver-cuentas">
                        @include('cardex.mov_cardex.cuenta')
                    </div>
                </div>
                @endif-->
                
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../kardex/val.js"></script>
    
    <script>
    $(document).ready(function() {
       
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>