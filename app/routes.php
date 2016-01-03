<?php
Route::get('/','LoginController@index');
Route::post('controlaringreso','LoginController@ingreso');
Route::controller('l','UserController');
Route::get('iniciales',function(){
	$p=new Persona;
	$p->nombres='angel';
	$p->apellidos='llanque';
	$p->ci='8632086';
	$p->telefono=72375141;
	$p->direccion='Av. periferica/C. meguillanes';
	$p->save();
	$u=new User;
	$u->username='angel';
	$u->password=Hash::make('123');
	$u->encry=Crypt::encrypt('123');
	$u->nivel=1;
	$u->email='rugratsmylo@gmail.com';
	$u->persona_id=1;
	$u->save();
	
	$cuenta=new Cuenta;
	$cuenta->numero_cuenta=11301001;
	$cuenta->nombre_cuenta='MATERIAL DE ESCRITORIO';
	$cuenta->save();

	$cuenta=new Cuenta;
	$cuenta->numero_cuenta=11301003;
	$cuenta->nombre_cuenta='REPUESTOS';
	$cuenta->save();

	$cuenta=new Cuenta;
	$cuenta->numero_cuenta=11301004;
	$cuenta->nombre_cuenta='COMBUSTIBLES LIBRICANTES Y QUIMICOS';
	$cuenta->save();	
	echo "correcto esta";
});

Route::get('cerrar',function(){
	Session::flush();
	return Redirect::to('/');
});




Route::group(array('before'=>'encargados'),function(){
	Route::controller('encargado','EncargadoController');
	Route::controller('ingreso','IngresosController');
	Route::controller('pedidocompra','PedidocomprasController');
	Route::controller('pedidonormal','PedidonormalController');
	Route::controller('egreso','EgresosController');
	Route::controller('remision','NotaremisionController');
});







Route::get('prueba',function(){
	echo DNS2D::getBarcodePNGPath("gabriel martinez", "QRCODE",20,20);
});
Route::get('d',function()
{
	 echo Ingreso::cambiarfecha();
});
////////para historiales///////
Route::get('historialingresos/{gestion}/{codigo}',function($gestion,$codigo){
		$gestion=$gestion;
		$codigoproducto=$codigo;


		$gestioninicio=$gestion."-01-0";
		$gestionfinal=$gestion."-12-32";
		$p=Producto::where('codigo_interno','=',$codigoproducto)->first();
		//var_dump($p->codigo_interno);
		$ingresos=Ingresoproducto::where('producto_id','=',$p->id)->where('fecha','>',$gestioninicio)->where('fecha','<',$gestionfinal)->get();		
		//var_dump($ingresos);
		foreach ($ingresos as $key) {
			$ni=Ingreso::where('id','=',$key->ingreso_id)->first();
			$preciototal=$key->cantidad*$key->precio;
			echo "fecha ingreso: ".$key->fecha." cantidad ingreso: ".$key->cantidad."precio :".$key->precio." Precio total".$preciototal." nota ingreso:".$ni->numero." procedente de:".$ni->proveedor.'<br>';
		}
		//echo "holas";
	
});
Route::get('pdfNI',function(){
	$pdf = App::make('dompdf');
	$pagina = View::make('encargado.manejo_productos.nota_ingreso');
	$pdf->loadHTML($pagina)->setPaper('Letter')->setWarnings(false);
	return $pdf->stream();
});
Route::get('pdfAP',function(){
	$pdf=App::make('dompdf');
	$pagina=View::make('encargado.manejo_productos.nota_pedido');
	$pdf->loadHTML($pagina)->setPaper('Letter')->setWarnings(false)->setOrientation('landscape');
	return $pdf->stream();
});
Route::get('pdf',function(){
	$pdf = App::make('dompdf');
	$pagina = View::make('encargado.manejo_productos.pedidos');
	$pdf->loadHTML($pagina)->setPaper('letter')->setOrientation('landscape')->setWarnings(false);
	return $pdf->stream();
});
Route::group(array('before'=>'admis'),function(){
	Route::controller('admi','AdminController');
	Route::post('agregar','AdminController@Create');
	Route::get('delete/{id}','AdminController@Eliminar');
	Route::post('actualizar','AdminController@Actualizar');
});
Route::group(array('before'=>'cardexs'),function(){
	Route::controller('cardex','CardexController');
	Route::post('agreufv','CardexController@Crear');
	Route::any('editarufv/{id}','CardexController@editar');
	Route::post('agre_ufv','CardexController@actualizar');
	/*Route::any('editarufv/{id}', function(){
		echo "holas";
	});*/
});
Route::group(array('before'=>'perfils'),function(){
	Route::controller('perfil','PerfilController');
	Route::get('verperfil','PerfilController@Verperfil');
	Route::get('cambiar','PerfilController@Cambiar');
	Route::post('recuperar','PerfilController@Recuperar');
	Route::post('reset','PerfilController@Reseteo');
	/*Route::any('cambiar', function(){
		echo "holas";
	});*/
});
Route::post('editarcuenta/{id}','EditcuentaController@editar');
/*Route::any('editar_cuenta/{id}', function(){
	echo "holas";
});*/

Route::any('editar/{id}','EdituserController@editar');

