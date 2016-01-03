<?php
class Producto extends Eloquent
{
	public function cuenta()
	{
		return $this->belongsTo('Cuenta');
	}
	public function ingresos()
	{
		return $this->belongsToMany('Ingreso');
	}	
	public function pedidos()
	{
		return $this->belongsToMany('Pedido');
	}
	public function pedidocompras()
	{
		return $this->belongsToMany('Pedidocompra');
	}		
}