<?php 
namespace Application;
use Application\Request;
use Application\View;
/**
* 
la clase abstracta se refiere a que la clase no pueda ser instanciada, y el metodo abstracto obliga a que todas las clases que herenden de esta implemente un metodo index ajuro

asi nos aseguramos que siempre haya un metodo index en todo controlador
*/
abstract class Controller 
{
	protected $_view;

	//hacemos que el objeto view este disponible en el controlador principal
	public function __construct(){
		$this->_view = new View(new Request);
	}	
	
	abstract public function index();


	public function getData($cadena){

		$cadena1 = str_replace( '\"+', '', $cadena);
		$cadena2 = str_replace("'","",$cadena1); //aquí eliminamos las comillas simples (')
		$cadena3 = str_replace('"',"",$cadena2); //eliminamos las comillas dobles (")

		$cadena4 = strtolower($cadena3); //Simplemente convierte a minúsculas, esto ya es para la url
		$cadena5 = trim($cadena4);
		$cadena6 = htmlspecialchars(trim(strip_tags($cadena5)), ENT_QUOTES, "UTF-8");


		return $cadena6;
	}

	//metodo que importa los modelos
	public function loadModel($model){

		$model = $model . "Model";

		//establecemos la ruta del modelo
		$rutaModel = ROOT . "models" . DS . $model . ".php";
		
		//verificamos que exista el modelo en el directorio
		if(is_readable($rutaModel)){

			//en caso de existir, requerimos el modelo y lo instanciamos, y al final devolvemos una instancia de ese modelo
			require_once $rutaModel;
			$model = new $model;
			return $model;
		}else{
			//en caso contrario, enviamos un mensaje de error
			throw new Exception("Error de Modelo");
			

		}



	}	

	//metodo que importa los modelos
	public function import($model){

		$model = $model . "Model";

		//establecemos la ruta del modelo
		$rutaModel = ROOT . "models" . DS . $model . ".php";
		
		//verificamos que exista el modelo en el directorio
		if(is_readable($rutaModel)){

			//en caso de existir, requerimos el modelo y lo instanciamos, y al final devolvemos una instancia de ese modelo
			require_once $rutaModel;
			$model = new $model;
			return $model;
		}else{
			//en caso contrario, enviamos un mensaje de error
			throw new Exception("Error de Modelo");
			

		}



	}



	//metodo para cargar librerias
	protected function getLibrary($libreria){

		$rutaLibreria = ROOT . "libs" . DS . $libreria . DS . $libreria . ".php";
		//verificamos si existe
		if(is_readable($rutaLibreria)){

			require_once $rutaLibreria;

		}else{

			throw new Exception("Error de Libreria");
			

		}
	
	}

	//este metodo tomara una variable enviada por post, la filtrara y nos la devolvera filtrada

	//filtramos lo que se esta enviando por post, esto lo que hace es devolver la cadena pero convierte caracteres especiales como las "" o '' o <> etiquetas, en codigo html

	protected function getTexto($clave){

		if(isset($_POST[$clave]) && !empty($_POST[$clave])){

			$_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);  //transforma las comillas simples y dobles
			return $_POST[$clave];
		}

			return "";

	}	


	//lo mismo de arriba pero para numeros enteros
	protected function getInt($clave){

		if(isset($_POST[$clave]) && !empty($_POST[$clave])){

			$_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);  

			return $_POST[$clave];
		}

			return 0;

	}

	//filtramos la clave, que son enviadas por la url
	protected function filtrarInt($int){

		$int = (int) $int;  //primero lo convertimos en un entero
		if(is_int($int)){

			return $int;
			
		}else{

			return 0;
		}

	}



	//funcion que nos redirecciona a una ruta en especifica, con o sin parametros
	protected function redirect($ruta = false, $params = null){

		$p = null;

		if(is_array($params)){
			

			foreach ($params as $param => $value) {
				$p .= "&".$param."=".$value;
			}

		}

		if($ruta){

			if(!empty($params)){

				header("location:index.php?url=".$ruta."".$p);
				exit;

			}else{

				header("location:index.php?url=".$ruta);
				exit;
			}
			exit;
		
		}
	}

//funcion que limpia los string tags, para prevenir inyecciones sql, este metodo lo usaremos para sanitizar el password
protected function getSql($clave)
{
	if(isset($_POST[$clave]) && !empty($_POST[$clave])){

	if(!get_magic_quotes_gpc()){
		$_POST[$clave] = pg_escape_string($_POST[$clave]);
	}

	return trim($_POST[$clave]);

	}

}

//metodo que hace un reemplazo a todos los caracteres especiales, usaremos este metodo para sanitizar el nombre de usuario
protected function getAlphaNum($clave)
{
	
	if(isset($_POST[$clave]) && !empty($_POST[$clave])){

	//$_POST[$clave] = (string) preg_replace('/[^A-Z0-9]/i','', $_POST[$clave]);

	return trim($_POST[$clave]);

	}

}


	public function validarEmail($email)
	{
		//verificamos que lo que se esta enviando sea una direccion de email 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

			return false;
		}

	}



}


?>