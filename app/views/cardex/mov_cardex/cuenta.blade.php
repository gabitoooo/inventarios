<div class="modal fade" id="modal-cuentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url'=>'','method'=>'post','class'=>'form-horizontal','id'=>'formCuenta'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Cuenta <i class="fa fa-gears"></i></h4>
            </div>
            <div class="modal-body">   
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombres:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Numero:</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control numeros" name="numero">
                    </div>
                </div>
                <div class="well">
                    <button type="submit" id="btnagregar" class="btn btn-default btn-lg btn-block" target="_blank">
                        Actualizar Datos
                    </button>
                </div>
                <input type="hidden" name="id_cuenta" value=""> 
            {{Form::close()}}                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-cuentas">
                        <thead>
                            <tr>
                                <th width="28%"><p class="text-center">NOMBRE DE CUENTA</p></th>
                                <th width="20%"><p class="text-center">NUMERO DE CUENTA</p></th>
                                <th width="20%"><p class="text-center">FECHA DE CREACION</p></th>
                                <th width="20%"><p class="text-center">FECHA DE ACTUALIZACION</p></th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($cuentas as $cuenta)
                            <tr>
                                <td class="text-center">{{$cuenta->nombre_cuenta}}</td>
                                <td class="text-center">{{$cuenta->numero_cuenta}}</td>
                                <td class="text-center">{{$cuenta->created_at}}</td>
                                <td class="text-center">{{$cuenta->updated_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function editar_cuenta(id){
  var di = id;
  var faction = "<?php echo URL::to('editarcuenta/"+di+"'); ?>";
  var fdata = $('#val').serialize();
  $.post(faction, fdata, function(json){
    if(json.success){
        $('#formCuenta input[name="id_cuenta"]').val(json.id);
        $('#formCuenta input[name="nombre"]').val(json.nombre);
        $('#formCuenta input[name="numero"]').val(json.numero);
    }else{
        $('#errorMenssage').html(json.menssage);
        $('#errorMenssage').show();   
    }
  });
  }
</script>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../kardex/val.js"></script>
    
    <script>
    $(document).ready(function() {
       
        $('#dataTables-cuentas').DataTable({
                responsive: true
        });
    });
    </script>