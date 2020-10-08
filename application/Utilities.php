<?php

/**
*
Clase que contiene varias funciones utilitarias para la aplicación
*/
class Utilities
{
	

	/*=============
	retorna un string filtrado, sin acentos, tildes etc.
	===============*/
	static function cleanString($cadena) {

		//$cade = utf8_decode($cadena);

		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
		
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
		return $texto;
	}	


	/*=============
	nos devuelve la fecha formateada en español
		Formato de $date = yyyy-mm-dd
		retorna = dd/mm/yyyy
	===============*/
	static function FormatDateEs($date) {
		$l = strlen($date);
		$res = "";
		if ($l >= 10) {
			$res = substr($date,8,2)."/".substr($date,5,2)."/".substr($date,0,4);
				
		}
		return($res);
	}


	/*=============
	Retorna un valor enviado por GET
	===============*/

	static function RequestGet($var) {
		$res = "";
		if(isset($_REQUEST[$var])){
			$res = $_REQUEST[$var];
		}
			
		return $res;
	}


	/*=============
	Retorna true si $val tiene informacion, y false si no tiene, funcion para validar campos de formularios por ejemplo
	===============*/
	static function validate($val) {
		$res = false;
		if (isset($val) && ($val != "")){
			$res = true;
		}
		return ($res);
	}

	/*=============
	Valida que la cadena no contenga caracteres especiales, y admita solo caracteres alfabeticos
	===============*/
 	static function validateEspecialChars($val) {
		$res = false;
		if (isset($val) && ($val != "") && preg_match("/^[a-zA-Záéíóúñ()0-9\s]+$/i",$val)){
			$res = true;
		}
		return ($res);
	}


	/*=============
	Funcion para construir un array, el & en el parametro quiere decir que la funcion solo recibira parametros por referencia, es decir guardadas en una variable
	===============*/
		function buildArray(&$A)  {
			$cant = count($A);
			$B = [];
			
			$B[] = $A;
	
			return $B;
		}

	/*=============
	Retorna un alert con un mensaje especifico
	===============*/
	static function alert($msg) {
		$msg = str_replace('"','', $msg);
		$msg = str_replace("'","", $msg);
		echo '<SCRIPT language="javascript" type="text/javascript">';
			echo 'alert("'.$msg.'");'; 
        echo '</SCRIPT>';
   	}





}

?>