<?php 
namespace Application;
/**
* 
*/
class Request
{
	private $_controlador;
	private $_metodo;
	private $_argumentos;


	public function __construct(){

		if(isset($_GET["url"])){

			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL); //tomamos el parametro url via get, pasa por el filter y lo devuelve filtrado

			$url = explode("/", $url); //creamos un arreglo, dividimos lo que venga por la url, lo que siga del slash "/" lo pondra como elemento del array
			
			$url = array_filter($url); //todos los elementos que no sean validos dentro del array los elimina



			$this->_controlador = strtolower(array_shift($url));  //aray_shift extrae el primer elemento del array y lo devuelve, en este caso el controlador es el primer elemento, entonces lo toma y lo devuelve

			$this->_metodo = strtolower(array_shift($url)); 	//en este momento ahora el metodo es el primer elemento del array, entonces se toma y lo devuelve

			$this->_argumentos = $url;

		}



		


//en estas lineas, manejamos que siempre se devuelva un controlador, un metodo y argumentos

		//se verifica que exista el controlador, en caso de no existir el controlador se devuelve el controlador por default

		if(!$this->_controlador){				

			$this->_controlador = DEFAULT_CONTROLLER;

		} 		

		if(!$this->_metodo){				

			$this->metodo = "index";

		}		

		if(!isset($this->_argumentos)){				

			$this->_argumentos = array();

		}




	}


	public function getControlador(){
		return $this->_controlador;
	}	

	public function getMetodo(){
		return $this->_metodo;
	}	

	public function getArgs(){
		return $this->_argumentos;
	}


}

?>