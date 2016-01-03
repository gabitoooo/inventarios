<?php
class loginController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::get('username'))
		{
			if (Session::get('nivel')==2)
			{
				return Redirect::to('encargado');
			}
			if(Session::get('nivel')==4)
			{
				return Redirect::to('encargado');
			}
			if (Session::get('nivel')==1)
			{
				return Redirect::to('admi');
			}
			if (Session::get('nivel')==3)
			{
				return Redirect::to('cardex');
			}
		}
		else
		{
			return View::make('inicio');
		}	
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function ingreso()
	{
		$user=new User;
		$user=User::where('username','=',Input::get('username'))->first();
		if (count($user)>0)
		{
		    if (Hash::check(Input::get('password'),$user->password))
		    {
		    	if ($user->nivel==2)
		    	{
	    			$encargado=User::where('id','=',$user->id)->first();
	    			Session::put('username',$user->username);
	    			Session::put('password',$user->password);
	    			Session::put('user_id',$user->id);
	    			Session::put('nivel',2);
	    		    return Redirect::to('encargado');
	 	    	}
	 	    	if ($user->nivel==4)
		    	{
	    			$encargado=User::where('id','=',$user->id)->first();
	    			Session::put('username',$user->username);
	    			Session::put('password',$user->password);
	    			Session::put('user_id',$user->id);
	    			Session::put('nivel',4);
	    		    return Redirect::to('encargado');
	 	    	}
	 	    	if ($user->nivel==1)
		    	{
	    			$admin=User::where('id','=',$user->id)->first();
	    			Session::put('username',$user->username);
	    			Session::put('password',$user->password);
	    			Session::put('user_id',$user->id);
	    			Session::put('nivel',1);
	    			return Redirect::to('admi');
	 	    	}
	 	    	if ($user->nivel==3)
	 	    	{
	 	    		$cardex=User::where('id','=',$user->id)->first();
	 	    		Session::put('username',$user->username);
	 	    		Session::put('password',$user->password);
	 	    		Session::put('user_id',$user->id);
	 	    		Session::put('nivel',3);
	 	    		return Redirect::to('cardex');
	 	    	}
		    }
		    else
		    {
		    	return  Redirect::to('/')->with('errores',true);
		    }
		}
		else
		{
			return  Redirect::to('/')->with('errores',true);
		}
	}
	public function create()
	{
		//
	}
	/**
	 * Store a newly created resource in storage.
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
