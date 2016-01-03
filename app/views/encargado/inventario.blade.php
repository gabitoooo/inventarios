<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SDC tabla de inventarios</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../ecargado/style.css">
    </head>
<body>    
    @include('layouts/encabezado')
    <div class="row col-lg-offset-1 col-lg-10">
        <div id="">
            <div class="col-lg-12 col-md-12">
                <div class="row">+
                    @if(Session::get('nivel')==2)
                    <div class="col-lg-12">
                        <h2 class="text-center">ADMINISTRACION DE INVENTARIOS DE MAESTRANZA</h2>
                    </div>
                    @endif
                    @if(Session::get('nivel')==4)
                    <div class="col-lg-12">
                        <h2 class="text-center">ADMINISTRACION DE PROYECTOS</h2>
                    </div>
                    @endif
                </div>
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#pedidocompra-pills" data-toggle="tab">Pedido compra</a>
                        </li>
                        <li>
                            <a href="#pedidonormal-pills" data-toggle="tab">Pedido normal</a>
                        </li>
                        
                        <li >
                            <a href="#crear-pills" data-toggle="tab">Nota de Ingreso</a>
                        </li>
                        <li>
                            <a href="#egreso-pills" data-toggle="tab">Egreso de productos</a>
                        </li>
                        <li>
                            <a href="#notaRemicion-pills" data-toggle="tab">Nota de Remicion</a>
                        </li>
                        <li>
                            <a href="#ver-pills" data-toggle="tab">Ver Inventarios</a>
                        </li>                            
                    </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="pedidocompra-pills">
                          @include('encargado/manejo_productos/pedidocompras')                       
                    </div>
                    <div class="tab-pane fade" id="pedidonormal-pills">
                        @include('encargado/manejo_productos/pedidonormal')
                    </div>
                    <div class="tab-pane fade" id="crear-pills">
                        @include('encargado/manejo_productos/crearproducto')
                    </div>
                    <div class="tab-pane fade" id="egreso-pills">
                        @include('encargado/manejo_productos/egresos')
                    </div>
                    <div class="tab-pane fade" id="ver-pills">
                        @include('encargado/manejo_productos/verinventarios')
                    </div>
                     <div class="tab-pane fade" id="notaRemicion-pills">
                        @include('encargado/manejo_productos/notaRemicion')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../ecargado/remision.js"></script>
    <script src="../ecargado/ing.js"></script>
    <script src="../ecargado/pedidocompra.js"></script>
    <script src="../ecargado/pedido.js"></script>
     <script src="../ecargado/egreso.js"></script>

    
    <script>
    $(document).ready(function() {
        
        $('#dataTables-example').DataTable({
                responsive: true
        });
       


    });

    </script>
  
</body>
</html>