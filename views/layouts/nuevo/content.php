<?php
use Application\Request;
use Application\Router;
use Application\Session;
?>
<!DOCTYPE html>
<html>
<html xmlns="http://www.w3.org/1999/xhtml">

<title><?php echo $this->titulo;?></title>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    
 
    <link rel="stylesheet" href="<?php echo $_layoutParams['ruta_css']?>bootstrap4.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_css']?>estilos.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_css']?>fontello.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_css']?>dataTables.foundation.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_font_awesome']?>fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_font_awesome']?>all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams['ruta_css']?>photobox.css">
    <link href="<?php echo $_layoutParams['ruta_css']?>bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_layoutParams['ruta_css']?>sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_layoutParams['ruta_froala']?>css/froala_editor.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_layoutParams['ruta_froala']?>css/froala_editor.pkgd.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_layoutParams['ruta_froala']?>css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $_layoutParams['ruta_froala']?>css/themes/dark.min.css" rel="stylesheet" type="text/css" />

        <!-- SCRIPTS JS-->
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>valid.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>messages_es.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_js']?>jquery.photobox.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_froala']?>js/froala_editor.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_froala']?>js/plugins.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_froala']?>js/froala_editor.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_froala']?>js/plugins/link.min.js"></script>
    <script type="text/javascript" src="<?php echo $_layoutParams['ruta_froala']?>js/plugins/image.min.js"></script>

<script src="<?php echo $_layoutParams['ruta_js']?>bootstrap-datepicker.min.js"></script>
<script src="<?php echo $_layoutParams['ruta_js']?>bootstrap-datepicker.es.js"></script>
<script src="<?php echo $_layoutParams['ruta_js']?>bootstrap4.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="<?php echo $_layoutParams['ruta_js']?>vue.js"></script>
<script src="<?php echo $_layoutParams['ruta_js']?>axios.min.js"></script>
<style type="text/css">
  label.error {
    display:inline;
    width:50%;
    color: red;
    padding: 5px;
    margin-bottom: 2px;
}
</style>
<script type="text/javascript" charset="utf-8">
      
   $(document).ready(function() {
     $('#select1').select2({
      minimumResultsForSearch: 10,
      placeholder: "Seleccione...",
      //maximumSelectionLength: 2    definir un maximo de seleccion!! 

    });

$('#datepicker').datepicker({
   format: 'dd/mm/yyyy',
  language: 'es'

});

//validaciones javascript de las vistas lado del cliente
    $("#formulario_login").validate({
      rules:
      {
        nom_usuario:{required:true},
        pass_usuario:{required:true,minlength:6},
        txtcopia: {required:true}
      },

      messages:
      {
          nom_usuario:{required:"Por favor, escriba su nombre de usuario"},          
          pass_usuario:{required:"Por favor, escriba su contraseña", minlength:"Este campo acepta mínimo 6 Caracteres"},
          txtcopia:{required:"Por favor, ingrese el código captcha"}

      },

    });    

    $("#formulario_registro").validate({
      rules:
      {
        cedula:{required:true, digits:true, minlength:7, maxlength:8},
        nom_usuario:{required:true, minlength:4},
        pass_usuario:{required:true,minlength:6},
        confirmar:{required:true, equalTo:"#password"},
        resp_secreta:{required:true, minlength:4},
        confirmar_respuesta:{required:true, equalTo:"#respuesta"},
        nac:{
            required: function(element){
                    if($('#select_nac').val() == "0"){
                        //Set predefined value to blank.
                        $('#select_nac').val('Seleccione...');
                    }
                    return true;
                }
        },
        preg_secreta:{
            required: function(element){
                    if($('#select_pregunta_secreta').val() == "0"){
                        //Set predefined value to blank.
                        $('#select_pregunta_secreta').val('Seleccione...');
                    }
                    return true;
                }
        },

      },

      messages:
      {        
          cedula:{required:"Debe rellenar este campo", digits:"Escriba números enteros", minlength:"Este campo acepta mínimo 7 Digitos", maxlength:"Este campo acepta máximo 8 Digitos"},
          nom_usuario:{required:"Por favor, escriba su nombre de usuario", minlength:"Este campo acepta mínimo 4 Caracteres"},
          pass_usuario:{required:"Por favor, escriba su contraseña",minlength:"Este campo acepta mínimo 6 Caracteres"},
          confirmar:{required:"Debe rellenar este campo", equalTo:"Las contraseñas no coinciden"},
          resp_secreta:{required:"Debe rellenar este campo",  minlength:"Este campo acepta mínimo 4 Caracteres"},
          confirmar_respuesta:{required:"Debe rellenar este campo", equalTo:"Las respuestas no coinciden"},
          nac:{required:"Debe seleccionar una nacionalidad"},
          preg_secreta:{required:"Debe seleccionar una pregunta secreta"},
      },

    });      

    $("#formulario_producto").validate({
      rules:
      {
        nombre_producto:{required:true},
        codigo:{required:true,minlength:6},
        costo: {required:true,number:true},
        descripcion: {required:true}
      },

      messages:
      {
          nombre_producto:{required:"Por favor, escriba el nombre del producto"},          
          codigo:{required:"Por favor, escriba el código del producto", minlength:"Este campo acepta mínimo 6 Caracteres"},
          costo:{required:"Por favor, escriba el costo del producto", number:"Este campo solo acepta números"},
          descripcion:{required:"Por favor, escriba una descripción"}

      },

    });  

    $('input[name^="fileupload"]').rules('add', {
        required: true,
        accept: "image/jpeg, image/pjpeg"
    })
//fin de las validaciones javascript 


    $('#datatables').DataTable( {
        "iDisplayLength": 5,
        "order": [0,"asc"],
        "language": {
            "lengthMenu": "",
            "sInfo": "Se Muestran _START_-_END_ de _TOTAL_ Registros",
            "zeroRecords": "Sin Resultados.",
            "sEmptyTable":    "Ningún Registro Disponible",
            "info": "Página N° _PAGE_ de _PAGES_",
            "infoEmpty": "Sin Resultados",
            "sSearch":        "Búsqueda General:",
            "sLoadingRecords": "Cargando...",
            "infoFiltered": "",
            "paginate": {
                        "first":      "<i class='fa fa-fast-backward'></i> Primero",
                        "last":       "Último <i class='fa fa-fast-forward'></i>",
                        "next":       "Siguiente <i class='fa fa-arrow-right'></i>",
                        "previous":   "<i class='fa fa-arrow-left'></i> Anterior"
                    },
        }
    } );
} );

    </script>

  </head>
