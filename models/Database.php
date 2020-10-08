<?php
namespace Models; 
use Illuminate\Database\Capsule\Manager as Capsule;
 
class Database {
 
    function __construct() {
    $capsule = new Capsule;
    $capsule->addConnection([
     'driver' => 'mysql',
     'host' => 'localhost',
     'database' => 'prueba_tecnica',
     'username' => 'root',
     'password' => 'importmotor#',
     'charset' => 'utf8',
     'collation' => 'utf8_unicode_ci',
     'prefix' => '',
    ]);
    // Setup the Eloquent ORM… 
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
}
 
}
?>