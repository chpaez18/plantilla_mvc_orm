<?php
use Models\Site;
use Application\Controller;
use Application\Session;
/**
* 
*/
class SiteController extends Controller
{

	//metodo que llama al metodo constructor de la clase padre
	public function __construct(){

		parent::__construct();

	}


	public function index(){
	
		$model = Site::find(Session::get("cod_usuario"));
		if(Session::get("autenticado")){
					
			$this->_view->titulo = "Inicio";
			$this->_view->render("index", "site", [
				"model"=>$model
			]);

		}else{

			$this->redirect("site/login");
		}


	}	



	//funcion para realizar el login
	public function login()
	{
		$model = new Site();
		$this->_view->titulo = "Iniciar Sesión";

		if(!empty($_POST))
		{
			$model = new Site ($_POST);

			$this->_view->datos = $_POST;

			$nombre_usuario = strtolower($this->getData($model->nom_usuario));
			$pass_hash = Hash::getHash("sha1",$model->pass_usuario,HASH_KEY);
			$model->pass_usuario = $pass_hash;
			

			//validamos si el usuario existe
			$user = $model->validateUser();

			if(!$user){
				$this->_view->error = "<b>¡Atención!</b> Nombre de usuario y/o contraseña incorrecto(s).";
				return $this->_view->render("login","site");
			}

			//guardamos el ssid del usuario, con el fin de validar si ya se tiene una sesion iniciada
			$ssid = $user->ssid;
			

			if($ssid){
				//en caso de que ya el usuario tenga un ssid, quiere decir que ya tiene una sesion activa
				$this->_view->error = "<b>¡Atención!</b> Este usuario ya tiene una sesión iniciada.";
				$this->_view->render("login", "site");
				exit;				
			}
			//apartir de aca podemos ir llenando variables de sesion segun vayamos necesitando

			Session::set("autenticado", true);

			Session::set("nom_usuario", $user->nom_usuario);

			Session::set("cod_usuario", $user->cod_usuario);

			Session::set("tiempo", time());

			$model->ssid = Hash::getHash("sha1",$user->cod_usuario,HASH_KEY);
			Site::where('cod_usuario', '=', $user->cod_usuario)->update(['ssid' => $model->ssid]);
			$this->redirect("site/index");
		}else{
			//verificamos si el usuario ya tiene una sesion iniciada e intenta entrar de nuevo al login, lo redireccionamos al index, si no, lo redireccionamos normalmente a la pagina de inicio de sesion
			if(Session::get("autenticado")){
				$this->_view->error = "Ya tiene iniciada una sesión";

				$this->redirect("site/index");
			}else{
				$this->_view->render("login", 'site',["model"=>$model]);
			}
		}
	}


	//funcion para realizar un registro como usuario
	public function registro()
	{
		$model = new Site();

		//verificamos si el usuario esta autenticado
		//para poder entrar al registro de usuario debe cerrar sesion primero
		if(Session::get("autenticado")){
			$this->redirect("site/index");
		}

		$this->_view->titulo = "Registro";

		if(!empty($_POST))
		{
			$model = new Site ($_POST);
			
			$this->_view->datos = $_POST;

			$nombre_usuario = strtolower($this->getData($model->nom_usuario));
			$pass_hash = Hash::getHash("sha1",$model->pass_usuario,HASH_KEY);
			$model->pass_usuario = $pass_hash;

			//validamos si el nombre de usuario esta disponible
			$user = $model->validateUsername();
			if($user){
				$this->_view->error = "<b>¡Atención!</b> Nombre de usuario en uso, porfavor elija otro";
				return $this->_view->render("registro","site");
			}
			$model->save();

			$this->redirect("site/login&ok=6");

		}

			$this->_view->render("registro","site",[
				"model"=>$model
			]);

	}


	public function cerrar()
	{
		$model = new Site();
		$id_user = Session::get("cod_usuario");
		
		//actualizamos el usuario activo, con el fin de borrar su ssid para que pueda iniciar sesion de nuevo
		Site::where('cod_usuario', '=', $id_user)->update(['ssid' => null]);
		Session::destroy();
		
		$this->redirect("site/login");

	}


}

?>