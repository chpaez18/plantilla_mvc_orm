<?php
use Application\Router;
?>
<center class = "bienvenida" ></center>

<legend>
    <h1><i>Bienvenido(a) <?= $model->nom_usuario ?></i></h1>
</legend>
<hr>
             
        
<div id="index">
    <h6>Ultimos 6 productos agregados</h6>
    <div class="row">
        
        <div class="col-md-4" v-for="row in allData">
            <a v-on:click="redirectView(row)">
                <div class="item" style="" >
                    <div class="item-foto" v-bind:style="{ backgroundImage:  'url('+row.foto_ref +')' }" >
                        
                    </div>
                    <div class="card-body">
                        <center><h5 class="card-title">{{row.nombre}}</h5></center>
                    <div class="type">{{row.codigo}}</div>
                    <div class="item-price-left"> 
                        
                        </div>
                        
                    <div class="item-price">${{row.costo}}</div>
                    </div>
                </div>
            </a>

        </div>
    </div>
    <div v-show="!allData" class="float-center">
        <center>No hay productos registrados</center>
    </div>
<br>
<br>
    <div v-show="allData">
        <div class="float-right">
            <a href="<?php echo ROUTER::create_action_url("productos/list")?> "><button class="btn btn-outline-primary"><i class="fas fa-shopping-basket" aria-hidden="true"></i> <b>Ver más productos </b></button></a>
        </div>
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
                allData: null
            }
        },

        methods:{
            redirectView(object){
               window.location.href = '<?= ROUTER::create_action_url('productos/view')?>'+'/'+object.cod_producto
            }
        },
        ready: function(){
            this.fetchAllData()
        },

        mounted () {
            axios
            .get('http://localhost/api_prueba_tecnica/productos/get-last-products/6')
            .then(response =>(this.allData = response.data.data ) )
        }
    });

  </script>