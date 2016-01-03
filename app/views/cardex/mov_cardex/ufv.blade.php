<div class="modal fade" id="myModalufv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-medkit fa-fw"></i>Ingreso de Nueva UFV</h5>
                </div>
                <div class="modal-body">         
                        {{Form::open(array('url'=>'agreufv','method'=>'post','class'=>'form-horizontal'))}}
                                <div id="divcodigo" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Cotizacion: </label>
                                    <div class="col-sm-8">
                                      <input name="cotizacion" id="cotizacion"  type="text" class="form-control" placeholder="Cotizacion nueva">                                    </div>
                                </div>
                                <div id="ctrlcodigo">
                                  
                               </div>
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Gestion: </label>
                                    <div class="col-sm-8">
                                      <input  id="gestion" class="form-control" placeholder="Año o Gestion" name="gestion">
                                       
                                    </div>
                                </div>   
                                <button id="btnagregar"  class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>                  
                        {{Form::close()}}                                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>   
</div>

<div class="modal fade" id="modal_Editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url'=>'agre_ufv','method'=>'post','class'=>'form-horizontal','id'=>'formUfv'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Ufv <i id="load" class="fa fa-gears"></i></h4>
            </div>
            <div class="modal-body">   
                <div class="form-group">
                    <label class="col-sm-2 control-label">Cotizacion:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="cotizacion" id="cotizacion">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gestion:</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="gestion" id="gestion">
                    </div>
                </div>
                <div class="well">
                    <button type="submit" id="btnagregar" class="btn btn-default btn-lg btn-block" target="_blank">
                        Actualizar UFV
                    </button>
                </div>
                <input type="hidden" name="id" value=""> 
            {{Form::close()}}                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
    <button type="button" id="productobtn" class="btn btn-default"  data-toggle="modal" data-target="#myModalufv">
           <i class="fa fa-plus fa-fw"></i> Agregar Nueva Cotizacion de UFV
        </button>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-ufv">
                        <thead>
                            <tr>
                                <th width="40"><p class="text-center">NUMERO</p></th>
                                <th width="300"><p class="text-center">COTIZACION</p></th>
                                <th width="300"><p class="text-center">GESTION</p></th>
                                <th width="40"><p class="text-center">EDICION</p></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ufv as $ufv)
                          <tr>
                          	<td><p class="text-center">{{$ufv->id}}</p></td>
                          	<td><p class="text-center">{{$ufv->cotizacion}}</p></td>
                          	<td><p class="text-center">{{$ufv->gestion}}</p></td>
                          	<td>
	                          	<a href="" data-toggle="modal" data-target="#modal_Editar">
	                          		<button type="button" id="{{$ufv->id}}" class="btn btn-default" onclick="editar_ufv(this.id)">Editar</button>
	                          	</a>
                          	</td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
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
<script src="../kardex/val.js"></script>

<script>
function editar_ufv(id){
  var di = id;
  //alert(di);
  //var faction = window.location.href="editarufv/"+id;
  var faction = "<?php echo URL::to('editarufv/"+di+"'); ?>";
  var fdata = $('#val').serialize();
  $.post(faction, fdata, function(json){
    if(json.success){
        $('#formUfv input[name="id"]').val(json.id);
        $('#formUfv input[name="cotizacion"]').val(json.cotizacion);
        $('#formUfv input[name="gestion"]').val(json.gestion);
    }else{
        $('#errorMenssage').html(json.menssage);
        $('#errorMenssage').show();   
    }
  });
 }
$(document).ready(function() {
    $('#dataTables-ufv').DataTable({
            responsive: true
    });
});
</script>