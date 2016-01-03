<?php

class PedidonormalController extends BaseController {

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
			$datos=Input::get('PNdatos');
			
			$productos=explode("PNitem=",$datos);

			//registrando el ultimo pedido compra!!!!!!!!
			$pedidosactuales=Pedido::where('nivel','=',Session::get('nivel'))->get();
			$num;
				
			if (count($pedidosactuales)==0)
			{
				$num="1/".date('m/Y');
				Pedido::agregarPedido($num,Session::get('nivel'),Input::get('PNde'),Input::get('PNseccion'),Input::get('PNal_almacen'),Input::get('PNpara_uso'),Input::get('PNpedido_por'),Input::get('PNcargo_pedido_por'),Input::get('PNaprobado_por'),Input::get('PNcargo_aprobado_por'),Input::get('PNautorizado_por'),Input::get('PNcargo_autorizado_por'),Input::get('PNreferencia'));
		    }
			else
			{
				$totalpedidos=count($pedidosactuales);
				$ultimopedido=Pedido::where('id','=',$pedidosactuales[$totalpedidos-1]->id)->first();
				//separandola el numero el mes y el año para realizar operacion
				$parafecha=explode("/", $ultimopedido->numero);
				if ($parafecha[1]==date('m'))
				{
					$actual=$parafecha[0]+1;
					$num=$actual."/".date('m/Y');
					Pedido::agregarPedido($num,Session::get('nivel'),Input::get('PNde'),Input::get('PNseccion'),Input::get('PNal_almacen'),Input::get('PNpara_uso'),Input::get('PNpedido_por'),Input::get('PNcargo_pedido_por'),Input::get('PNaprobado_por'),Input::get('PNcargo_aprobado_por'),Input::get('PNautorizado_por'),Input::get('PNcargo_autorizado_por'),Input::get('PNreferencia'));
		    	}
		    	else
				{
					$num="1/".date('m/Y');
					Pedido::agregarPedido($num,Session::get('nivel'),Input::get('PNde'),Input::get('PNseccion'),Input::get('PNal_almacen'),Input::get('PNpara_uso'),Input::get('PNpedido_por'),Input::get('PNcargo_pedido_por'),Input::get('PNaprobado_por'),Input::get('PNcargo_aprobado_por'),Input::get('PNautorizado_por'),Input::get('PNcargo_autorizado_por'),Input::get('PNreferencia'));
				}
			}
			//fin registrar pedido compra
			
			//recuperando el pedido compra actual
			$pedido=Pedido::where('numero','=',$num)->where('nivel','=',Session::get('nivel'))->first();

			//registradon los productos del pedido dependiendo del tipo de producto que sea
			for ($i=1; $i < count($productos)  ; $i++) { 
				$cantidad=Pedidocompra::separar("PNcantidad",$productos[$i]);
				$codigo=Pedidocompra::separar("PNcodigo",$productos[$i]);
				$p=Producto::where('codigo_interno','=',$codigo)->first();
				Pedido::pedidoproducto($pedido->id,$p->id,$cantidad);
	   		}
	   		

	   		//seleccionando productos del pedido
	   		$pedprod=pedidoproducto::where('pedido_id','=',$pedido->id)->get();
	   		$i=0;
    		foreach ($pedprod as $pe) {
    		  	$pro=Producto::find($pe->producto_id);
    		  	$da[$i]=array("cantidad"=>$pe->cantidad,"unidad"=>$pro->unidad,"detalle"=>$pro->descripcion,"codigo"=>$pro->codigo_interno,"ubicacion"=>$pro->ubicacion);
    		  	$i++;
    		}
    		$pdf = App::make('dompdf');
			$pagina = View::make('imprimibles.nota_pedido_normal')->with("datos",$da)->with("pedido",$pedido);
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
				$cuenta=Producto::find($producto->id)->cuenta;
				$datos["estado"] = 1;
				$datos["descripcion"]=$producto->descripcion;
				$datos["ubicacion"]=$producto->ubicacion;
				$datos["cuenta"]=$cuenta->nombre_cuenta;
				$datos["unidad"]=$producto->unidad;
				$datos["preciounitario"]=$producto->precio;	
				$datos["existencia"]=$producto->existencias;
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
