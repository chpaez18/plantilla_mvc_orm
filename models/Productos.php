<?php
 
namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;
 
class Productos extends Model {
     
    protected $table = 'productos';
    public $primaryKey = 'cod_producto';
    public $timestamps = false;
    protected $fillable = ["nombre", "descripcion", 'costo', 'codigo', 'foto_ref'];

    /* RELATIONS */

    public function gallery()
    {
        return $this->hasMany(ProductosImagenes::class,'cod_producto','cod_producto');
    }
    /* RELATIONS */

}
 
?>