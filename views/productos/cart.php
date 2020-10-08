<?php
use Application\Router;
use Application\Session;
?>
<div  id="cart">
        <!-- Carrito -->
        <aside class="col-md-12">
            <h2> <i class="fas fa-shopping-cart"></i> Carrito</h2>
            <!-- Elementos del carrito -->

            <div class="row">
                        <div  class="col-md-4" v-for="row in allData">
                        <div class="item" style="" >
                        <button style="margin:5px" value="2" v-on:click="removeCart(row)" class="btn btn-danger"> 
                                        remover
                                    </button> 
                                    <span style="margin:5px" class="badge badge-primary float-right">En el carrito:  {{ row.cantidad }}  </span>
                            <div class="item-foto" v-bind:style="{ backgroundImage:  'url('+row.producto.foto_ref +')' }" >
                                
                            </div>
                            <div class="card-body">
                                <center><h5 class="card-title">{{row.producto.nombre}}</h5></center>
                            <div class="type">{{row.producto.codigo}}</div>
                            <div class="item-price-left"> 
                                    <button value="2" v-on:click="addCart(row)" class="btn btn-light"> 
                                        <img  src="views/layouts/nuevo/img/carti.png"> 
                                    </button> 

                                     
                                </div>
                                
                            <div class="item-price">${{row.producto.costo}}</div>
                            </div>
                        </div>
                    </div>
                   
            </div>
                <div v-show="!allData" class="float-center">
                    <center>El carrito está vacío</center>
                </div>
                    <br>
            <hr>
            <!-- Precio total -->

            <p class="text-right">Total: {{total}} $
            <p class="text-left"> <button v-on:click="removeAllCart()" id="boton-vaciar" class="btn btn-danger float-left"> <i class="fas fa-trash-alt"></i> Vaciar Carrito</button></p>
        </p>
            
            
        </aside>
</div>
<br>
<br>
<br>



<script>

var application3 = new Vue({
    el:'#cart',
    data(){
        return {
            allData: null,
            total: 0
        }
    },

    methods:{
        
        addCart(object){
            
            axios
            .post('http://localhost/api_prueba_tecnica/cart/add-product-cart',{
                cod_usuario : <?= Session::get('cod_usuario') ?>,
                cod_producto : object.cod_producto,
            })
            .then(response =>{console.log(response)})
            .catch(error =>{console.log(error)})
            swal('Producto Agregado al Carrito!', 'El producto: '+object.nombre+' se agregó correctamente al carrito de compras', 'success');
        },

        removeCart(object){
            
            axios
            .delete('http://localhost/api_prueba_tecnica/cart/remove-product-cart/<?= Session::get('cod_usuario') ?>/'+object.cod_producto)
            .then(response =>{console.log(response)})
            .catch(error =>{console.log(error)})
            swal('Producto Eliminado del Carrito!', 'El producto: '+object.producto.nombre+' se elimino correctamente del carrito de compras', 'success');
        },
        removeAllCart(){
            
            axios
            .delete('http://localhost/api_prueba_tecnica/cart/remove-all-cart/<?= Session::get('cod_usuario') ?>')
            .then(response =>{console.log(response)})
            .catch(error =>{console.log(error)})
            swal('Carrito Vacío', 'Todos los productos dentro del carrito se han eliminado de forma correcta', 'success');
        }
    },

    ready: function(){
        this.fetchAllData()
    },

    mounted () {
       
        setInterval(() =>{
            axios
            .get('http://localhost/api_prueba_tecnica/cart/get-user-products/<?= Session::get('cod_usuario') ?>')
            .then(response =>(this.allData = response.data.data ) )
        },(10*60))

        setInterval(() =>{
            axios
            .get('http://localhost/api_prueba_tecnica/cart/get-user-products-total/<?= Session::get('cod_usuario') ?>')
            .then(response =>(this.total = response.data.data ) )
           },(10*60))
        
    }
});

</script>




