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
                        <h2 class="text-center">ADMINISTRACION DE USUARIOS SDC POTOSI</h2>
                        <?php $status=Session::get('status'); ?>
                        @if($status == 'ok_create')
                            <div class="row col-lg-offset-2 col-lg-8">
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    El Usuario fue Creado con. <a href="#" class="alert-link">Exito</a>.
                                </div>
                            </div>
                        @endif
                        @if($status == 'ok_delete')
                            <div class="row col-lg-offset-2 col-lg-8">
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    El Usuario fue Eliminado con. <a href="#" class="alert-link">Exito</a>.
                                </div>
                            </div>
                        @endif
                        @if($status == 'ok_update')
                            <div class="row col-lg-offset-2 col-lg-8">
                                <div class="alert alert-warning alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    El Usuario fue Actualizado con. <a href="#" class="alert-link">Exito</a>.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#add-pills" data-toggle="tab">Ver Usuarios</a>
                        </li>
                        <li>
                            <a href="#ver-pills" data-toggle="tab">Agregar Usuario</a>
                        </li>                            
                    </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="add-pills">
                        @include('administrador.gestion_user.verusuarios')
                    </div>
                    <div class="tab-pane fade" id="ver-pills">
                        @include('administrador.gestion_user.crearuser')
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
    
    <script>
    $(document).ready(function() {
       
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    </script>
</body>
</html>