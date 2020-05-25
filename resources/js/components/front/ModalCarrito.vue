<template>
    <div>
        <ul class="list-unstyled">
            <li class="cart-item" v-for="(item, index) of productos" :key="index">
            <div class="cart__item-img"><img :src="'/img/productos/'+item.foto" alt="Product"></div>
            <div class="cart__item-content">
                <h6 class="cart__item-title"> [ {{item.cant}} ] {{item.nombre}}</h6>
                <div class="cart__item-detail">S/. {{item.precio}}</div>
                <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
            </div><!-- /.cart-item-content -->
            </li>
        </ul>
        <div class="cart-subtotal">
            <span>Total:</span>
            <span class="color-theme">S/ {{calcularTotal}}</span>
        </div><!-- /.cart-subtotal -->
        <div class="cart-action d-flex justify-content-between">
            <a href="#" class="btn btn__primary btn__hover2">Ver Pedidos</a>
            <a href="#" class="btn btn__white">Finalizar</a>
        </div><!-- /.cart-action -->
    </div>
</template>

<script>
     
       import EventBus from '../../event-bus';
    export default {      
        data(){
            return {
                productos: [ 
                ],
                total: 0
            }
        },
        methods:{
            eliminar: function(index){                 
                this.productos.splice(index,1);
                let cockie=this.productos;
                this.$cookies.set('carrito',JSON.stringify(cockie));                 
            },
            recarga: function () {
                let cockie=JSON.parse(this.$cookies.get('carrito'));
                if (cockie==null) {
                    cockie=[];
                }                
                this.productos=cockie;
            } 
        },
        computed:{
            
            calcularTotal(){
                this.total = 0;
                var item;
                this.productos.forEach(element => {
                     this.total = this.total + (element.precio*element.cant);
                });                
                return this.total;
            }
        },
        mounted() {
            this.recarga();

            console.log('ModalCarrito - Mounted')
        },
        created: function () {
            EventBus.$on('i-got-clicked', function(producto)  {           
            let cockie=JSON.parse(this.$cookies.get('carrito'));
            if (cockie==null) {
                cockie=[];
            }
            cockie.push(producto);
            this.productos=cockie;          
            this.$cookies.set('carrito',JSON.stringify(cockie));             
            }.bind(this));
        }
    }
</script>
