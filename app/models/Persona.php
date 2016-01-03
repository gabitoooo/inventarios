<?php
class Persona extends Eloquent
{
	public function users()
	{
		return $this->hasOne('User');
	}	
}