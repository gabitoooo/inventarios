<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SDC Perfil</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
<body>    
    @include('layouts/encabezado')
    <div class="row col-lg-offset-4 col-lg-4">
        <div id="">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">Datos de tu Perfil</h2>
                    </div>
                </div>
                <?php $status=Session::get('status'); ?>
                @if($status == 'not')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Error no es la Contraseña <a href="#" class="alert-link">Correcta</a>.
                        </div>
                    </div>
                @endif
                @if($status == 'dife')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Las Contraseñas Escritas no son <a href="#" class="alert-link">Iguales</a>.
                        </div>
                    </div>
                @endif
                @if($status == 'vacio1')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            La Segunda contraseña no puede ser <a href="#" class="alert-link">Vacia</a>.
                        </div>
                    </div>
                @endif
                @if($status == 'vacio2')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            La Primera contraseña no puede ser <a href="#" class="alert-link">Vacia</a>.
                        </div>
                    </div>
                @endif
                @if($status == 'yes')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Contraseña Cambiada con <a href="#" class="alert-link">Exito</a>.
                        </div>
                    </div>
                @endif
                @if($status == 'reset')
                   {{Form::open(array('url'=>'reset','method'=>'post','class'=>'form-horizontal'))}}
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nueva Contraseña: </label>
                        <div class="col-sm-8">
                            <input type="password" name="password1" class="form-control" value="" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Repita la Contraseña: </label>
                        <div class="col-sm-8">
                            <input type="password" name="password2" class="form-control" value="" autofocus>
                        </div>
                    </div> 
                    <div class="form-group">
                        <center>
                            <button type="submit" id="btnagregar" class="btn btn-default" target="_blank">
                                Confirmar Contraseña
                            </button>
                        </center>
                    </div>    
                    {{Form::close()}}
                @endif
                @if($status == 'ok_reset')
                   {{Form::open(array('url'=>'recuperar','method'=>'post','class'=>'form-horizontal'))}}
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Escriba su contraseña: </label>
                        <div class="col-sm-6">
                            <input type="password" name="password" class="form-control" value="" autofocus>
                        </div>
                        <button type="submit" id="btnagregar" class="btn btn-default col-sm-2" target="_blank">
                            Cambiar
                        </button>
                    </div> 
                    {{Form::close()}}
                @endif
                {{Form::open(array('url'=>'','method'=>'post','class'=>'form-horizontal'))}} 
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Fecha de Creacion: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$u->created_at}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nombre de Usuario: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$u->username}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nivel de Usuario: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$u->nivel}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Correo Electronico: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$u->email}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nombres: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$p->nombres}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Apellidos: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$p->apellidos}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">N° de Carnet: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$p->ci}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">N° de Telefono: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$p->telefono}}" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Direccion: </label>
                        <div class="col-sm-8">
                          <input class="form-control" value="{{$p->direccion}}" disabled="">
                        </div>
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../ecargado/ing.js"></script>
    
    <script>
    $(document).ready(function() {
       
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>