<?php
class Pedidocompra extends Eloquent
{
	public function productos()
	{
		return $this->belongsToMany('Producto');
	}
	public function productosnuevos()
	{
		return $this->hasMany('Productosnuevo');
	}
	public function ingreso()
	{
		return $this->hasOne('Ingreso');
	}



	////funciones extras utilizadas en el controlador de ingresos
	public static function compraProductoNuevo($pedidocompra_id,$descripcion,$unidad,$numero_interno,$cantidad)
	{
		 $p= new Productosnuevo;
		 $p->pedidocompra_id=$pedidocompra_id;
		 $p->descripcion=$descripcion;
		 $p->unidad=$unidad;
		 $p->numero_interno=$numero_interno;
		 $p->nivel=Session::get('nivel');
		 $p->cantidad=$cantidad;
		 $p->save();
	}
	
	public static function compraProductoExistente($pedidocompra_id,$producto_id,$cantidad)
	{
			$p=new Pedidocompraproducto;
			$p->pedidocompra_id=$pedidocompra_id;
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
	public static function agregarPedidoCompra($numero,$nivel,$de,$seccion,$al_almacen,$para_uso,$pedido_por,$cargo_pedido_por,$aprobado_por,$cargo_aprobado_por,$autorizado_por,$cargo_autorizado_por,$referencia)
	{
			$p=new Pedidocompra;
			$p->numero=$numero;
			$p->nivel=Session::get('nivel');
			$p->de=$de;
			$p->seccion=$seccion;
			$p->fecha=Pedidocompra::cambiarfecha();
			$p->al_almacen=$al_almacen;
			$p->para_uso=$para_uso;
			$p->pedido_por=$pedido_por;
			$p->cargo_pedido_por=$cargo_pedido_por;
			$p->aprobado_por=$aprobado_por;
			$p->cargo_aprobado_por=$cargo_aprobado_por;
			$p->autorizado_por=$autorizado_por;
			$p->cargo_autorizado_por=$cargo_autorizado_por;
			$p->referencia=$referencia;
			$p->confirmado_ingreso=false;
			$p->confirmado_egreso=false;
			$p->save();		
	}	
}