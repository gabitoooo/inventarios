<?php
App::before(function($request)
{
});
App::after(function($request, $response)
{
});
Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/');
		}
	}
});
Route::filter('auth.basic', function()
{
	return Auth::basic();
});
Route::filter('perfils',function(){
	if(Session::get('nivel')==null)
	{
		return Redirect::to('/');
	}
});
Route::filter('encargados',function(){
	
	if (Session::get('nivel')==2)
	{
		
	}
	else
	{
		if (Session::get('nivel')==4)
		{
			//echo "tb emntraste aqui";
		}
		else
		{
			return Redirect::to('/');
		}
		
	}
	

});

Route::filter('admis',function(){
	if (Session::get('nivel')!=1)
	{
		return Redirect::to('/');
	}
});
Route::filter('cardexs',function(){
	if (Session::get('nivel')!=3)
	{
		return Redirect::to('/');
	}
});
Route::filter('emails',function(){
	if(Session::get('nivel')!=null)
	{
		return Redirect::to('/');
	}
});
Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});
Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});