<body>
    
  <header>




<nav class="navbar navbar-expand-lg navbar-dark bg-primary  ">
  <a class="navbar-brand" href="#">Tienda Virtual</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php 
       $var = explode("index.php",$_SERVER["REQUEST_URI"]);
       for ($i=0; $i< count($menu); $i++){ 
        
        $var2 = explode("index.php",$menu[$i]["enlace"]);
      ?>
      <li class="nav-item <?= ($var2[1] == $var[1] ? 'active':'') ?>">
        <a class="nav-link" href="<?= $menu[$i]["enlace"]?>"> <i class="<?= (isset($menu[$i]["icon"]) ? $menu[$i]["icon"]:'') ?>" aria-hidden="true"></i>  <?= $menu[$i]["titulo"]?></a>
      </li>
      
      <?php } ?>
      
    </ul>
    
  </div>
  <?php if(Session::get('cod_usuario')){ 
  ?>
  
      
    <div class="float-left" id="general">
    <ul class="navbar-nav">
      <li class="nav-item active" style="display:inline">
      <a class="nav-link active" href="<?= ROUTER::create_action_url("productos/cart")?>"><i class="fas fa-shopping-cart"></i> <span v-show="cartAmount" class="badge badge-pill badge-danger"> {{cartAmount}} </span> </a></li>
      <li class="nav-item active" style="display:inline">
      <a class="nav-link" href="<?= ROUTER::create_action_url("site/cerrar")?>"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> <?= 'Cerrar Sesión ('.Session::get("nom_usuario").")" ?> </a>
      </li>
      </ul>
    </div>
  <?php } ?>
</nav>

<script>

var applicationGeneral = new Vue({
    el:'#general',
    data(){
            return {
                cartAmount: null
            }
        },

        ready: function(){
            this.fetchAllData()
        },

        mounted () {
           setInterval(() =>{
              axios
              .get('http://localhost/api_prueba_tecnica/cart/get-count-user-products/<?= Session::get('cod_usuario') ?>')
              .then(response =>(this.cartAmount = response.data.data ) )
           },(10*60))
        }
});

</script>



  </header>

      <main>
        <section>
        <br>
          <center>
            <div id="mensajes" class="cont">

                  <?php 
                  if(isset($this->error)){ ?>

                    <div class="alert alert-danger"><?php if(isset($this->error)) echo $this->error;?></div>
                  
                  <?php } ?>

                    <?php if(isset($this->mensaje)){ ?>

                      <div class="alert alert-info"><?php if(isset($this->mensaje)) echo $this->mensaje;?></div>

                      <?php } ?>
                      

                      <?php 

                        if(isset($_GET["ok"]) ){

                           if( $_GET["ok"] ==1){

                            echo "<div class='alert alert-info'>Producto agregado con éxito.</div><br>";

                           }else if ($_GET["ok"] == 2){

                            echo "<div class='alert alert-info'>Producto eliminado con éxito.</div><br>";

                           }else if ($_GET["ok"] == 6){

                            echo "<div class='alert alert-info'>Registro completado con éxito, ahora puede iniciar sesión.</div><br>";

                          }else if ($_GET["ok"] == 7){

                            echo "<div class='alert alert-danger'>Porfavor seleccione una o varias imágenes</div><br>";
                           }
                        }

                      ?>


                 </div>
          </center>


          <div class="container">
            <br>
          <?php 
          $request = new Request();
          $controlador = ucwords($request->getControlador());
          $ruta =  ROUTER::create_action_url("site/index");

          
          if($request->getControlador() == "site" and $request->getMetodo() == "index" or $request->getControlador() == "error" and $request->getMetodo() == "access" or $request->getControlador() == "site" and $request->getMetodo() == "login" or $request->getControlador() == "site" and $request->getMetodo() == "registro" or $request->getControlador() == "site" or $request->getControlador() == "site"){
            $controlador = "";
            $ruta = "";
          }else{
            if($controlador == "Site"){
              $visible = "none";
            }else{
              $visible = "inline";
            }
          ?>
            <nav class="breadcrumb">
              <a style="display: <?= $visible ?>" class="breadcrumb-item" href="<?= $ruta ?>"><?= 'Inicio'?></a>
              <span class="breadcrumb-item active"><?= $this->titulo?></span>
            </nav>
            <br>
          <?php }?>

            <?php include_once $rutaView; ?>
          </div>

          <center><p id="d" style="background-color:  color: #A94566 ; border-radius: 5px; border-color: #EED5D7;"></center>

        </section>
      </main>
      
  </body>
</html>