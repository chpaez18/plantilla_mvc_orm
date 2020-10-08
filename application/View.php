<?php 
namespace Application;
use Models\Site;
use Application\Session;
use Application\Router;
/**
* 
*/

class View 
{
	
	private $_controlador;

	public function __construct(Request $peticion){

		$this->_controlador = $peticion->getControlador();
	}	


	//metodo que renderiza las vistas
	public function render($vista, $item = false, $vars =[]){
		$model = new Site();
		$_layoutParams = array(

		


			'ruta_css' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/css/",
			'ruta_img' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/img/",
			'ruta_js' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/js/",
			'ruta_lib' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/lib/",
			'ruta_font_awesome' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/font-awesome/css/",
			'ruta_froala' => BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . "/froala/"
		);
		
		//foreach que por cada variable que venga, le sacamos la clave y el valor
		foreach ($vars as $key => $value) {
			$$key = $value;   //instanciamos una variable con el valor, para instanciar variables se usa 2 veces el $, $$key
		}

		//variable que contiene todas las opciones del menu

		if(Session::get("autenticado")){

			$menu = [

										[
										'id'=>'inicio',
										'titulo'=>'Inicio',
										'enlace' => ROUTER::create_action_url("site/index"),
										'icon'=>'fa fa-home'

										],			
										[
										'id'=>'productos',
										'titulo'=>'Productos',
										'enlace' => ROUTER::create_action_url("productos/list"),
										'icon'=>'fas fa-store'

										],			
										[
										'id'=>'productos',
										'titulo'=>'Agregrar Producto',
										'enlace' => ROUTER::create_action_url("productos/create"),
										'icon'=>'fas fa-plus'

										],			

										/*
										[
											'id'=>'cerrar',
											'titulo'=>'Cerrar Sesión ('.Session::get("nom_usuario").")",
											'enlace' => ROUTER::create_action_url("site/cerrar")

										],*/


			];

		}else{
			$menu = [

					[
					'id'=>'login',
					'titulo'=>'Iniciar Sesión',
					'enlace' => ROUTER::create_action_url("site/login"),
					'icon'=>'fas fa-sign-in-alt'

					],

					[
					'id'=>'registro',
					'titulo'=>'Registro de Usuario',
					'enlace' => ROUTER::create_action_url("site/registro"),
					'icon'=>'fas fa-user-plus'

					]		

			];
		}
		


		$rutaView = ROOT . "views" . DS . $this->_controlador . DS . $vista . ".php";  //armamos la ruta hasta la vista


			//verificamos que el archivo sea legible

			if(is_readable($rutaView)){


				
				include_once ROOT . "views" . DS . "layouts" . DS . DEFAULT_LAYOUT . DS . "content.php";
                include_once ROOT . "views" . DS . "layouts" . DS . DEFAULT_LAYOUT . DS . "footer.php";


			}else{

				throw new Exception("Vista no encontrada", 1);
				

			}

		
	}



}



?>