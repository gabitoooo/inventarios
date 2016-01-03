<?php
    $PNnum;
        $pedidosactuales=Pedido::where('nivel','=',Session::get('nivel'))->get();
      if (count($pedidosactuales)==0)
      {
        $PNnum="1/".date('m/Y');        
        }
      else
      {
        $totalpedidosnormales=count($pedidosactuales);
        $utlimopedidonoral=Pedido::where('id','=',$pedidosactuales[$totalpedidosnormales-1]->id)->first();
        //separandola el numero el mes y el año para realizar operacion
        $PNparafecha=explode("/", $utlimopedidonoral->numero);
        if ($PNparafecha[1]==date('m'))
        {
          $PNactual=$PNparafecha[0]+1;
          $PNnum=$PNactual."/".date('m/Y');
          
          }
          else
        {
          $PNnum="1/".date('m/Y');
        }       
      }
?>




<div class="modal fade" id="myModalPedidoNormal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Pedido de un producto que existe en inventario</h5>
                </div>
                <div class="modal-body">
                      
                        <form id="PNfrmcarrito" class="form-horizontal" autocomplete="off">
                         
                                <div id="divPNcodigo" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Codico interno: </label>
                                    <div class="col-sm-8">
                                      <input name="PNcodigo" id="PNcodigo"  type="text" class="form-control" placeholder="Codigo interno">                                    </div>
                                </div>
                                <div id="ctrlPNcodigo">
                                  
                               </div>
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Ubicación: </label>
                                    <div class="col-sm-8">
                                      <input  id="PNubicacion" disabled class="form-control" placeholder="PNubicacion">
                                       
                                    </div>
                                </div>                     
                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Unidad de medida: </label>
                                  <div class="col-sm-8">
                                    <input id="PNmedida" class="form-control" disabled placeholder="Unidad de medida ej: kilos, tubo" name="PNmedida">
                                     
                                  </div>
                                </div>
                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Descripcion: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNdescripcion" disabled name="PNdescripcion" class="form-control" placeholder="Descricion del producto">
                                    </div>
                                </div>
                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Precio Unitario: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNpreciounitario" disabled name="PNprecio"  class="form-control decimales" placeholder="Precio por unidad">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cuenta: </label>
                                    <div class="col-sm-8">
                                         <input type="text" id="PNcuenta" disabled name="PNcuenta"  class="form-control decimales" placeholder="Cuenta a la que pertence el producto">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Existencias Actuales: </label>
                                    <div class="col-sm-8">
                                         <input type="text" readonly id="PNcantidadactual"class="form-control decimales" placeholder="Cuenta a la que pertence el producto">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cantidad a pedir:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNcantidad" name="PNcantidad" class="form-control numeros" placeholder="Cantidad entrante de productos">
                                    </div>
                                </div>

                           </form>                                   
                        <button id="PNbtnagregar"  class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                    
                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
        
</div>
     
<!---- SEGUNDO MODAL------>
<div class="modal fade" id="modalPNConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Confirmar Pedido</h5>
                </div>
                <div class="modal-body">

                   {{Form::open(array('url'=>'pedidonormal/crear','method'=>'post','class'=>'form-horizontal','autocomplete'=>'off', 'id'=>'PNfrmingresoconfirmar','target'=>'_blank'))}}
                               
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">de:</label>
                                    <div class="col-sm-8">
                                      <input list="ubicacion" id="PNde" class="form-control" placeholder="De" name="PNde">
                                    </div>
                                </div>    

                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Seccion: </label>
                                  <div class="col-sm-8">
                                    <input list="medida" id="PNseccion" class="form-control" placeholder="Para que secion" name="PNseccion">
                                  </div>
                                </div>

                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">al_almacen: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNal_almacen" name="PNal_almacen" class="form-control" placeholder="A que Almacen">
                                    </div>
                                </div>

                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Para uso:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNpara_uso" name="PNpara_uso"  class="form-control" placeholder="Donde se usan estos productos">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">solicitado por: </label>
                                    <div class="col-sm-8">
                                        
                                          <input type="text" id="PNpedido_por" name="PNpedido_por"  class="form-control" placeholder="Nombre del solicitante">
                                        
                                    </div>
                                </div>

                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del solicitante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNcargo_pedido_por" name="PNcargo_pedido_por" class="form-control" placeholder="Cargo del solicitante Ej: Ingeniero, Director, etc">
                                    </div>
                                </div>
                                
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Aprobado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNaprobado_por" name="PNaprobado_por" class="form-control" placeholder="Nombre del que aprueba">
                                    </div>
                                </div>

                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del aprobante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNcargo_aprobado_por" name="PNcargo_aprobado_por" class="form-control" placeholder="Cargo del aprobante Ej: Ingeniero, Director, etc">
                                    </div>
                                </div>

                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Autorizado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNautorizado_por" name="PNautorizado_por" class="form-control" placeholder="Nombre del que Autorizo esta compra">
                                    </div>
                                </div>
                                                           
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del Autorizante</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNcargo_autorizado_por" name="PNcargo_autorizado_por" class="form-control" placeholder="Cargo del que autorizo ej: Ingeniero, Director, etc">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Referencia:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PNreferencia" name="PNreferencia" class="form-control" placeholder="Cargo del que autorizo ej: Ingeniero, Director, etc">
                                    </div>
                                </div>

                                 <div id="divnick"class="form-group" style="opacity:0">
                                     <div class="col-sm-6">
                                      <input type="text" id="PNdatos" name="PNdatos" class="form-control" readonly>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                      <input type="text" id="PNvalor_total" name="PNvalor_total" class="form-control" readonly>
                                    </div>
                               </div>
                      
                              <div id="divnick"class="form-group">
                                  <div class="col-sm-12">
                                       <button type="submit"  id="PNfrmingresoconfirmar" class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
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
                            <i class="fa  fa-stack-overflow fa-fw"></i> Pedido Productos Existentes 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="list-group">
                                
                                <div class="table-responsive">
                                    <div class="btn-group">
                                        <button type="button" id="productobtn" class="btn btn-default"  data-toggle="modal" data-target="#myModalPedidoNormal">
                                           <i class="fa fa-plus fa-fw"></i> Agregar Productos
                                            
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPNConfirmar">
                                           <i class="fa fa-check fa-fw"></i> Confirmar Pedido (PEDIDO NORMAL) 
                                            
                                        </button>
                                         <button type="button" id="PNbtnborrar" class="btn btn-default">
                                          <i class="fa fa-times fa-fw"></i> Limpiar  
                                            
                                        </button>                                        
                                    </div>
                                    <div class="pull-right">
                                        <h3>N°: {{$PNnum}}</h3> 
                                    </div>
                                    <br><br>
                                <table class="table table-striped table-bordered table-hover" id="tablas">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Unidad medida</th>
                                            <th>DESCRIPNION</th>
                                            <th>Precio Unitario</th>
                                            <th>Valor Total</th>
                                            <th>Ubicación</th>
                                            <th>Codigo Interno</th>
                                            <th>Cuenta</th>
                                        </tr>
                                    </thead>
                                    
                                      <tbody id="PNcuerpo">
                                                                      
                                      </tbody>
                                     
                                    <tr>
                                            
                                            <td colspan="5"></td>
                                            <td id="PNvalortotal">0</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                     </tr>
                                </table>
                              </div>
                             
                            </div>
                            <!-- /.list-group -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                         
</div>

