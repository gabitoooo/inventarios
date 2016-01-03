<?php 
class Egreso extends Eloquent
{
	public function pedido()
	{
		return $this->belongsTo('Pedido');
	}
	public function pedidocompra()
	{
		return $this->belongsTo('Pedidocompra');
	}
	public function productos()
	{
		return $this->belongsToMany('Producto');
	}
	public function remision()
	{
		return $this->belongsTo('Remicione');
	}

	public static function egresoProducto($egreso_id,$producto_id,$cantidad,$unidad_uso)
	{
			$producto=Producto::find($producto_id);
			$producto->existencias=$producto->existencias-$cantidad;
			$producto->save();
			$e=new Egresoproducto;
			$e->egreso_id=$egreso_id;
			$e->producto_id=$producto_id;
			$e->fecha=date('Y-m-d');
			$e->cantidad=$cantidad;
			$e->unidad_uso=$unidad_uso;
			$e->precio=$producto->precio;
			$e->save();
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
	public static function agregarEgresopedidonormal($numero,$para_uso_en,$entregado_por,$cargo_entregado_por,$recivido_por,$cargo_recivido_por,$pedido_id)
	{
			$e=new Egreso;
			$e->numero=$numero;
			$e->nivel=Session::get('nivel');
			$e->fecha=Egreso::cambiarfecha();
			$e->para_uso_en=$para_uso_en;
			$e->entregado_por=$entregado_por;
			$e->cargo_entregado_por=$cargo_entregado_por;
			$e->recivido_por=$recivido_por;
			$e->cargo_recivido_por=$cargo_recivido_por;
			$e->pedido_id=$pedido_id;
			$e->save();			
	}
	public static function agregarEgresopedidocompra($numero,$para_uso_en,$entregado_por,$cargo_entregado_por,$recivido_por,$cargo_recivido_por,$pedidocompra_id)
	{
			$e=new Egreso;
			$e->numero=$numero;
			$e->nivel=Session::get('nivel');
			$e->fecha=Egreso::cambiarfecha();
			$e->para_uso_en=$para_uso_en;
			$e->entregado_por=$entregado_por;
			$e->cargo_entregado_por=$cargo_entregado_por;
			$e->recivido_por=$recivido_por;
			$e->cargo_recivido_por=$cargo_recivido_por;
			$e->pedidocompra_id=$pedidocompra_id;
			$e->save();			
	}
}