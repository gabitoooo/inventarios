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
                        <h2 class="text-center">Recuperacion de Contraseña</h2>
                    </div>
                </div>
                <?php $status=Session::get('status'); ?>
                @if($status == 'ok_send')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            La contraseña fue envia con <a href="#" class="alert-link">Exito</a>.
                        </div>
                    </div>
                @endif
                 @if($status == 'not_send')
                    <div class="row col-lg-offset-2 col-lg-8">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            El Correo es Incorrecto por lo tanto <a href="#" class="alert-link">No Existe</a>.
                        </div>
                    </div>
                @endif
                <label class="col-sm-12 control-label"><p class="text-center">Ingresa el Correo al cual se enviara del password</p></label>
                {{Form::open(array('url'=>'mandar','method'=>'post','class'=>'form-horizontal'))}} 
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Tu Email: </label>
		                <div class="col-sm-9">
		                  <input  type="email" class="form-control" placeholder="Ejemplo@gmail.com" name="email">
		                </div>
		            </div>
		            <input type="hidden" name="contacto" value="">
		            <div class="well">
		                <button type="submit" id="btnagregar" class="btn btn-default btn-lg btn-block" target="_blank">
		                    Enviar a Correo Electronico
		                </button> 
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