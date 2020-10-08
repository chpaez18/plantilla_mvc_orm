<?php 

/**
Controlador que nos servira para los mensajes de error que tengamos que mostrar al usuario en conjunto con el layout
*/
class ErrorController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{

		$this->_view->titulo = "Error";	

		//enviamos el mensaje
		$this->_view->mensaje = $this->_getError();
		$this->_view->render("index");		
		
	}	


	//metodos por categoria de errores

	public function access($codigo)
	{

		$this->_view->titulo = "Error";	

		//enviamos el mensaje
		$this->_view->mensaje = $this->_getError($codigo);
		$this->_view->render("access");

	}


	private function _getError($codigo = false)
	{

		if($codigo){

			//recibimos el codigo y lo filtramos
			$codigo = $this->filtrarInt($codigo);

			//verificamos que el codigo sea entero
			if(is_int($codigo)){

				$codigo = $codigo;
			
			}

		}else{

			$codigo = "default";
		}
		

		//armamos un arreglo asociativo de errores
		$error["default"] = "Ha ocurrido un error y la página no puede mostrarse";  //establecemos un mensaje de error por default

		$error["5050"] = "Acceso Restringido";

		$error["8080"] = "Tiempo de la sesión agotado";


		//verificamos que exista en el arreglo el codigo
		if(array_key_exists($codigo, $error)){

			return $error[$codigo];
		
		}else{

			return $error["default"];

		}

	}

}

?>