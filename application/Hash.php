<?php 

/**
* Clase que funciona para reforzar el hash de encriptamiento de contraseñas
*/
class Hash 
{
	
	//metodo estatico para que pueda ser llamado tanto en los modelos como en los controladores dependiendo de la necesidad

	//pasamos 3 parametros a este metodo, el algoritmo de encriptacion la data a encriptar y una llave que va a reforzar dicha encriptacion
	public static function getHash($algoritmo, $data, $key)
	{

		$hash = hash_init($algoritmo, HASH_HMAC, $key);
		hash_update($hash, $data);
		
		//devuelve la encriptacion
		return hash_final($hash);
	}


}

?>