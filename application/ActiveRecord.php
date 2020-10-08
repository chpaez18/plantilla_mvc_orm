<?php
namespace Application;
use Application\ActiveRecord;
use Models\Site;
/**
* 
*/
class ActiveRecord
{
	static $class;
	static $logueado;
	static $id_user;
	function __construct()
	{
		# code...
	}

	
	public static function getColumns($table_name = false){

		$class_name = $table_name;
		$model = new ActiveRecord;

		if($table_name){

			$data = $model->db->query("select * from $table_name");
		}else{
			$data = $model->db->query("select * from $model->name");

		}
		
		$cant = count($data);
		$cant_fields = $data->ColumnCount();
		//devuelve un arreglo con el tipo de dato del campo
		$resp = $data->fetchall();

		$x=0;
		$y=0;

		/*
		devuelve un arreglo solo con los nombres de los campos de la tabla
		$respuesta = array_keys($data->fetch(PDO::FETCH_ASSOC));
		*/


			while ($x <= $cant_fields-1) {
				$response[$x] = $data->getColumnMeta($x);
				$x++;
			}
				
			return $response;
	}

	public static function validateTableFields($table_name){
		$model = new ActiveRecord;

		$fields = self::getColumns($table_name); //obtenemos los campos de la tabla
		$index = (array) $fields;
		$campos_tabla = ArrayHelper::map($index, 'name', 'name'); //campos de la tabla

		foreach ($_POST as $key => $value) {
			if (array_key_exists($key, $campos_tabla)) {

			}else{

					if(property_exists(ActiveRecord::$class, $key)){
						
					}else{
						throw new Exception("El atributo $key no existe en la tabla",1);
						exit;
					}

			}
		}

		return true;
	}
}
?>