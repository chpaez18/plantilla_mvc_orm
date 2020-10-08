<?php 
//definimos constantes que podremos usar en cualquier sitio
$ruta = getcwd();
$array = explode("\\", $ruta);
$last = array_pop($array);

$GLOBALS['a'] = 1;

define("FOLDER","$last");

define("BASE_URL", "localhost/".FOLDER."/");

define("BASE_URL_ACTION", "localhost/".FOLDER."/../../index.php?url=");

define("DEFAULT_CONTROLLER", "site");

define("DEFAULT_LAYOUT", "nuevo");

define('UPLOADS', BASE_URL . "../../views/layouts/" . DEFAULT_LAYOUT . '/img/' . 'productos');

define("SESSION_TIME", 20);		//establecemos el tiempo minimo en sesion para el usuario, en este ejemplo dejamos 10 minutos

define("HASH_KEY","5956523ba385a");


?>