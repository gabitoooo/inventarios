<?php
class EdituserController extends BaseController{
	public function getIndex(){

	}
	public function editar($id){
		$user = User::find($id);
		$perso = User::find($id)->persona;
		$data = array(
			'success' => true,
			'id' => $user->id,
			'level' => $user->nivel,
			'nombres' => $perso->nombres,
			'apellidos' => $perso->apellidos,
			'ci' => $perso->ci,
			'correo' => $user->email,
			'telefono' => $perso->telefono,
			'direccion' => $perso->direccion,
		);
		return Response::json($data);
	}
}