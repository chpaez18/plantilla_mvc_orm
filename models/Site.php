<?php
namespace Models;
use \Illuminate\Database\Eloquent\Model;
use Application\ActiveRecord;
/**
* 
*/
class Site extends Model
{


    protected $table = 'usuario';
    public $primaryKey = 'cod_usuario';
    public $timestamps = false;
	protected $fillable = ["nom_usuario", "pass_usuario",'ssid'];
	
	public function validateUser(){
		$data = Site::whereRaw('nom_usuario = ? and pass_usuario = ?', [$this->nom_usuario,$this->pass_usuario])->first();
		if(!$data){
			return false;
		}else{
			return $data;
		}
	}

	public function validateUsername(){
		$data = Site::whereRaw('nom_usuario = ? ', [$this->nom_usuario])->first();
		if(!$data){
			return false;
		}else{
			return $data;
		}
	}
}
?>