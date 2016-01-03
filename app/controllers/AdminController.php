<?php
class AdminController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$mi_id=User::find(Session::get('user_id'))->persona;
		$users=User::where('nivel','<>',Session::get('user_id'))->get();
		//$persona=Persona::all();
		//echo $persona;
		$personas=Persona::where('id','<>',$mi_id->id)->get();
		//echo $users;
		return View::make('administrador.admi')->with('users',$users)->with('personas',$personas);
		//return var_dump($persona);
	}
	public function Create(){
		$rules=	array(
			'username'=>'required',
			'level'=>'required',
			'names'=>'required',
			'last_name'=>'required',
			'ci_num'=>'required',
			'correo' => 'required|email',
			'telephone'=>'required|numeric',
			'adress'=>'required',
			'password'=>'required'
			);
		$validacion=Validator::make(Input::all(),$rules);
		if($validacion->fails())
		{
			return Redirect::back()->withErrors($validacion);
		}
		else{
			$password = Input::get('password');
			$persona = new Persona;
			$user = new User;

			$persona->nombres = Input::get('names');
			$persona->apellidos = Input::get('last_name');
			$persona->ci = Input::get('ci_num');
			$persona->telefono = Input::get('telephone');
			$persona->direccion = Input::get('adress');
			$persona->save();

			$persona=Persona::where('ci','=',Input::get('ci_num'))->first();

			$user->username = Input::get('username');
			$user->password = Hash::make($password);
			$user->encry = Crypt::encrypt($password);
			$user->nivel = Input::get('level');
			$user->email = Input::get('correo');
			$user->persona_id = $persona->id;
			$user->save();
			return Redirect::to('admi')->with('status', 'ok_create');
		}
	}
	public function Eliminar($id){
		
		$persona=User::find($id)->persona;
		User::destroy($id);
		Persona::destroy($persona->id);
		return Redirect::to('admi')->with('status', 'ok_delete');
	}
	public function Actualizar(){
		$mi_id = Input::get('id');
		$user = User::find($mi_id);
		$persona = User::find($mi_id)->persona; 

		$user->nivel = Input::get('level');
		$user->email = Input::get('correo');
		$persona->nombres = Input::get('nombres');
		$persona->apellidos = Input::get('apellidos');
		$persona->ci = Input::get('ci');
		$persona->telefono = Input::get('telefono');
		$persona->direccion = Input::get('direccion');
		$persona->save();
		$user->save();
		return Redirect::to('admi')->with('status', 'ok_update');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}