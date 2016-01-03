<?php
class Pedido extends Eloquent
{
	
	public function productos()
	{
		return $this->belongsToMany('Producto');
	}

   public static function pedidoproducto($pedido_id,$producto_id,$cantidad)
	{
			$p=new Pedidoproducto;
			$p->pedido_id=$pedido_id;
			$p->producto_id=$producto_id;
			$p->fecha=date('Y-m-d');
			$p->cantidad=$cantidad;
			$p->save();
	}
	public static function separar($nombre,$cadena)
	{
			$d=explode($nombre."=",$cadena);
			$da=explode("&",$d[1]);
			$dato=$da[0];
			return $dato;
	}
	public static function cambiarfecha()
	{

		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'); 
		return $fecha;
	}
	public static function agregarPedido($numero,$nivel,$de,$seccion,$al_almacen,$para_uso,$pedido_por,$cargo_pedido_por,$aprobado_por,$cargo_aprobado_por,$autorizado_por,$cargo_autorizado_por,$referencia)
	{
			$p=new Pedido;
			$p->numero=$numero;
			$p->nivel=Session::get('nivel');
			$p->de=$de;
			$p->seccion=$seccion;
			$p->fecha=Pedidocompra::cambiarfecha();
			$p->al_almacen=$al_almacen;
			$p->para_uso_en=$para_uso;
			$p->pedido_por=$pedido_por;
			$p->cargo_pedido_por=$cargo_pedido_por;
			$p->aprobado_por=$aprobado_por;
			$p->cargo_aprobado_por=$cargo_aprobado_por;
			$p->autorizado_por=$autorizado_por;
			$p->cargo_autorizado_por=$cargo_autorizado_por;
			$p->referencia=$referencia;
			$p->confirmado=false;
			$p->save();		
	}	

		
}