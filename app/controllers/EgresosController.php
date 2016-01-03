<?php

class EgresosController extends \BaseController {

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
		//EGitem=1&EGcodigo=aa&EGcantidad=7&EGitem=2&EGcodigo=bb&EGcantidad=15&
			//separando tipo de pedido
						
			$t=explode(" ",Input::get('numero_pedido'));
			$tipo=$t[0];

			$datos=Input::get('datos');
			
			$productos=explode("EGitem=",$datos);

			//registrando el ultimo pedido compra!!!!!!!!
			$egresosactuales=Egreso::where('nivel','=',Session::get('nivel'))->get();
			$num;

			

			if (count($egresosactuales)==0)
			{

				$num="1/".date('m/Y');
				
				if ($tipo=="PN")
				{
					$pedidonormal=Pedido::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
					$pedidonormal->confirmado=true;
					$pedidonormal->save();
					Egreso::agregarEgresopedidonormal($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidonormal->id);
					
				}
				else
				{
					$pedidocom=Pedidocompra::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
					$pedidocom->confirmado_egreso=true;
					$pedidocom->save();
					Egreso::agregarEgresopedidocompra($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidocom->id);
				}
			}
			else
			{
				$totalegresos=count($egresosactuales);
				$utlimoegreso=Egreso::where('id','=',$egresosactuales[$totalegresos-1]->id)->first();
				//separandola el numero el mes y el año para realizar operacion
				$parafecha=explode("/", $utlimoegreso->numero);
				if ($parafecha[1]==date('m'))
				{
					$actual=$parafecha[0]+1;
					$num=$actual."/".date('m/Y');
					if ($tipo=="PN")
					{
						$pedidonormal=Pedido::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
						$pedidonormal->confirmado=true;
						$pedidonormal->save();
						Egreso::agregarEgresopedidonormal($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidonormal->id);
					}
					else
					{
						$pedidocom=Pedidocompra::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
						$pedidocom->confirmado_egreso=true;
						$pedidocom->save();
						Egreso::agregarEgresopedidocompra($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidocom->id);
					}
		    	}
		    	else
				{
					$num="1/".date('m/Y');
					if ($tipo=="PN")
					{
						$pedidonormal=Pedido::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
						$pedidonormal->confirmado=true;
						$pedidonormal->save();
						Egreso::agregarEgresopedidonormal($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidonormal->id);
					}
					else
					{
						$pedidocom=Pedidocompra::where('numero','=',$t[1])->where('nivel','=',Session::get('nivel'))->first();
						$pedidocom->confirmado_egreso=true;
						$pedidocom->save();
						Egreso::agregarEgresopedidocompra($num,Input::get('para_uso_en'),Input::get('entregado_por'),Input::get('cargo_entregado_por'),Input::get('recivido_por'),Input::get('cargo_recivido_por'),$pedidocom->id);
					}
				
				}
			}
			
			
			//recuperando el egreso compra actual
			$egreso=Egreso::where('numero','=',$num)->where('nivel','=',Session::get('nivel'))->first();

			//registradon los productos del egreso
			for ($i=1; $i < count($productos)  ; $i++) { 
				$cantidad=Egreso::separar("EGcantidad",$productos[$i]);
				$codigo=Egreso::separar("EGcodigo",$productos[$i]);
				$unidad_uso=Egreso::separar("EGunidad_uso",$productos[$i]);
				$p=Producto::where('codigo_interno','=',$codigo)->first();
				Egreso::egresoProducto($egreso->id,$p->id,$cantidad,$unidad_uso);
	   		}
	   	
	   		  $egreproduct=Egresoproducto::where('egreso_id','=',$egreso->id)->get();

	   			$i=0;
	   			foreach ($egreproduct as $e) {
	   				$pro=Producto::find($e->producto_id);
	   				$data[$i]=array("codigo"=>$pro->codigo_interno,"cantidad"=>$e->cantidad,"unidad"=>$pro->unidad,"descripcion"=>$pro->descripcion);
	   				$i++;
	   			}


			$pdf = App::make('dompdf');
			$pagina = View::make('imprimibles.nota_acta')->with('datos',$data)->with('egreso',$egreso);
			$pdf->loadHTML($pagina)->setPaper('letter')->setOrientation('landscape')->setWarnings(false);
			return $pdf->stream();
			
	   		

	   		//para pdf 

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
