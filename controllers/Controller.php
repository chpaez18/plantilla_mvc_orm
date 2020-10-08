<?php 

/**
* 
*/
class Controller extends Controller
{
	
	public function __construct(){

		parent::__construct();
	}


	public function index()
	{

		if(Session::get("autenticado")){
				Session::accesoEstricto(["1","2","3","4"]);
				$this->_view->titulo = "Inicio";
				$this->_view->render("index");
		}else{

			$this->redirect("site/index");
		}
		
	}	


	public function create()
	{
		
		Session::accesoEstricto(["1","2","3","4"]);
		$this->_view->titulo = "Controller";

		if($this->getInt("enviar") == 1 || $model->requestPost()){
			

			$model->save(); 
			$this->_view->datos = $_POST;

			$this->redirect("site/login");

		}else{

			$this->_view->render("create");
		}

			

	}


	public function update()
	{

	}	

	public function delete()
	{

	}	

}

?>