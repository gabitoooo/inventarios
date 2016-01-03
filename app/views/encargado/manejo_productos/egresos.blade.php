<?php

     $EGnum;
        $egresosactuales=Egreso::where('nivel','=',Session::get('nivel'))->get();
      if (count($egresosactuales)==0)
      {
          $EGnum="1/".date('m/Y');        
      }
      else
      {
        $totalegresos=count($egresosactuales);
        $utlimoegreso=Egreso::where('id','=',$egresosactuales[$totalegresos-1]->id)->first();
        //separandola el numero el mes y el año para realizar operacion
        $EGparafecha=explode("/", $utlimoegreso->numero);
        if ($EGparafecha[1]==date('m'))
        {
          $EGactual=$EGparafecha[0]+1;
          $EGnum=$EGactual."/".date('m/Y');
          
        }
          else
        {
          $EGnum="1/".date('m/Y');
        }       
      }
      //SELECCION DE PEDIDOS NORMALES Y DE COMPRAS SIN CONFIRMAR
      $pedidosnormales=Pedido::where('nivel','=',Session::get('nivel'))->where('confirmado','=',false)->get();
      $pedidocompras=Pedidocompra::where('nivel','=',Session::get('nivel'))->where('confirmado_egreso','=',false)->get();
      $correctonormal=false;
      $correctocompra=false;
      if(count($pedidosnormales)>0 && count($pedidocompras)>0)
      {
          $correctonormal=true;
          $correctocompra=true;
      }
      else
      {
          if (count($pedidosnormales)>0)
          {
            $correctonormal=true;
          }
          if (count($pedidocompras)>0)
          {
            $correctocompra=true;
          }
      }
?>



<!---PRIMER MODAL---->
<div class="modal fade" id="myModalEgreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Egreso de Productos</h5>
                </div>
                <div class="modal-body">
                      
                        <form id="EGfrmcarrito" class="form-horizontal" autocomplete="off">
                         
                                <div id="divEGcodigo" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Codico interno: </label>
                                    <div class="col-sm-8">
                                      <input name="EGcodigo" id="EGcodigo"  type="text" class="form-control" placeholder="Codigo interno"> 
                                   </div>
                                </div>
                                <div id="ctrlEGcodigo">
                                  
                               </div>
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Ubicación: </label>
                                    <div class="col-sm-8">
                                      <input  id="EGubicacion" disabled class="form-control" placeholder="EGubicacion">
                                       
                                    </div>
                                </div>                     
                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Unidad de medida: </label>
                                  <div class="col-sm-8">
                                    <input id="EGmedida" class="form-control" disabled placeholder="Unidad de medida ej: kilos, tubo" name="EGmedida">
                                     
                                  </div>
                                </div>
                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Descripcion: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="EGdescripcion" disabled name="EGdescripcion" class="form-control" placeholder="Descricion del producto">
                                    </div>
                                </div>
                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Precio Unitario: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="EGpreciounitario" disabled name="EGprecio"  class="form-control decimales" placeholder="Precio por unidad">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cuenta: </label>
                                    <div class="col-sm-8">
                                         <input type="text" id="EGcuenta" disabled name="EGcuenta"  class="form-control decimales" placeholder="Cuenta a la que pertence el producto">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Existencias Actuales: </label>
                                    <div class="col-sm-8">
                                         <input type="text" disabled id="EGcantidadactual"class="form-control decimales" placeholder="Cuenta a la que pertence el producto">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cantidad a pedir:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="EGcantidad" name="EGcantidad" class="form-control numeros" placeholder="Cantidad entrante de productos">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Unidad que usara el articulo:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="EGunidad_uso" name="EGunidad_uso" class="form-control" placeholder="numero de unidad que utilizara este producto">
                                    </div>
                                </div>



                           </form>                                   
                        <button id="EGbtnagregar"  class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                    
                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
        
</div>
     
