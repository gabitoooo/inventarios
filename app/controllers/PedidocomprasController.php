<?php

class PedidocomprasController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function postCrear()
	{
			$datos=Input::get('PCdatos');
			
			$productos=explode("PCitem=",$datos);

			//registrando el ultimo pedido compra!!!!!!!!
			$pedidocompraactuales=Pedidocompra::where('nivel','=',Session::get('nivel'))->get();
			$num;
				
			if (count($pedidocompraactuales)==0)
			{
				$num="1/".date('m/Y');
				Pedidocompra::agregarPedidoCompra($num,Session::get('nivel'),Input::get('PCde'),Input::get('PCseccion'),Input::get('PCal_almacen'),Input::get('PCpara_uso'),Input::get('PCpedido_por'),Input::get('PCcargo_pedido_por'),Input::get('PCaprobado_por'),Input::get('PCcargo_aprobado_por'),Input::get('PCautorizado_por'),Input::get('PCcargo_autorizado_por'),Input::get('PCreferencia'));
		    }
			else
			{
				$totalcompras=count($pedidocompraactuales);
				$ultimacompra=Pedidocompra::where('id','=',$pedidocompraactuales[$totalcompras-1]->id)->first();
				//separandola el numero el mes y el año para realizar operacion
				$parafecha=explode("/", $ultimacompra->numero);
				if ($parafecha[1]==date('m'))
				{
					$actual=$parafecha[0]+1;
					$num=$actual."/".date('m/Y');
					Pedidocompra::agregarPedidoCompra($num,Session::get('nivel'),Input::get('PCde'),Input::get('PCseccion'),Input::get('PCal_almacen'),Input::get('PCpara_uso'),Input::get('PCpedido_por'),Input::get('PCcargo_pedido_por'),Input::get('PCaprobado_por'),Input::get('PCcargo_aprobado_por'),Input::get('PCautorizado_por'),Input::get('PCcargo_autorizado_por'),Input::get('PCreferencia'));
		    	}
		    	else
				{
					$num="1/".date('m/Y');
					Pedidocompra::agregarPedidoCompra($num,Session::get('nivel'),Input::get('PCde'),Input::get('PCseccion'),Input::get('PCal_almacen'),Input::get('PCpara_uso'),Input::get('PCpedido_por'),Input::get('PCcargo_pedido_por'),Input::get('PCaprobado_por'),Input::get('PCcargo_aprobado_por'),Input::get('PCautorizado_por'),Input::get('PCcargo_autorizado_por'),Input::get('PCreferencia'));
				}
			}
			//fin registrar pedido compra
			
			//recuperando el pedido compra actual
			$pedidocompra=Pedidocompra::where('numero','=',$num)->where('nivel','=',Session::get('nivel'))->first();

			//registradon los productos del pedido dependiendo del tipo de producto que sea
			for ($i=1; $i < count($productos)  ; $i++) { 
				$tipoproducto=Pedidocompra::separar("PCtipoproduct",$productos[$i]);
				$cantidad=Pedidocompra::separar("PCcantidad",$productos[$i]);
				if ($tipoproducto=="existente")
				{
					$codigo=Pedidocompra::separar("PCcodigo",$productos[$i]);
					$p=Producto::where('codigo_interno','=',$codigo)->first();
					Pedidocompra::compraProductoExistente($pedidocompra->id,$p->id,$cantidad);

				}
				else
				{
					$unidad=Pedidocompra::separar("PCmedida",$productos[$i]);
					$numero_interno=Pedidocompra::separar("PCnumero_interno",$productos[$i]);
					$descripcion=Pedidocompra::separar("PCdescripcion",$productos[$i]);
					Pedidocompra::compraProductoNuevo($pedidocompra->id,$descripcion,$unidad,$numero_interno,$cantidad);
				}
    		}

//recogiendo datos para el pdf
    		$da;

    		$pecomexist=Pedidocompraproducto::where('pedidocompra_id','=',$pedidocompra->id)->get();
    		$pnoexist=Pedidocompra::find($pedidocompra->id)->productosnuevos;
    		if (count($pecomexist)>0 && count($pnoexist)>0)
    		{
    		  		$i=0;
    		  		foreach ($pecomexist as $pe) {
    		  			$pro=Producto::find($pe->producto_id);
    		  			$da[$i]=array("cantidad"=>$pe->cantidad,"unidad"=>$pro->unidad,"detalle"=>$pro->descripcion,"codigo"=>$pro->codigo_interno,"num_interno"=>" ","ubicacion"=>$pro->ubicacion);
    		  			$i++;
    		  		}
    		  		foreach ($pnoexist as $pn)
    		  		{
    		  			$da[$i]=array("cantidad"=>$pn->cantidad,"unidad"=>$pn->unidad,"detalle"=>$pn->descripcion,"codigo"=>" ","num_interno"=>$pn->numero_interno,"ubicacion"=>" ");
    		  			$i++;
    		  		}

    		}
    		else
    		{
    			if (count($pecomexist)>0)
    			{
    				$i=0;
    		  		foreach ($pecomexist as $pe) {
    		  			$pro=Producto::find($pe->producto_id);
    		  			$da[$i]=array("cantidad"=>$pe->cantidad,"unidad"=>$pro->unidad,"detalle"=>$pro->descripcion,"codigo"=>$pro->codigo_interno,"num_interno"=>" ","ubicacion"=>$pro->ubicacion);
    		  			$i++;
    		  		}
    			}
    			if (count($pnoexist)>0) {
    				
    				$i=0;
    				foreach ($pnoexist as $pn) {
    				$da[$i]=array("cantidad"=>$pn->cantidad,"unidad"=>$pn->unidad,"detalle"=>$pn->descripcion,"codigo"=>" ","num_interno"=>$pn->numero_interno,"ubicacion"=>" ");
    		  		$i++;
    		  		}
    			}
    		}



    		$pdf = App::make('dompdf');
			$pagina = View::make('imprimibles.nota_pedido_compra')->with("datos",$da)->with("pedidocompra",$pedidocompra);
			$pdf->loadHTML($pagina)->setPaper('letter')->setOrientation('landscape')->setWarnings(false);
			return $pdf->stream();
   		
	}

	public function getRecuperarproducto($codigo)
	{
		if (Request::ajax())
		{
			$producto=Producto::where('codigo_interno','=',$codigo)->first();	
			if ($producto)
			{
				$datos["estado"] = 1;
				$datos["descripcion"]=$producto->descripcion;
				$datos["ubicacion"]=$producto->ubicacion;
				$datos["unidad"]=$producto->unidad;
				$datos["precio"]=$producto->precio;
				echo json_encode($datos);
			}
			else
			{
				$datos["estado"]=2;
				echo json_encode($datos);
			}

		}
	}


}
