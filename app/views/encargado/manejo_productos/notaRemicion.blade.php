
<?php 
    $egresosdisponiblesremision=Egreso::where('nivel','=',Session::get('nivel'))->where('remicione_id','0',null)->get();    
    $correctoremission;
    if (count($egresosdisponiblesremision)>0)
    {
      $correctoremission=true;
    }
    else
    {
      $correctoremission=false;
    }

    $REnum;
        $remicionesactuales=Remicione::where('nivel','=',Session::get('nivel'))->get();
      if (count($remicionesactuales)==0)
      {
          $REnum="1/".date('m/Y');        
      }
      else
      {
        $totalremisiones=count($remicionesactuales);
        $utlimaremision=Remicione::where('id','=',$remicionesactuales[$totalremisiones-1]->id)->first();
        //separandola el numero el mes y el año para realizar operacion
        $REparafecha=explode("/", $utlimaremision->numero);
        if ($REparafecha[1]==date('m'))
        {
          $REactual=$REparafecha[0]+1;
          $REnum=$REactual."/".date('m/Y');
          
        }
          else
        {
          $REnum="1/".date('m/Y');
        }       
      }
?>    
<!---- SEGUNDO MODAL------>
<div class="modal fade" id="modalConfirmarRemision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Nota Ingreso</h5>
                </div>
                <div class="modal-body">

                   {{Form::open(array('url'=>'remision/crear','method'=>'post','class'=>'form-horizontal','autocomplete'=>'off', 'id'=>'frmRemisionConfirmar','target'=>'_blank'))}}
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Al almacen de:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="almacen_de" class="form-control" placeholder="A que almacen">
                                    </div>
                                </div>

                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Remitidos a::</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="remitidos_a" class="form-control" placeholder="Lugar de remision">
                                    </div>
                                </div>
                                 
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Revisado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="revisado_por" class="form-control" placeholder="Nombre del que reviso">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del revisor:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="cargo_revisado_por" class="form-control" placeholder="Cargo del que reviso">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Autorizado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="autorizado_por" class="form-control" placeholder="Nombre del que autorizo">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del autorizante</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="cargo_autorizado_por" class="form-control" placeholder="Cargo del que autoriza esta remision">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Despachado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="despachado_por" class="form-control" placeholder="Nombre del que despacha">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del despachante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="cargo_despachado_por" class="form-control" placeholder="Cargo del que despacha la remision">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Codigo del camion transportante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="codigo_camion" class="form-control" placeholder="Camion que transportara la remision">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Nombre del conductor responsable:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="nombre_conductor" class="form-control" placeholder="Nombre del Conductor que transportara la remision">
                                    </div>
                                </div>


                                 <div id="divnick"class="form-group" style="opacity:0">
                                     <div class="col-sm-6">
                                      <input type="text" id="REdatos" name="datos" class="form-control" readonly>
                                    </div>                                   
                                 </div>
                      
                                <div id="divnick"class="form-group">
                                  <div class="col-sm-12">
                                       <button type="submit"  id="REfrmingresoconfirmar" class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                                    </div>
                                </div>
                     
                      
                  {{Form::close()}}              
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
        
</div>
<br>

 <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa  fa-stack-overflow fa-fw"></i> NOTA DE REMISION
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="list-group">
                                
                                <div class="table-responsive">
                                    <div class="btn-group">
                                        <div class="row">
                                            <label class="form-group" style="margin-left:8%;">Egreso: </label>
                                             @if($correctoremission==true)
                                                  <select id="numeroEgreso" name="numeroEgreso" class="form-group">                                                       
                                                      @foreach($egresosdisponiblesremision as $e)
                                                                 <option>{{$e->numero}}</option> 
                                                      @endforeach
                                                  </select>     
                                                  @endif
                                                  @if($correctoremission==false)
                                                 <select disabled>
                                                       <option>No hay egresos!</option> 
                                                 </select>

                                                 @endif
                                            <button type="button" id="btnEgresoBuscar" class="btn btn-default">
                                               <i class="fa fa-plus fa-fw"></i> Agregar
                                                
                                            </button>
                                         </div> 
                                        
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalConfirmarRemision">
                                           <i class="fa fa-check fa-fw"></i> Confirmar Nota de Remicion 
                                            
                                        </button>
                                         <button type="button" id="REbtnborrar" class="btn btn-default">
                                          <i class="fa fa-times fa-fw"></i> Limpiar  
                                       
                                        </button>                                        
                                    </div>
                                    <div class="pull-right">
                                        <h3>N°: {{$REnum}}</h3> 
                                    </div>
                                    <br><br>
                                <table class="table table-striped table-bordered table-hover" id="tablas">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Unidad Uso</th>
                                            <th>Articulo</th>
                                            <th>Codigo</th>
                                            <th>Pedido</th>                                  
                                            
                                        </tr>
                                    </thead>
                                      
                                      <tbody id="REcuerpo">
                                                                        
                                      </tbody>
                                     
                                    
                                </table>
                              </div>
                             
                            </div>
                            <!-- /.list-group -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                         
</div>