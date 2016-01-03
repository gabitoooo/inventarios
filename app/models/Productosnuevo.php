<?php
class Productosnuevo extends Eloquent
{
	public function pedidocompra()
	{
		return $this->belongsTo('Pedidocompra');
	}
	
}