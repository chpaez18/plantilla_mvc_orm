<?php

/**
* 
*/
class App
{
	static $class;
	
	function __construct()
	{
		# code...
	}

	public static function getKeyArray($array){
		$model = new ActiveRecord();
		$model1 = new App::$class;

		$campos = (array) $array;
		ArrayHelper::remove($campos, $model1->pk_field);
		return array_keys($campos);
	}	

	public static function getValueArray($array){
		$model = new App();
		$model1 = new App::$class;

		$campos = (array) $array;
		ArrayHelper::remove($campos, $model1->pk_field);

		foreach ($campos as $key => $value) {
			 ArrayHelper::remove($campos, $key);
			 array_push($campos, $value);
		}

		return $campos;
	}


}
?>