<?php
class Ingreso extends Eloquent
{
	public function productos()
	{
		return $this->belongsToMany('Producto');
	}
	public function pedidocompra()
	{
		return $this->belongsTo('Pedidocompra');
	}


	////funciones extras utilizadas en el controlador de ingresos
	public static function ingresandoproducto($codigo,$descripcion,$cuenta,$ubicacion,$unidad,$cantidad,$precio,$ingreso_id)
	{
		$cuenta=Cuenta::where('nombre_cuenta','=',$cuenta)->first();
		$producto=Producto::where('codigo_interno','=',$codigo)->first();
		if ($producto!=null)
		{
			//actualizando la existencia del producto en la tabla central
			$producto->existencias=$producto->existencias+$cantidad;
			$producto->precio=$precio;
			$producto->ubicacion=$ubicacion;
			$producto->save();
			
		}
		else
		{
			$p=new Producto;
			$p->codigo_interno=$codigo;
			$p->descripcion=$descripcion;
			$p->cuenta_id=$cuenta->id;
			$p->ubicacion=$ubicacion;
			$p->precio=$precio;
			$p->existencias=$cantidad;
			$p->unidad=$unidad;
			$p->nivel=Session::get('nivel');
			$p->save();
			//Guardando codigo 	QR
			DNS2D::getBarcodePNGPath($codigo,"QRCODE",20,20);
			//selecionando el producto recien guardado
			$producto=Producto::where('codigo_interno','=',$codigo)->first();
		}

			//ingresando en la tabla  mediatica de producto e ingreso para futuras referencias y saber cuantos productos fueron ingresados en un producto
			$ing_pro=new Ingresoproducto;
			$ing_pro->ingreso_id=$ingreso_id;
			$ing_pro->producto_id=$producto->id;
			$ing_pro->cantidad=$cantidad;
			$ing_pro->precio=$precio;
			$ing_pro->fecha=date('Y-m-d');
			$ing_pro->save();
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
	public static function agregaringreso($numero,$fecha,$nivel,$al_almacen,$procedente_de,$numero_factura,$proveedor,$documento_respalddo,$nit,$valor_total,$valor_recivido,$entregado_por,$recivido_por,$observaciones,$orden_compra,$pedidocompra_id)
	{
			$ingreso=new Ingreso;
			$ingreso->numero=$numero;
			$ingreso->fecha=$fecha;
			$ingreso->nivel=$nivel;
			$ingreso->al_almacen=$al_almacen;
			$ingreso->procendente_de=$procedente_de;
			$ingreso->numero_factura=$numero_factura;
			$ingreso->documento_respaldo=$documento_respalddo;
			$ingreso->proveedor=$proveedor;
			$ingreso->nit=$nit;
			$ingreso->valor_total=$valor_total;
			$ingreso->valor_recivido=$valor_recivido;
			$ingreso->entregado_por=$entregado_por;
			$ingreso->recivido_por=$recivido_por;
			$ingreso->observaciones=$observaciones;
			$ingreso->orden_compra=$orden_compra;
			$ingreso->pedidocompra_id=$pedidocompra_id;
			$ingreso->save();
	}




	
	
}