<?php 
require 'vendor/autoload.php';
use Models\Database;
use Application\Session;
use Application\Bootstrap;
use Application\Request;

//declaramos unas constantes
define('DS',DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('VIEWS', ROOT . 'views' . DS);
define('LIB', ROOT . 'views' . DS . 'layouts' . DS . 'default' . DS . 'lib' . DS);

try{
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Router.php';
	require_once APP_PATH . 'Controller.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'Hash.php';
	require_once APP_PATH . 'Utilities.php';

	//MODELOS DE HELPERS AUXILIARES
	require_once APP_PATH . 'ArrayHelper.php';
	require_once APP_PATH . 'BaseArrayHelper.php';
	require_once APP_PATH . 'App.php';

	//Initialize Illuminate Database Connection
	new Database();

	Session::init();
	Bootstrap::run(new Request);

}catch(Exception $e){

	echo $e->getMessage();

}


?>