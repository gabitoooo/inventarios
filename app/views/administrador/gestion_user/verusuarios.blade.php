<div class="modal fade" id="modal_Editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url'=>'actualizar','method'=>'post','class'=>'form-horizontal','id'=>'formEdit'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Usuario <i id="load" class="fa fa-gears"></i></h4>
            </div>
            <div class="modal-body">   
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nivel:</label>
                    <div class="col-sm-10">
                        <input list="oficio" class="form-control" name="level" id="level">
                        <datalist id="oficio" class="panel-default">
                            <option value="2">Manejo de inventario Maestranza</option>
                            <option value="3"></option>
                            <option value="4"></option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombres:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nombres" id="nombres">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos:</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="apellidos" id="apellidos">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">CI:</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="ci" id="ci">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Correo:</label>
                    <div class="col-sm-10">
                      <input  type="email" class="form-control" name="correo" id="correo">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Telefono:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="telefono" id="telefono">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Direccion:</label>
                    <div class="col-sm-10">
                      <input  type="text" class="form-control" name="direccion" id="direcccion">
                    </div>
                </div>
                <div class="well">
                    <button type="submit" id="btnagregar" class="btn btn-default btn-lg btn-block" target="_blank">
                        Actualizar Datos
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th width="8%"><p class="text-center">NICK</p></th>
                                <th width="3%"><p class="text-center">NIVEL</p></th>
                                <th width="12%"><p class="text-center">NOMBRES</p></th>
                                <th width="12%"><p class="text-center">APELLIDOS</p></th>
                                <th width="7%"><p class="text-center">CI. NUM</p></th>
                                <th width="13"><p class="text-center">CORREO</p></th>
                                <th width="7%"><p class="text-center">TELEFONO</p></th>
                                <th width="15%"><p class="text-center">DIRECCION</p></th>
                                <th width="11%"><p class="text-center">CREADO EL</p></th>
                                <th width="12%"><p class="text-center">OPERACIONES</p></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $i=0; ?>
                            @foreach($users as $s)
                            <tr>
                                <td class="text-center">{{$s->username}}</td>
                                <td class="text-center">{{$s->nivel}}</td>
                                <td class="text-center">{{$personas[$i]->nombres}}</td>
                                <td class="text-center">{{$personas[$i]->apellidos}}</td>
                                <td class="text-center">{{$personas[$i]->ci}}</td>
                                <td class="text-center">{{$s->email}}</td>
                                <td class="text-center">{{$personas[$i]->telefono}}</td>
                                <td class="text-center">{{$personas[$i]->direccion}}</td>
                                <td class="text-center">{{$personas[$i]->created_at}}</td>
                                <td class="text-center"> 
                                    <a href="" data-toggle="modal" data-target="#modal_Editar"><button type="button" id="{{$s->id}}" class="btn btn-default" onclick="editar_user(this.id)">Editar</button></a>
                                    <a href="delete/{{$s->id}}"><button type="button" id="btnborrar" class="btn btn-default">Eliminar</button></a> 
                                </td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        function editar_user(id){
                            //var faction = window.location.href="editar/"+id;
                            var di = id;
                            //alert(di);
                            var faction = "<?php echo URL::to('editar/"+di+"'); ?>";
                            var fdata = $('#val').serialize();
                            $.post(faction, fdata, function(json){
                                if(json.success){
                                    $('#formEdit input[name="id"]').val(json.id);
                                    $('#formEdit input[name="level"]').val(json.level);
                                    $('#formEdit input[name="nombres"]').val(json.nombres);
                                    $('#formEdit input[name="apellidos"]').val(json.apellidos);
                                    $('#formEdit input[name="ci"]').val(json.ci);
                                    $('#formEdit input[name="correo"]').val(json.correo);
                                    $('#formEdit input[name="telefono"]').val(json.telefono);
                                    $('#formEdit input[name="direccion"]').val(json.direccion);
                                   // $('#formEdit').show();
                                }else{
                                    $('#errorMenssage').html(json.menssage);
                                    $('#errorMenssage').show();   
                                }
                            });
                            //$('#').hide();
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>