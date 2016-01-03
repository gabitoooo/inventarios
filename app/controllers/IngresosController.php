<?php

class IngresosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

    public function postCrear()
	{
			
			$datos=Input::get('datos');
			$productos=explode("item=",$datos);

			//registrando el ingreso !!!!!!!
			$ingresosactuales=Ingreso::where('nivel','=',Session::get('nivel'))->get();
			$num;
			//selecionanado el pedidocomrpa
			$pedidocompra=Pedidocompra::where('numero','=',Input::get('numero_pedido'))->where('nivel','=',Session::get('nivel'))->first();
			$pedidocompra->confirmado_ingreso=true;
			$pedidocompra->save();
			
			if (count($ingresosactuales)==0)
			{
				$num="1/".date('m/Y');
				Ingreso::agregaringreso($num,Ingreso::cambiarfecha(),Session::get('nivel'),Input::get('al_almacen'),Input::get('procedente_de'),Input::get('numero_factura'),Input::get('proveedor'),Input::get('documento_respaldo'),Input::get('nit'),Input::get('valor_total'),Input::get('valor_total'),Input::get('entregado_por'),Input::get('recivido_por'),Input::get('observaciones'),Input::get('orden_compra'),$pedidocompra->id);
		    }
			else
			{
				$totalingresos=count($ingresosactuales);
				$utlimoingreso=Ingreso::where('id','=',$ingresosactuales[$totalingresos-1]->id)->first();
				//separandola el numero el mes y el año para realizar operacion
				$parafecha=explode("/", $utlimoingreso->numero);
				if ($parafecha[1]==date('m'))
				{
					$actual=$parafecha[0]+1;
					$num=$actual."/".date('m/Y');
					Ingreso::agregaringreso($num,Ingreso::cambiarfecha(),Session::get('nivel'),Input::get('al_almacen'),Input::get('procedente_de'),Input::get('numero_factura'),Input::get('proveedor'),Input::get('documento_respaldo'),Input::get('nit'),Input::get('valor_total'),Input::get('valor_total'),Input::get('entregado_por'),Input::get('recivido_por'),Input::get('observaciones'),Input::get('orden_compra'),$pedidocompra->id);
		    	}
		    	else
				{
					$num="1/".date('m/Y');
					Ingreso::agregaringreso($num,Ingreso::cambiarfecha(),Session::get('nivel'),Input::get('al_almacen'),Input::get('procedente_de'),Input::get('numero_factura'),Input::get('proveedor'),Input::get('documento_respaldo'),Input::get('nit'),Input::get('valor_total'),Input::get('valor_total'),Input::get('entregado_por'),Input::get('recivido_por'),Input::get('observaciones'),Input::get('orden_compra'),$pedidocompra->id);
				}
			}
			//fin registrar ingreso
			
			//recuperando el ingreso actual
			$ingreso=Ingreso::where('numero','=',$num)->where('nivel','=',Session::get('nivel'))->first();

			//registradon los productos por filas
			for ($i=1; $i < count($productos)  ; $i++) { 

				$medida=Ingreso::separar("medida",$productos[$i]);		
				$descripcion=Ingreso::separar("descripcion",$productos[$i]);		
				$precio=Ingreso::separar("precio",$productos[$i]);
				$ubicacion=Ingreso::separar("ubicacion",$productos[$i]);
				$codigo=Ingreso::separar("codigo",$productos[$i]);
				$cuenta=Ingreso::separar("cuenta",$productos[$i]);
				$cantidad=Ingreso::separar("cantidad",$productos[$i]);
				$product=Producto::where('codigo_interno','=',$codigo)->first();
		    	Ingreso::ingresandoproducto($codigo,$descripcion,$cuenta,$ubicacion,$medida,$cantidad,$precio,$ingreso->id);
		    		
			}
			
//recogiendo datos para el podf
			$ing_pro=Ingresoproducto::where('ingreso_id','=',$ingreso->id)->get();
			$i=0;
			foreach ($ing_pro as $in)
			{
				$prod=Producto::find($in->producto_id);
				$total=$in->precio*$in->cantidad;
				$data[$i]=array("codigo"=>$prod->codigo_interno,"cantidad"=>$in->cantidad,"unidad"=>$prod->unidad,"descripcion"=>$prod->descripcion,"precio"=>$in->precio,"total"=>$total);
				$i++;
			}
			$pdf = App::make('dompdf');
			$pagina = View::make('imprimibles.nota_ingreso')->with("datos",$data)->with("ingreso",$ingreso);
			$pdf->loadHTML($pagina)->setPaper('letter')->setOrientation('landscape')->setWarnings(false);
			return $pdf->stream();
			//return View::make('imprimibles.nota_ingreso')->with("datos",$data)->with("ingreso",$ingreso);


	}


	///validaciones
	public function getRecuperarproducto($codigo)
	{
		if (Request::ajax())
		{
			$producto=Producto::where('codigo_interno','=',$codigo)->first();	
			if ($producto)
			{
				$cuenta=Producto::find($producto->id)->cuenta;
				$datos["estado"] = 1;
				$datos["descripcion"]=$producto->descripcion;
				$datos["ubicacion"]=$producto->ubicacion;
				$datos["cuenta"]=$cuenta->nombre_cuenta;
				$datos["unidad"]=$producto->unidad;	
				echo json_encode($datos);
			}
			else
			{
				$c=Cuenta::all();
				$datos["estado"]=2;
				$datos["cuentas"]=$c;	
				echo json_encode($datos);
			}

		}
	}

	////////////////////funciones extras para funcionamiento////////////////////////////
}