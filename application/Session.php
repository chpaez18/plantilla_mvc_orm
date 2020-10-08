<?php 
namespace Application;
use Models\Site;
use Application\Session;
/**
Clase que proporciona los metodos para el manejo de sesiones, variables de sesion etc
*/

class Session 
{
	
	public static function init()
	{

		session_start();

	}

	//metodo para destruir una variable de sesion, o varias dentro de un arreglo

	public static function destroy($clave = false)
	{

		//verificamos si se envio una clave

		if($clave){

			//verificamos primero si es un arreglo
			if(is_array($clave)){

				//recorremos el arreglo y por cada coincidencia eliminamos esa variable

				for($i = 0; $i< count($clave); $i++){

					//verificamos si existe esa variable de sesion

					if(isset($_SESSION[$clave[$i]])){

						unset($_SESSION[$clave[$i]]);//si existe, le hacemos un unset a esa variable
					}

				}
			}else{

				if(isset($_SESSION[$clave])){

						unset($_SESSION[$clave]);//si existe, le hacemos un unset a esa variable
				}

			}


		}else{
			$model = new Site();
			//en caso de que no se haya enviado una clave, se hace un session_destroy()
			$id_user = Session::get("cod_usuario");
			Site::where('cod_usuario', '=', $id_user)->update(['ssid' => null]);
			session_destroy();
		}



	}


	//este metodo recibira un nombre de variable de sesion y un valor y lo asignara como varible de sesion
	public static function set($clave, $valor)
	{

		if(!empty($clave)){
			$_SESSION[$clave] = $valor;
		}

	}


	public static function get($clave)
	{

		if(isset($_SESSION[$clave])){

			return $_SESSION[$clave];
		
		}

	}

	//metodo para controlar el tiempo de sesion del usuario
	public static function tiempo()
	{

		//verificamos si hay una variable de sesion, o esta definida la constante de session_time
		if(!Session::get("tiempo") || !defined("SESSION_TIME")){

			throw new Exception("No se ha definido el tiempo de sesion");
			
		}

		if(SESSION_TIME == 0){

			return;

		}

		//restamos el tiempo actual, al tiempo cuando el usuario inicio sesion, y si ese tiempo es mayor al session_time * 60 esto por que time() devuelve el tiempo en segundos, y para convertirlo en minutos lo multiplicamos por 60
		if(time() - Session::get("tiempo") > (SESSION_TIME * 60)){
			
			Session::destroy();
			header("location: index.php?url=error/access/8080");
		}else{
			//si todavia esta dentro del tiempo de sesion, reiniciamos ese tiempo, y ponemos el tiempo actual como valor
			Session::set("tiempo", time());
		}


	}

}

?>