<?php 
namespace Application;
//Bootsrap llama al controlador dentro de la carpeta controllers, para llegar al metodo que esta siendo solicitado


//procesa las llamadas a los controladores y a los metodos

/**
* 
*/
class Bootstrap 
{
	
	//metodo estatico, al cual le pasamos un objeto de la clase Request 

 	public static function run(Request $peticion){

 		$controller = ucwords($peticion->getControlador()) . "Controller"; //obtenemos el controlador y le concatenamos Controller al final, para poder buscarlo luego
 		$rutaControlador = ROOT . "controllers" . DS . $controller . ".php"; //armamos la ruta hasta el controlador que se solicita
 		$metodo = $peticion->getMetodo();
 		$args = $peticion->getArgs();
 		
 		//verificamos si el archivo es accesible es decir si existe y es legible
 		if(is_readable($rutaControlador)){

 			require_once $rutaControlador;
 			$controller = new $controller;				//instanciamos una clase del index controller

 			//verificamos si el metodo es valido
 			if(is_callable(array($controller, $metodo))){

 				$metodo = $peticion->getMetodo();

 			}else{

 				$metodo = "index";

 			}

 			if(isset($args)){
 				
 				call_user_func_array(array($controller, $metodo),$args); //enviamos en un arreglo el nombre de la clase, y el metodo dentro de la misma y los argumentos que queremos pasarle

 			}else{

 				call_user_func(array($controller, $metodo));		//si no hay argumentos, solo llamamos la clase que esta en controller y el metodo solicitado

 			}


 		}else{

 			throw new \Exception("No encontrado", 1);
 			
 			

 		}




 	}

}

?>