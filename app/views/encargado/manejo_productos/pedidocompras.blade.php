<?php
    $PCnum;
        $pedidocomprasactuales=Pedidocompra::where('nivel','=',Session::get('nivel'))->get();
      if (count($pedidocomprasactuales)==0)
      {
        $PCnum="1/".date('m/Y');        
        }
      else
      {
        $totapedidocompras=count($pedidocomprasactuales);
        $utlimopedidocompra=Pedidocompra::where('id','=',$pedidocomprasactuales[$totapedidocompras-1]->id)->first();
        //separandola el numero el mes y el año para realizar operacion
        $parafecha=explode("/", $utlimopedidocompra->numero);
        if ($parafecha[1]==date('m'))
        {
          $actual=$parafecha[0]+1;
          $PCnum=$actual."/".date('m/Y');
          
          }
          else
        {
          $PCnum="1/".date('m/Y');
        }       
      }
?>
<!---PRIMER MODAL---->
<div class="modal fade" id="myModalPedidocompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-shopping-cart fa-fw"></i>Agregar a carrito de compra</h5>
                </div>
                <div class="modal-body">
                      
                        <form id="PCfrmcarrito" class="form-horizontal" autocomplete="off">                        
                                 <div class="form-group">
                                           <label class="col-sm-4 control-label">Producto existente:</label>
                                              <div class="col-sm-1">
                                                <input type="radio" class="form-control" name="opciones" id="PCexiste" value="existe" checked>
                                              </div>                           
                                          <label class="col-sm-5 control-label"> Nuevo producto:</label>
                                          <div class="col-sm-1">
                                              <input type="radio" class="form-control" name="opciones" id="PCnuevo" value="nuevo">
                                          </div>
                                       
                                </div>
                               <div id="divPCcodigo" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Codico interno: </label>
                                    <div class="col-sm-8">
                                      <input name="codigo" id="PCcodigo" type="text" class="form-control" placeholder="Codigo interno">
                                    </div>
                                   <div id="ctrlPCcodigo">
                                      
                                   </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Numero interno (opcional):</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCnumero_interno" disabled name="numero_interno" class="form-control " placeholder="Numero interno">
                                    </div>
                                </div>
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Ubicación:</label>
                                    <div class="col-sm-8">
                                      <input  id="PCubicacion" disabled class="form-control" placeholder="Ubicación" name="ubicacion">
                                    </div>
                                </div>                     
                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Unidad de medida: </label>
                                  <div class="col-sm-8">
                                    <input id="PCmedida" class="form-control" disabled placeholder="Unidad de medida ej: kilos, tubo" name="unidad">
                                     
                                  </div>
                                </div>
                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Articulo:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCdescripcion" disabled name="descripcion" class="form-control" placeholder="Descripción">
                                    </div>
                                </div>
                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Precio unitario Actual en inventario: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCprecioactual" disabled name="precioactual"  class="form-control decimales" placeholder="Precio por unidad">
                                    </div>
                                </div>                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cantidad a comprar:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCcantidad"  name="cantidad" class="form-control numeros" placeholder="Cantidad entrante de productos">
                                    </div>
                                </div>

                           </form>                                   
                        <button id="PCbtnagregar"  class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                    
                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
        
</div>
     
<!---- SEGUNDO MODAL------>
<div class="modal fade" id="modalPCConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Confirmar Pedido Para Realizar Compra</h5>
                </div>
                <div class="modal-body">

                   {{Form::open(array('url'=>'pedidocompra/crear','method'=>'post','class'=>'form-horizontal','autocomplete'=>'off', 'id'=>'PCfrmingresoconfirmar','target'=>'_blank'))}}
                               
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">de:</label>
                                    <div class="col-sm-8">
                                      <input list="ubicacion" id="PCde" class="form-control" placeholder="De" name="PCde">
                                    </div>
                                </div>    

                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Seccion: </label>
                                  <div class="col-sm-8">
                                    <input list="medida" id="PCseccion" class="form-control" placeholder="Para que secion" name="PCseccion">
                                  </div>
                                </div>

                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">al_almacen: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCal_almacen" name="PCal_almacen" class="form-control" placeholder="A que Almacen">
                                    </div>
                                </div>

                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Para uso:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCpara_uso" name="PCpara_uso"  class="form-control" placeholder="Donde se usan estos productos">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">solicitado por: </label>
                                    <div class="col-sm-8">
                                        
                                          <input type="text" id="PCpedido_por" name="PCpedido_por"  class="form-control" placeholder="Nombre del solicitante">
                                        
                                    </div>
                                </div>

                                 <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del solicitante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCcargo_pedido_por" name="PCcargo_pedido_por" class="form-control" placeholder="Cargo del solicitante Ej: Ingeniero, Director, etc">
                                    </div>
                                </div>
                                
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Aprobado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCaprobado_por" name="PCaprobado_por" class="form-control" placeholder="Nombre del que aprueba">
                                    </div>
                                </div>

                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del aprobante:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCcargo_aprobado_por" name="PCcargo_aprobado_por" class="form-control" placeholder="Cargo del aprobante Ej: Ingeniero, Director, etc">
                                    </div>
                                </div>

                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Autorizado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCautorizado_por" name="PCautorizado_por" class="form-control" placeholder="Nombre del que Autorizo esta compra">
                                    </div>
                                </div>
                                                           
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cargo del Autorizante</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCcargo_autorizado_por" name="PCcargo_autorizado_por" class="form-control" placeholder="Cargo del que autorizo ej: Ingeniero, Director, etc">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Referencia:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="PCreferencia" name="PCreferencia" class="form-control" placeholder="Cargo del que autorizo ej: Ingeniero, Director, etc">
                                    </div>
                                </div>

                                 <div id="divnick"class="form-group" style="opacity:0">
                                     <div class="col-sm-6">
                                      <input type="text" id="PCdatos" name="PCdatos" class="form-control" readonly>
                                    </div>
                                                            
                               </div>
                      
                              <div id="divnick"class="form-group">
                                  <div class="col-sm-12">
                                       <button type="submit"  id="PCfrmingresoconfirmar" class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
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
                            <i class="fa  fa-shopping-cart  fa-fw"></i> Pedido de Compras
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="list-group">
                                
                                <div class="table-responsive">
                                    <div class="btn-group">
                                        <button type="button" id="productobtn" class="btn btn-default"  data-toggle="modal" data-target="#myModalPedidocompra">
                                           <i class="fa fa-plus fa-fw"></i> Agregar Productos
                                            
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPCConfirmar">
                                           <i class="fa fa-check fa-fw"></i> Confirmar Compra (PEDIDO COMPRA)  
                                            
                                        </button>
                                         <button type="button" id="PCbtnborrar" class="btn btn-default">
                                          <i class="fa fa-times fa-fw"></i> Limpiar  
                                            
                                        </button>                                        
                                    </div>
                                    <div class="pull-right">
                                        <h3>N°: {{$PCnum}}</h3> 
                                    </div>
                                    <br><br>
                                <table class="table table-striped table-bordered table-hover" id="tablas">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Unidad</th>
                                            <th>Articulo</th>
                                            <th>Ubicación</th>
                                            <th>Codigo</th>
                                            <th>Numero interno</th>
                                            <th>Tipo de producto</th>
                                      
                                        </tr>
                                    </thead>
                                    
                                      <tbody id="PCcuerpo">
                                                                      
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


