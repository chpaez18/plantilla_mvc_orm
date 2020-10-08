<?php
use Models\ProductosImagenes;
use Models\Productos;
use Application\Controller;
use Application\Session;

/**
* 
*/
class ProductosController extends Controller
{

	//metodo que llama al metodo constructor de la clase padre
	public function __construct(){

		parent::__construct();
		
	}

	public function index(){}

	//funcion que renderiza la vista del listado de productos
	public function list(){

		//verificamos si el usuario se encuentra logueado, si no lo redireccionamos al login
		if(Session::get("autenticado")){
			
			$model = new Productos();
			$this->_view->titulo = "Listado de Productos";

			$this->_view->render("list", 'productos',["model"=>$model,]);
		}else{
			$this->redirect("site/index");
		}
	}		

	//funcion que renderiza la vista del carrito de compras
	public function cart(){

		//verificamos si el usuario se encuentra logueado, si no lo redireccionamos al login
		if(Session::get("autenticado")){
			
			$model = new Productos();
			$this->_view->titulo = "Carrito de compras";

			$this->_view->render("cart", 'productos',["model"=>$model,]);
		}else{
			$this->redirect("site/index");
		}
	}

	//funcion que renderiza la vista del formulario para agregar un nuevo producto
	public function create(){

		//verificamos si el usuario se encuentra logueado, si no lo redireccionamos al login
		if(Session::get("autenticado")){
			
			$model = new Productos();
			$this->_view->titulo = "Agregar nuevo producto";

			if(!empty($_POST))
			{
				//instanciamos un objeto pasando la info recibida por POST
				$producto = new Productos ($_POST);
				$model->nombre = $producto->nombre;
				$model->codigo = $producto->codigo;
				$model->costo = $producto->costo;
				$model->descripcion = $producto->descripcion;

				//usamos la libreria para cargar imagenes
				$image = new Bulletproof\Image($_FILES);
				$image->setSize(1024, 10000000); //min 1KB, max 9MB
				$absolute_route = UPLOADS; //establecemos una ruta para guardar el archivo fisico
				$explode = explode("../", $absolute_route); 
				$partial_route = $explode[2]; //establecemos una ruta para guardar en la base de datos

				//seteamos la ruta donde se guardara la imagen
				$image->setLocation($absolute_route);
				
				if($image["foto_ref"]){
					$upload = $image->upload();  //cargamos la imagen
					$foto_ref = $partial_route.'/'.$upload->getName().'.'.$upload->getMime();
				}
				$model->foto_ref = $foto_ref; //establecemos la ruta completa hasta la imagen
				
				if($model->save()){
					$this->redirect("site/index&ok=1");
				}
			}else{
				$this->_view->render("create", 'productos',[
					"model"=>$model
				]);
			}
			
		}else{
			$this->redirect("site/index");
		}
	}

	//funcion que renderiza la vista del detalle de un producto
	public function view($id){

		//verificamos si el usuario se encuentra logueado, si no lo redireccionamos al login
		if(Session::get("autenticado")){	

			$model = Productos::find($id);
           
			if(!empty($_FILES)){
				
				//validamos que el usuario seleccione almenos una imagen, de lo contrario redirijimos con un mensaje de advertencia
				if($_FILES["imagen"]["name"][0] == null){
					$this->redirect("productos/view/".$model->cod_producto."&ok=7");
				}
				
				for($i = 0; $i < count($_FILES['imagen']['name']); $i++) {
 
					$arr_file = array(
						"name" => $_FILES['imagen']['name'][$i],
						"type" => $_FILES['imagen']['type'][$i],
						"tmp_name" => $_FILES['imagen']['tmp_name'][$i],
						"error" => $_FILES['imagen']['error'][$i],
						"size" => $_FILES['imagen']['size'][$i],
					);
					
			 
					$image = new Bulletproof\Image($arr_file);
					$image->setSize(1024, 10000000); //min 1KB, max 9MB
					$absolute_route = UPLOADS; //para guardar el archivo fisico
					$explode = explode("../", $absolute_route); 
					$partial_route = $explode[2]; //para guardar en la base de datos
					
					//seteamos la ruta donde se guardara la imagen
					$image->setLocation($absolute_route);
					
					$upload = $image->upload(); 
					$foto = $partial_route.'/'.$upload->getName().'.'.$upload->getMime();
					
					$producto = new ProductosImagenes();
					$producto->cod_producto = $model->cod_producto;
					$producto->imagen = $foto;
					$producto->save();
				}
				$this->redirect("productos/view"."/".$id);

			}else{
				$this->_view->titulo = "Información detallada del producto";

				$this->_view->render("view", "productos",[
					"model"=>$model
				]);
			}

		}else{
			$this->redirect("site/index");
		}
	}

}

?>