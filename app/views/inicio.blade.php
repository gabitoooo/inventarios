<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SDC Potosi</title>
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/timeline.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
</head>
<body>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ingresar (solo personal autorizado)</h4>
                </div>
                <div class="modal-body">                         
                    {{Form::open(array('url'=>'controlaringreso', 'method'=> 'post'))}}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nombre de usuario" name="username" type="text" id="txtusuario" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                        </div>
                        <button type="submit"  class="btn btn-lg btn-success">Ingresar</button>
                    </fieldset>
                    {{Form::close()}}           
                </div>
                <div class="modal-footer">
                    <a href="email">¿Olvidaste tu Contraseña?</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        @include('layouts/encabezado')
        @if(Session::has('errores'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <p class="text-center">USTED NO ES USUARIO AUTORIZADO PARA ESTE SUB-SISTEMA</p>
                </div>
            </div>
        </div>
        @endif 
        <div class="row col-lg-offset-1 col-lg-10">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">SERVICIO DEPARTAMENTAL DE CAMINOS MAESTRANZA</h2>
                </div>
            </div>
                    <div class="row">
                        <a href="#" data-toggle="modal" data-target="#myModal">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-list-alt fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div><h3>Inventarios</h3></div>
                                                <div>Sistema de Inventarios</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-left">Ingresar Sistema de Inventarios</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#myModal">    
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-folder-open fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div><h3>Cardex</h3></div>
                                                <div>Sistema de Cardex</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-left">Ingresar Sistema de Cardex</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#myModal">
                            <div class="col-lg-3 col-md-6 col--xs-4">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-cogs fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div><h3>Administrador</h3></div>
                                                <div>Sistema de Administrador</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-left">Ingresar Sistema de Administrador</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#myModal">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-book fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div><h3>Proyectos</h3></div>
                                                <div>Sistema de Proyectos</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="pull-left">Ingresar Sistema de Proyectos</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                    @include('encargado/manejo_productos/verinventarios')
                    </div>
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                pageLength:-1,
                lengthMenu:[[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
        $('#myModal').on('shown.bs.modal', function () {
            $('#txtusuario').focus()
        });
    });
    </script>
</body>
</html>