<!---- SEGUNDO MODAL------>
<div class="modal fade" id="modalConfirmarEgreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Nota Ingreso</h5>
                </div>
                <div class="modal-body">

                   {{Form::open(array('url'=>'egreso/crear','method'=>'post','class'=>'form-horizontal','autocomplete'=>'off', 'id'=>'frmegresoconfirmar','target'=>'_blank'))}}
                               
                                
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Referencia de pedido: </label>
                                    <div class="col-sm-8">
                                       @if($correctonormal==true && $correctocompra==true)
                                            <select id="EGnumero_pedido" name="numero_pedido" class="form-control">                                                       
                                                  @foreach($pedidosnormales as $pn)
                                                             <option>PN {{$pn->numero}}</option> 
                                                  @endforeach
                                                  @foreach($pedidocompras as $pc)
                                                             <option>PC {{$pc->numero}}</option> 
                                                  @endforeach
                                            </select>
                                        
                                        @else
                                            @if($correctonormal==true)
                                                  <select id="EGnumero_pedido" name="numero_pedido" class="form-control">                                                       
                                                  @foreach($pedidosnormales as $pn)
                                                             <option>PN {{$pn->numero}}</option> 
                                                  @endforeach
                                                  </select>     
                                            @endif
                                            @if($correctocompra==true)
                                                  <select id="EGnumero_pedido" name="numero_pedido" class="form-control">                                                       
                                                   @foreach($pedidocompras as $pc)
                                                             <option>PC {{$pc->numero}}</option> 
                                                  @endforeach
                                                  </select>

                                            @endif
                                        @endif                                    

                                        @if($correctonormal==false && $correctocompra==false)
                                                <input id="EGnumero_pedido" type="text" name="numero_pedido" value="No hay pedido pedidos normales ni de compras" class="form-control" Disabled>
                                         @endif

                                      
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Para uso en:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="para_uso_en" class="form-control" placeholder="Area donde se utilizaran los productos">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Entregado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="entregado_por" class="form-control" placeholder="Nombre de la persona entregante">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del Entregante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="cargo_entregado_por" class="form-control" placeholder="Cargo del que entrega ej: Director, Ingeniero,etc">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Recivido por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="recivido_por" class="form-control" placeholder="Nombre de la persona entregante">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del Receptor:</label>
                                    <div class="col-sm-8">
                                      <input type="text" name="cargo_recivido_por" class="form-control" placeholder="Cargo del que recive los productos ej: Director, Ingeniero,etc">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group" style="opacity:0">
                                     <div class="col-sm-6">
                                      <input type="text" id="EGdatos" name="datos" class="form-control" readonly>
                                    </div>                                   
                                 </div>
                      
                       <div id="divnick"class="form-group">
                                  <div class="col-sm-12">
                                       <button type="submit"  id="EGfrmingresoconfirmar" class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
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
                            <i class="fa  fa-stack-overflow fa-fw"></i> ACTA DE ENTREGA DE MATERIALES Y SUMINISTROS
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="list-group">
                                
                                <div class="table-responsive">
                                    <div class="btn-group">
                                        <button type="button" id="productobtn" class="btn btn-default"  data-toggle="modal" data-target="#myModalEgreso">
                                           <i class="fa fa-plus fa-fw"></i> Agregar Productos
                                            
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalConfirmarEgreso">
                                           <i class="fa fa-check fa-fw"></i> Confirmar Egreso (ACTA DE ENTREGA DE MATERIALES) 
                                            
                                        </button>
                                         <button type="button" id="EGbtnborrar" class="btn btn-default">
                                          <i class="fa fa-times fa-fw"></i> Limpiar  
                                            
                                        </button>                                        
                                    </div>
                                    <div class="pull-right">
                                        <h3>N°: {{$EGnum}}</h3> 
                                    </div>
                                    <br><br>
                                <table class="table table-striped table-bordered table-hover" id="tablas">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Codigo Interno</th>
                                            <th>Cantidad</th>
                                            <th>Unidad</th>
                                            <th>Unidad que usara</th>
                                            <th>DESCRIPCION</th>
                                           
                                            
                                        </tr>
                                    </thead>
                                    
                                      <tbody id="EGcuerpo">
                                                                      
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