Route::get('cerrar',function(){
	Session::flush();
	return Redirect::to('/');
});
Route::group(array('before'=>'emails'),function(){
	Route::controller('email','EmailController');
	Route::post('mandar','EmailController@contacto');
});








Route::get('fecha',function()
{
	$fechas_nacimiento = array(
    array(
        'nombre' => 'Paco',
        'fecha'  => '2012-01-11'
    ),
    array(
        'nombre' => 'Luis',
        'fecha'  => '2012-02-12'
    ),
    array(
        'nombre' => 'Mar&iacute;a',
        'fecha'  => '2013-04-5'
    ),
    array(
        'nombre' => 'gaby',
        'fecha'  => '2010-11-29'
    )
	);
	 
	function ordenar( $a, $b ) {
	    return strtotime($a['fecha']) - strtotime($b['fecha']);
	}
	 
	function mostrar_array($datos) {
		foreach($datos as $dato) 
			echo "{$dato['fecha']} -&gt; {$dato['nombre']}<br/>";
	}
	 
	 
	usort($fechas_nacimiento, 'ordenar');
	 
	mostrar_array($fechas_nacimiento);
});


Route::get("gg",function(){
	 $uf=Ufv::where('gestion','=',date('Y'))->first();
	 var_dump($uf);
});




////////////////////PETICIONES PARA APP/////////////////////////////////////////
Route::get('productoPorId/{codigo}',function($codigo)
{
	$producto=Producto::where('codigo_interno','=',$codigo)->first();
	$cuenta=Producto::find($producto->id)->cuenta;
	//echo $cuenta->nombre_cuenta;
 	$p=array("codigo"=>$producto->codigo_interno,"ubicacion"=>$producto->ubicacion,"descripcion"=>$producto->descripcion,"unidad"=>$producto->unidad,"cuenta"=>$cuenta->nombre_cuenta,"precio"=>$producto->precio,"existencias"=>$producto->existencias);

	if ($p) {

	            $dato["estado"] = "1";
	            $dato["product"] = $p;
	            // Enviar objeto json de la meta
	            echo json_encode($dato);
	        }
	 else {
	            // Enviar respuesta de error general
	            echo json_encode(
	                array(
	                    'estado' => '2',
	                    'mensaje' => 'No se obtuvo el registro'
	                )
	            );
	        }
 	
});

Route::get('ingresosProducto/{codigo}/{gestion}',function($codigo,$gestion)
{
				$gestioninicio=$gestion."-01-0";
				$gestionfinal=$gestion."-12-32";
				$p=Producto::where('codigo_interno','=',$codigo)->first();
				if ($p==null) {
					$datos["estado"]=3;
					$datos["mensaje"]="el producto no esta registrado en inventarios";
					echo json_encode($datos);
				}
				else{
					$ingresos=Ingresoproducto::where('producto_id','=',$p->id)->where('fecha','>',$gestioninicio)->where('fecha','<',$gestionfinal)->get();		
					$i=0;
					$ing_total;
					foreach ($ingresos as $key) {
						$ni=Ingreso::where('id','=',$key->ingreso_id)->first();
						$preciototal=$key->cantidad*$key->precio;

						$ing_total[$i]=array("fecha"=>$key->fecha,"ni"=>$ni->numero,"procedencia"=>$ni->proveedor,"costo"=>$key->precio,"cantidad"=>$key->cantidad,"importe"=>$preciototal);
						
						$i++;
					}
					if (count($ing_total)>0) {
						$datos["estado"]=1;
						$datos["ingresos"]=$ing_total;
						echo json_encode($datos);
					}
					else
					{
						$datos["estado"]=2;
						$datos["mensaje"]="no hay ingresos";
						echo json_encode($datos);
					}
					
				}
});
Route::get('egresosProducto/{codigo}/{gestion}',function($codigo,$gestion)
{
					$gestioninicio=$gestion."-01-0";
					$gestionfinal=$gestion."-12-32";
					$p=Producto::where('codigo_interno','=',$codigo)->first();
					if ($p==null) {
						$datos["estado"]=3;
						$datos["mensaje"]="el producto no esta registrado en inventarios";
						echo json_encode($datos);
					}
					else{
						$egresos=Egresoproducto::where('producto_id','=',$p->id)->where('fecha','>',$gestioninicio)->where('fecha','<',$gestionfinal)->get();		
						$i=0;
						foreach ($egresos as $key) {
							$ni=Egreso::where('id','=',$key->egreso_id)->first();
							$preciototal=$key->cantidad*$key->precio;
							$egre_total[$i]=array('fecha'=>$key->fecha,'unidad'=>$key->unidad_uso,'destino'=>$ni->para_uso_en,'can_egreso'=>$key->cantidad,'precio'=>$key->precio,'saldo'=>$p->existencias,'nota'=>$ni->numero);
							//echo "fecha ingreso: ".$key->fecha."Referencia: ".$key->unidad_uso." destino a: ".$ni->para_uso_en." cantidad egreso: ".$key->cantidad." precio : ".$key->precio." saldo catidad".$p->existencias." nota de egreso:".$ni->numero.'<br>';
							$i++;
						}
						if (count($egre_total)>0) {
							$datos["estado"]=1;
							$datos["egresos"]=$egre_total;
							echo json_encode($datos);
						}
						else{
							$datos["estado"]=2;
							$datos["mensaje"]="no hay egresos";
							echo json_encode($datos);
						}
					}
});