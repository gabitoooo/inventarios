<?php
class PerfilController extends BaseController {
	public function getIndex(){
		$u=User::find(Session::get('user_id'));
		$p=$u->persona;
		//echo $u;
		return View::make('perfiles.perfil')->with('u',$u)->with('p',$p);
	}
	public function Cambiar(){
		$u=User::find(Session::get('user_id'));
		$pass=Crypt::decrypt($u->encry);
		return Redirect::to('perfil')->with('status','ok_reset');
	}
	public function Recuperar(){
		$user = new User;
		$user = User::find(Session::get('user_id'));
		if(Hash::check(Input::get('password'),$user->password))
		{
			return Redirect::to('perfil')->with('status','reset');
		}
		else{
			return Redirect::to('perfil')->with('status','not');
		}
	}
	public function Reseteo(){
		$pass1 = Input::get('password1');
		$pass2 = Input::get('password2');
		if($pass1 != NULL){
			if($pass2 != NULL){
				if ($pass1 == $pass2) {
					$user = User::find(Session::get('user_id'));
					$user->password = Hash::make($pass1);
					$user->encry = Crypt::encrypt($pass1);
					$user->save();
					return Redirect::to('perfil')->with('status','yes');
				}
				else{
					return Redirect::to('perfil')->with('status','dife');
				}
			}
			else{
				return Redirect::to('perfil')->with('status','vacio1');
			}
		}
		else{
			return Redirect::to('perfil')->with('status','vacio2');
		}
	}
}