<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <?php
    $pproducts=Producto::all();
    $uf=Ufv::where('gestion','=',date('Y'))->first();
?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th colspan="" rowspan="2" headers="" scope=""><p class="text-center">CODIGO N° INTERNO</p></th>
                                <th colspan="" rowspan="2" headers="" scope=""><p class="text-center">UBICACION</p></th>
                                <th colspan="" rowspan="2" headers="" scope=""><p class="text-center">UNIDAD DE MEDIDA</p></th>
                                <th colspan="" rowspan="2" headers="" scope=""><p class="text-center">DESCRIPCION</p></th>
                                <th colspan="" rowspan="" headers="" scope=""><p class="text-center">SALDO FISICO</p></th>
                                <th colspan="4" rowspan="" headers="" scope=""><p class="text-center">SALDO VALORADO</p></th>
                            </tr>
                            <tr>
                                <th colspan="" rowspan="" headers="" scope="">Segun Inventario</th>
                                <th colspan="" rowspan="" headers="" scope="">Precio Unitario</th>
                                <th colspan="" rowspan="" headers="" scope="">Segun Inventario</th>
                                <th colspan="" rowspan="" headers="" scope="">Incremento Actualizado</th>
                                <th colspan="" rowspan="" headers="" scope="">Inventario Activo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pproducts as $p)
                            <tr>
                                <td>{{$p->codigo_interno}}</td>
                                <td>{{$p->ubicacion}}</td>
                                <td>{{$p->unidad}}</td>
                                <td>{{$p->descripcion}}</td>
                                <td>{{$p->existencias}}</td>
                                <td>{{$p->precio}}</td>
                                <?php $totalseguninventario=$p->existencias*$p->precio;
                                     $inactu=$p->precio*($uf->cotizacion/100);
                                     $invacti=$totalseguninventario*$inactu;
                                 ?>
                                <td>{{$totalseguninventario}}</td>
                                
                                <td>{{$inactu}}</td>
                                <td>{{$invacti}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>