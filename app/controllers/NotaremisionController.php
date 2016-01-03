<?php

class NotaremisionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function postCrear()
	{
			$datos=Input::get('datos');
			$egresos=explode("egreso=",$datos);

			
			$remisionesactuales=Remicione::where('nivel','=',Session::get('nivel'))->get();
			$num;
						
			
			if (count($remisionesactuales)==0)
			{
				$num="1/".date('m/Y');
				Remicione::agregarRemicion($num,Input::get('almacen_de'),Session::get('nivel'),Input::get('remitidos_a'),Input::get('revisado_por'),Input::get('cargo_revisado_por'),Input::get('autorizado_por'),Input::get('cargo_autorizado_por'),Input::get('despachado_por'),Input::get('cargo_despachado_por'),Input::get('codigo_camion'),Input::get('nombre_conductor'));
		    }
			else
			{
				$totalremisiones=count($remisionesactuales);
				$utlimaremision=Remicione::where('id','=',$remisionesactuales[$totalremisiones-1]->id)->first();
				//separandola el numero el mes y el año para realizar operacion
				$parafecha=explode("/", $utlimaremision->numero);
				if ($parafecha[1]==date('m'))
				{
					$actual=$parafecha[0]+1;
					$num=$actual."/".date('m/Y');
					Remicione::agregarRemicion($num,Input::get('almacen_de'),Session::get('nivel'),Input::get('remitidos_a'),Input::get('revisado_por'),Input::get('cargo_revisado_por'),Input::get('autorizado_por'),Input::get('cargo_autorizado_por'),Input::get('despachado_por'),Input::get('cargo_despachado_por'),Input::get('codigo_camion'),Input::get('nombre_conductor'));
		    	}
		    	else
				{
					$num="1/".date('m/Y');
					Remicione::agregarRemicion($num,Input::get('almacen_de'),Session::get('nivel'),Input::get('remitidos_a'),Input::get('revisado_por'),Input::get('cargo_revisado_por'),Input::get('autorizado_por'),Input::get('cargo_autorizado_por'),Input::get('despachado_por'),Input::get('cargo_despachado_por'),Input::get('codigo_camion'),Input::get('nombre_conductor'));
				}
			}
			
			   $remision=Remicione::where('numero','=',$num)->where('nivel','=',Session::get('nivel'))->first();

			//registradon los productos por filas
			for ($i=1; $i < count($egresos)  ; $i++) { 

				$eg=explode("&",$egresos[$i]);
		    	Remicione::actualizaregreso($eg[0],$remision->id);
		    		
			}

			//para pdf
			$egr=Remicione::find($remision->id)->egresos;
			$da;
			$j=0;
			for ($i=0; $i <count($egr) ; $i++)
			{ 
				$prodegre=Egresoproducto::where('egreso_id','=',$egr[$i]->id)->get();
				$pedi;
				if ($egr[$i]->pedido_id>0)
				{
					$pdn=Pedido::find($egr[$i]->pedido_id);
					$pedi="PN".$pdn->numero;
				}
				else
				{
					$pdn=Pedidocompra::find($egr[$i]->pedidocompra_id);
					$pedi="PC".$pdn->numero;
				}
					foreach ($prodegre as $p) {
						$pro=Producto::find($p->producto_id);
						$total=$p->cantidad*$p->precio;
	     				$da[$j]=array("codigo"=>$pro->codigo_interno,"cantidad"=>$p->cantidad,"pedido"=>$pedi,"numero"=>$p->unidad_uso,"descripcion"=>$pro->descripcion,"precio"=>$p->precio,"total"=>$total);
						$j++;
					}
					
				}

				$pdf = App::make('dompdf');
			$pagina = View::make('imprimibles.nota_remision')->with('datos',$da)->with('remision',$remision);
			$pdf->loadHTML($pagina)->setPaper('letter')->setOrientation('landscape')->setWarnings(false);
			return $pdf->stream();
						
	}

	public function postRecuperarproductos()
	{
		$data = Input::all();
		if(Request::ajax())
		{
			
			$egreso=Egreso::where('numero','=',$data['numero'])->where('nivel','=',Session::get('nivel'))->first();
     		$egreso_productos=Egresoproducto::where('egreso_id','=',$egreso->id)->get();
			$datos;
			for ($i=0; $i <count($egreso_productos) ; $i++)
			{ 
					$producto=Producto::find($egreso_productos[$i]->producto_id);
					
				    if ($egreso->pedido_id==true)
				    {
				    	$pedinorm=Egreso::find($egreso->id)->pedido;	
				    	$pn="PN".$pedinorm->numero; 
				    	$datos[$i]=array("medida"=>$producto->unidad,"cantidad"=>$egreso_productos[$i]->cantidad,"unidad"=>$egreso_productos[$i]->unidad_uso,"descripcion"=>$producto->descripcion,"codigo"=>$producto->codigo_interno,"pedido"=>$pn);
				    }
				    else
				    {
				    	$pedicom=Egreso::find($egreso->id)->pedidocompra;
				    	$pc="PC".$pedicom->numero; 
				        $datos[$i]=array("medida"=>$producto->unidad,"cantidad"=>$egreso_productos[$i]->cantidad,"unidad"=>$egreso_productos[$i]->unidad_uso,"descripcion"=>$producto->descripcion,"codigo"=>$producto->codigo_interno,"pedido"=>$pc);
				    }
					
			}
			echo json_encode($datos);
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
