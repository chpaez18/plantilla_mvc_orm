<?php
use Application\Router;
use Application\Session;
?>

<div id="view">
    <div class="row">
        <div class="box col-md-6" style="max-width:250px; max-height:250px; width:70px">
            <img src="<?= $model->foto_ref ?>" ></img>
        </div>
        <div class="col-md-6" style="max-width:60%; max-height:40%">
            <div>
                    <h5><?= $model->nombre?></h5>
                        <p class="mb-2 text-muted text-uppercase small"><?= $model->codigo?></p>

                        <p><span class="mr-1"><strong><?= $model->costo?>$</strong></span></p>
                        <p class="pt-1"><?= $model->descripcion?></p>

                        <hr>
                        <button type="button"  v-on:click="addCart(<?= $model->cod_producto ?>)" class="btn btn-light btn-md mr-1 mb-2 waves-effect waves-light"><i class="fas fa-shopping-cart pr-2"></i>Agregar al carrito</button>
            </div>
        </div>
    </div>    



<?php
$producto = $model->gallery->toArray();
?>
<div class="float-left">
<h5> <i class="fas fa-images"></i> Galeria de imágenes</h5>
</div>
<div class="float-right">
    <form enctype="multipart/form-data" id="formulario_producto_view" name="form2" method="post" action="<?= ROUTER::create_action_url("productos/view")."/".$model->cod_producto?>">
        <input type="file"  name = 'imagen[]' multiple>
        <button id="submitButton" type="submit" class="btn btn-primary btn-sm" ><i class="fas fa-upload"></i></button>
    </form>
</div>
<br>
<hr>

<div id='gallery'>
    <div class="row">
        <?php if($producto){ ?>
            <?php foreach($producto as $gallery){  ?>
                <div class="box col-md-4" style="max-width: 250px; max-height: 100px; width: 70px;">
                        <a href="<?= $gallery["imagen"] ?>">
                            <img class="img-responsive" src="<?= $gallery["imagen"] ?>" ></img>
                        </a>
                        <button type="button" v-on:click="removeGallery('<?= $gallery["imagen"] ?>')" class="btn btn-danger btn-block"><i class="fas fa-trash" aria-hidden="true"></i></button>
                        
                </div>   
            <?php } ?>
        <?php }else{ ?>
            <div class="float-center">
                <center>Este producto no posee imágenes en su galería</center>
            </div>
        <?php } ?>
        
    </div>
</div>
</div>










<script>

var application = new Vue({
    el:'#view',
    data(){
        return {
            allData: null,
        }
    },

    methods:{
        addCart(object){
            
            axios
            .post('http://localhost/api_prueba_tecnica/cart/add-product-cart',{
                cod_usuario : <?= Session::get('cod_usuario') ?>,
                cod_producto : object,
            })
            .then(response =>{console.log(response)})
            .catch(error =>{console.log(error)})
            swal('Producto Agregado al Carrito!', 'Este producto se agregó correctamente al carrito de compras', 'success');
        },
        removeGallery(object){
            axios
            .post('http://localhost/api_prueba_tecnica/productos/remove-gallery',{
                imagen : object
            })
            .then(response =>{console.log(response)})
            .catch(error =>{console.log(error)})
           
            swal({
                title: "Imagen eliminada",
                text: "La imagen se ha eliminado correctamente",
                type: "success",
                confirmButtonText: "OK"
            },
                function(isConfirm){
                if (isConfirm) {
                    window.location.href = "<?= ROUTER::create_action_url('productos/view')."/".$model->cod_producto; ?>";
                }
            }); 
        }
    },

    ready: function(){
        this.fetchAllData()
    }
});

$('#gallery').photobox('a',{ time:0 });
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

</script>



<br>
<br>
<br>
