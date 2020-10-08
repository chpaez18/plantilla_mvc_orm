<?php
namespace Application;
/*
Modelo con metodo para redireccionamiento en url
*/
class ROUTER 
{
	

	//arma una url hasta una direccion en especifica, con o sin parametros
	static function create_action_url($r, $params = null){

		$p = null;

		if(is_array($params)){

			foreach ($params as $param => $value) {
				$p .= "/$value";
			}

		}

		if(!empty($params)){

			return "index.php?url=".$r."".$p."";

		}else{

			return "index.php?url=".$r;
		}
	}	


	static public function pathTo($context=false, $params = []){
		foreach ($params as $key => $value) {
			$$key = $value;   //instanciamos una variable con el valor, para instanciar variables se usa 2 veces el $, $$key
		}
		return VIEWS . $context . ".php";
	}

}
















?>