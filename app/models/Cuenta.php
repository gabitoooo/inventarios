<?php
class Cuenta extends Eloquent
{
	public function productos()
	{
		return $this->hasMany('Producto');
	}
}