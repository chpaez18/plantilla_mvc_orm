<?php
use Application\Router;
use Application\Session;
?>
<center class = "bienvenida" ></center>

<legend>
    <h1>Listado de todos los productos</h1>
</legend>
<hr>
             
        
<div id="index">

    <div class="row">
        
        <div class="col-md-4" v-for="row in allData">
            <a v-on:click="redirectView(row)">
            <div class="item" style="" >
                <div class="item-foto" v-bind:style="{ backgroundImage:  'url('+row.foto_ref +')' }" >
                    
                </div>
                <div class="card-body">
                    
                    <center><h5 class="card-title">{{row.nombre}}</h5></center>
                   <div class="type">{{row.codigo}}</div>
                   </a>
                   <div class="item-price-left"> 
                        <button value="2" v-on:click="addCart(row)" class="btn btn-light"> 
                            <img  src="views/layouts/nuevo/img/carti.png"> 
                        </button> 
                        <span v-if="row.cant_carrito !=0  "  class="badge badge-primary float-right">En el carrito:  {{ row.cant_carrito }}  </span> 
                    </div>
                    
                   <div class="item-price">${{row.costo}}</div>
                </div>
            </div>
        </div>
    </div>
    <div v-show="!allData" class="float-center">
        <center>No hay productos registrados</center>
    </div>

<br>
<br>
    <div class="float-right">
        
    </div>
<br>
<br>
<br>
<br>
</div>

            


  <script>

    var application = new Vue({
        el:'#index',
        data(){
            return {
                allData: null,
                carrito: true
            }
        },

        methods:{
            getFunction: function(object, codusuario){
                axios
                .get('http://localhost/api_prueba_tecnica/productos/get-cant-products-on-cart/'+codusuario+'/'+object.cod_producto)
                .then(response =>(this.carrito = response.data.data ) )
               
            },

            redirectView(object){
               window.location.href = '<?= ROUTER::create_action_url('productos/view')?>'+'/'+object.cod_producto
            },
            addCart(object){
                
                axios
                .post('http://localhost/api_prueba_tecnica/cart/add-product-cart',{
                    cod_usuario : <?= Session::get('cod_usuario') ?>,
                    cod_producto : object.cod_producto,
                })
                .then(response =>{console.log(response)})
                .catch(error =>{console.log(error)})
                swal('Producto Agregado al Carrito!', 'El producto: '+object.nombre+' se agregó correctamente al carrito de compras', 'success');
            }
        },

        ready: function(){
            this.fetchAllData()
        },

        mounted () {
            setInterval(() =>{
                axios
                .get('http://localhost/api_prueba_tecnica/productos/get-products/<?= Session::get('cod_usuario') ?>')
                .then(response =>(this.allData = response.data.data ) )
            },(10*60))
            
        }
    });

  </script>

  