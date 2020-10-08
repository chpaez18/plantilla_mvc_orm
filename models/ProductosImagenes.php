<?php
 
namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;
 
class ProductosImagenes extends Model {
     
    protected $table = 'productos_imagenes';
    public $primaryKey = 'cod_producto_imagen';
    public $timestamps = false;
    protected $fillable = ["cod_producto", "imagen"];

    /* RELATIONS */

    public function charge()
    {
        return $this->hasOne(ChargesModel::class,'id_charge','id_charge');
    }
    /* RELATIONS */


}
 
?>