<?php
class EmailController extends BaseController {

	public function getIndex(){
		return View::make('password.remind');
	}
	public function contacto(){
		$mensaje = null;
		$userpass = User::where('email','=',Input::get('email'))->first();
		if($userpass){
			$pass=Crypt::decrypt($userpass->encry);
			$nombre=$userpass->username;
			if(isset($_POST['contacto'])){
				$data = array(
					'nombre' => $nombre,
					'email' => Input::get('email'),
					'pass' => $pass
				);
				$fromEmail = Input::get('email');
				$fromName = Input::get('nombre');
				Mail::send('emails.contacto', $data, function($message) use($fromName, $fromEmail){
					$message->to($fromEmail, $fromName);
					$message->from('rugratsmylo@gmail.com', 'administrador');
					$message->subject('Nuevo Email de contacto');
				});
			}
			return Redirect::to('email')->with('status', 'ok_send');
		}
		else{
			return Redirect::to('email')->with('status', 'not_send');
		}
		//$data = Input::get('nombre');
		/*foreach ($data as $key => $value) {
			echo $value.'<br>';
		}*/
		//echo $data;
		//var_dump($data);
		
		//return View::make('password.remind')->with('status', 'ok_create');
	}
}