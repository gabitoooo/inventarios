<!---PRIMER MODAL---->
<div class="modal fade" id="myModalIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Ingreso de Producto</h5>
                </div>
                <div class="modal-body">
                      
                        <form id="frmcarrito" class="form-horizontal" autocomplete="off">
                         
                                <div id="divcodigo" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label"> Codico interno: </label>
                                    <div class="col-sm-8">
                                      <input name="codigo" id="codigo"  type="text" class="form-control" placeholder="Codigo interno">                                    </div>
                                </div>
                                <div id="ctrlcodigo">
                                  
                               </div>
                                <div id="divapellidos" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Ubicación: </label>
                                    <div class="col-sm-8">
                                      <input  id="ubicacion" class="form-control" placeholder="Ubicación" name="ubicacion">
                                       
                                    </div>
                                </div>                     
                                <div id="divtelefono" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Unidad de medida: </label>
                                  <div class="col-sm-8">
                                    <input id="medida" class="form-control" placeholder="Unidad de medida ej: kilos, tubo" name="unidad">
                                     
                                  </div>
                                </div>
                                <div id="divdireccion" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Descripción: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción">
                                    </div>
                                </div>
                                <div id="divcarnet" class="form-group">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Precio Unitario: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="preciounitario" name="precio"  class="form-control decimales" placeholder="Precio por unidad">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cuenta: </label>
                                    <div class="col-sm-8">
                                        <select name="cuenta" id="cuenta" class="form-control">
                                          <option value="sdf">holas</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="divnick"class="form-group">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Cantidad</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="cantidad" name="cantidad" class="form-control numeros" placeholder="Cantidad entrante de productos">
                                    </div>
                                </div>

                           </form>                                   
                        <button id="btnagregar"  class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                    
                              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrrar</button>
                </div>
            </div>
        </div>
        
</div>
     
<!---- SEGUNDO MODAL------>
<div class="modal fade" id="modalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel"> <i class="fa fa-file-text-o fa-fw"></i>Nota Ingreso</h5>
                </div>
                <div class="modal-body">

                   {{Form::open(array('url'=>'encargado/notaingreso','method'=>'post','class'=>'form-horizontal','autocomplete'=>'off'))}}
                               
                                <div id="divapellidos" class="form-group has-warning has-feedback">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Al almacen de: </label>
                                    <div class="col-sm-8">
                                      <input list="ubicacion" id="al_almacen" class="form-control" placeholder="al almacen de" name="al_almacen_de">
                                    </div>
                                </div>                     
                                <div id="divtelefono" class="form-group has-warning has-feedback">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Procedente de: </label>
                                  <div class="col-sm-8">
                                    <input list="medida" id="procedente_de" class="form-control" placeholder="procedente de" name="procedente_de">
                                  </div>
                                </div>
                                <div id="divdireccion" class="form-group has-warning has-feedback">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Orden de compra: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="orden_compra" name="orden_compra" class="form-control" placeholder="Ej :234/02/2014">
                                    </div>
                                </div>
                                <div id="divcarnet" class="form-group has-warning has-feedback">
                                  <label for="inputEmail3" class="col-sm-4 control-label">Factura No: </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="no_factura" name="numero_factura"  class="form-control" placeholder="Numero de factura">
                                    </div>
                                </div>
                               
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Documento Respaldo: </label>
                                    <div class="col-sm-8">
                                        
                                          <input type="text" id="documento_respaldo" name="documento_respaldo"  class="form-control" placeholder="Documento Respaldo">
                                        
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Proveedor:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="proveedor" name="proveedor" class="form-control" placeholder="Nombre proveedor">
                                    </div>
                                </div>
                                
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Nit:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="nit" name="nit" class="form-control" placeholder="Nit">
                                    </div>
                                </div>

                               
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Entregado por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="entregado_por" name="entregado_por" class="form-control" placeholder="Entregado Por:">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Recivido Por:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="recivido_por" name="recivido_por" class="form-control" placeholder="Nombre del que recive">
                                    </div>
                                </div>
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Pedido de compra: </label>
                                    <div class="col-sm-8">
                                      
                                      
                                    </div>
                                </div>
                                <div id="divnick"class="form-group has-warning has-feedback">
                                  <label for="inputEmail3"  class="col-sm-4 control-label">Observaciones:</label>
                                    <div class="col-sm-8">
                                      <input type="text" id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones nota ingreso">
                                    </div>
                                </div>
                                 <div id="divnick"class="form-group has-warning has-feedback" style="opacity:0">
                                     <div class="col-sm-6">
                                      <input type="text" id="datos" name="datos" class="form-control" readonly>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                      <input type="text" id="valor_total" name="valor_total" class="form-control" readonly>
                                    </div>
                            

                                </div>
                      
                      <button type="submit"  id="btnconfirm" class="btn btn-lg btn-success btn-lg btn-block">Agregar</button>
                      
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
                            <i class="fa  fa-stack-overflow fa-fw"></i> Nota ingreso
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="list-group">
                                
                                <div class="table-responsive">
                                    <div class="btn-group">
                                        <button type="button" id="productobtn" class="btn btn-default"  data-toggle="modal" data-target="#myModalIngreso">
                                           <i class="fa fa-plus fa-fw"></i> Agregar Productos
                                            
                                        </button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalConfirmar">
                                           <i class="fa fa-check fa-fw"></i> Confirmar Pedido  
                                            
                                        </button>
                                         <button type="button" id="btnborrar" class="btn btn-default">
                                          <i class="fa fa-times fa-fw"></i> Limpiar  
                                            
                                        </button>                                        
                                    </div>
                                    <div class="pull-right">
                                        <h3>N°: </h3> 
                                    </div>
                                    <br><br>
                                <table class="table table-striped table-bordered table-hover" id="tablas">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Unidad medida</th>
                                            <th>DESCRIPCION</th>
                                            <th>Precio Unitario</th>
                                            <th>Valor Total</th>
                                            <th>Ubicación</th>
                                            <th>Codigo Interno</th>
                                            <th>Cuenta</th>
                                        </tr>
                                    </thead>
                                    
                                      <tbody id="cuerpo">
                                                                      
                                      </tbody>
                                     
                                    <tr>
                                            
                                            <td colspan="5"></td>
                                            <td id="valortotal">0</td>
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