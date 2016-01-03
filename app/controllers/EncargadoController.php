<?php
class EncargadoController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		
		//para ingresos
		$cuentas=Cuenta::orderBy('nombre_cuenta', 'ASC')->get();
		$pedidosporingresar=Pedidocompra::where('confirmado_ingreso','<>',true)->where('nivel','=',Session::get('nivel'))->get();
		$correcto;
		$num;
		    $ingresosactuales=Ingreso::where('nivel','=',Session::get('nivel'))->get();
			if (count($ingresosactuales)==0)
			{
				$num="1/".date('m/Y');				
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
					
		    	}
		    	else
				{
					$num="1/".date('m/Y');
				}				
			}
		//echo count($pedidosporingresar)
		if (count($pedidosporingresar)>0) {
			$correcto="true";
			return View::make('encargado.inventario',array('correcto'=>$correcto,'num'=>$num))->with('cuentas',$cuentas)->with('pedidosporingresar',$pedidosporingresar);
			
		}
		else
		{
			$correcto="false";
			return View::make('encargado.inventario',array('correcto'=>$correcto,'num'=>$num))->with('cuentas',$cuentas);
		}		

	}


	public function getInventario()
	{
		
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
