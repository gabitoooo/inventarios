<?php

class CardexController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$cuentas = Cuenta::orderBy('nombre_cuenta', 'asc')->get();
		//$ufv = Ufv::orderBy('cotizacion', 'desc')->get();
		$ufv=DB::table('ufvs')->orderBy('gestion','desc')->get();
		//echo $cuentas;
		return View::make('cardex.cardexuno')->with('cuentas',$cuentas)->with('ufv',$ufv);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getRecuperarproducto($codigo)
	{
				if (Request::ajax())
				{
					 $producto=Producto::where('codigo_interno','=',$codigo)->first();

				}		
	}
	public function postVerhistorial()
	{
		$tipo=Input::get('tipo');
		$gestion=Input::get('gestion');
		$codigoproducto=Input::get('codigo');
		if ($codigoproducto==null||$gestion==null)
		{
			echo "Codigo mal";
		}
		else{
			if ($tipo=="Ingresos del Producto")
			{
				$gestioninicio=$gestion."-01-0";
				$gestionfinal=$gestion."-12-32";
				$p=Producto::where('codigo_interno','=',$codigoproducto)->first();
				if ($p==null) {
					echo "no hay registros";
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
						return Redirect::to('cardex')->with('ing_total',$ing_total)->with('status','ok_ingreso');
					}
					else
					{
						echo "no tiene ingresos";
					}
					
				}
			}
			else
			{
				if ($tipo=="Egresos del Producto")
				{
					$gestioninicio=$gestion."-01-0";
					$gestionfinal=$gestion."-12-32";
					$p=Producto::where('codigo_interno','=',$codigoproducto)->first();
					if ($p==null) {
						echo "no hay registros";
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
							return Redirect::to('cardex')->with('egre_total',$egre_total)->with('status','ok_egreso');
						}
						else{
							echo "no tiene egresos";
						}
					}
				}
			}
		}
	}

	public function Crear()
	{
		$gestion = Input::get('gestion');
		$cotizacion = Input::get('cotizacion'); 
		$ufv = new Ufv;
		$ufv->cotizacion = $cotizacion;
		$ufv->gestion = $gestion;
		$ufv->save();
		//echo 'guardado';
		return Redirect::to('cardex')->with('status', 'ok_ufv')->with('stat', 'ok_inicio');
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
	public function editar($id)
	{
		$ufv = Ufv::find($id);
		//echo $ufv;
		$data = array(
			'success' => true,
			'id' => $ufv->id,
			'gestion' => $ufv->gestion,
			'cotizacion' => $ufv->cotizacion,
		);
		return Response::json($data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function actualizar()
	{
		$id=Input::get('id');
		$uff=Ufv::find($id);
		$uff->cotizacion=Input::get('cotizacion');
		$uff->gestion=Input::get('gestion');
		$uff->save();
		return Redirect::to('cardex')->with('status', 'ok_ufv')->with('stat', 'ok_inicio');
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
