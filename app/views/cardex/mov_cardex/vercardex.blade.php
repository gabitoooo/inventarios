<br>
<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        {{Form::open(array('url'=>'cardex/verhistorial','method'=>'post'))}}
            <div class="form-group">
                <label class="col-sm-1 control-label">Codigo:</label>
                <div class="col-sm-3">
                    <input  type="text" id="codigo" class="form-control" name="codigo" placeholder="Codigo Interno" value="">
                </div>
                <label class="col-sm-1 control-label">Gestion:</label>
                <div class="col-sm-2">
                    <input type="text" name="gestion">
                </div>

                <div class="col-sm-3">
                    <select class="form-control" name="tipo">
                        <option>Ingresos del Producto</option>
                        <option>Egresos del Producto</option>   
                    </select>
                </div>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-default">Ver movimiento</button>   
                </div>
            </div>
          {{Form::close()}}
        
    </div>
     @if($status == 'ok_ingreso')
        <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="15%"><p class="text-center">FECHA</p></th>
                                    <th width="15%"><p class="text-center">N. INGRESO</p></th>
                                    <th width="20%"><p class="text-center">PROCEDENCIA</p></th>
                                    <th width="15%"><p class="text-center">COSTO /u</p></th>
                                    <th width="10%"><p class="text-center">CANTIDAD</p></th>
                                    <th width="15"><p class="text-center">IMPORTE</p></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php $ing_total=Session::get('ing_total');?>
                                @foreach($ing_total as $ingre)
                                    <tr>
                                        <td class="text-center">{{$ingre["fecha"]}}</td>
                                        <td class="text-center">{{$ingre["ni"]}}</td>
                                        <td class="text-center">{{$ingre["procedencia"]}}</td>
                                        <td class="text-center">{{$ingre["costo"]}}</td>
                                        <td class="text-center">{{$ingre["cantidad"]}}</td>
                                        <td class="text-center">{{$ingre["importe"]}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($status == 'ok_egreso')
        <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="15%"><p class="text-center">FECHA</p></th>
                                    <th width="15%"><p class="text-center">REF</p></th>
                                    <th width="10%"><p class="text-center">N/Egreso</p></th>
                                    <th width="20%"><p class="text-center">DESTINO</p></th>
                                    <th width="15%"><p class="text-center">CANTIDAD</p></th>
                                    <th width="10%"><p class="text-center">PRECIO/u</p></th>
                                    <th width="15"><p class="text-center">TOTAL</p></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php $egre_total=Session::get('egre_total');?>
                                @foreach($egre_total as $ingre)
                                    <tr>
                                        <td class="text-center">{{$ingre["fecha"]}}</td>
                                        <td class="text-center">{{$ingre["unidad"]}}</td>
                                        <td class="text-center">{{$ingre["nota"]}}</td>
                                        <td class="text-center">{{$ingre["destino"]}}</td>
                                        <td class="text-center">{{$ingre["can_egreso"]}}</td>
                                        <td class="text-center">{{$ingre["precio"]}}</td>
                                        <td class="text-center">{{$ingre["saldo"]}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


