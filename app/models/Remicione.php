<?php
class Remicione extends Eloquent
{
	public function egresos()
	{
		return $this->hasMany('Egreso');
	}

	public static function cambiarfecha()
	{

		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'); 
		return $fecha;
	}
	public static function agregarRemicion($numero,$almacen_de,$nivel,$remitidos_a,$revisado_por,$cargo_revisado_por,$autorizado_por,$cargo_autorizado_por,$despachado_por,$cargo_despachado_por,$codigo_camion,$nombre_conductor)
	{
			$re=new Remicione;
			$re->numero=$numero;
			$re->almacen_de=$almacen_de;
			$re->fecha=Remicione::cambiarfecha();
			$re->nivel=$nivel;
			$re->remitidos_a=$remitidos_a;
			$re->revisado_por=$revisado_por;
			$re->cargo_revisado_por=$cargo_revisado_por;
			$re->autorizado_por=$autorizado_por;
			$re->cargo_autorizado_por=$cargo_autorizado_por;
			$re->despachado_por=$despachado_por;
			$re->cargo_despachado_por=$cargo_despachado_por;
			$re->codigo_camion=$codigo_camion;
			$re->nombre_conductor=$nombre_conductor;		
			$re->save();
	}
	public static function actualizaregreso($numero,$remicione_id)
	{
		$egreso=Egreso::where('nivel','=',Session::get('nivel'))->where('numero','=',$numero)->first();
		$egreso->remicione_id=$remicione_id;
		$egreso->save();
	}

		
}