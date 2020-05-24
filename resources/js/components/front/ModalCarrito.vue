<template>
    <div>
                <ul class="list-unstyled">
                   <li class="cart-item" v-for="(item, index) of productos" :key="index">
                    <div class="cart__item-img"><img src="assets/images/shop/grid/1.jpg" alt="thumb"></div>
                    <div class="cart__item-content">
                      <h6 class="cart__item-title"> [ {{item.cantidad}} ] {{item.nombre}}</h6>
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
    export default {

        data(){
            return {
                productos: [
                    {'nombre': '1/4 pollo + papa + ensalada', 'cantidad': 1, 'precio': 25.00},
                    {'nombre': '1 gaseosa', 'cantidad': 2 , 'precio': 32.00},
                    {'nombre': '1 parrilla', 'cantidad': 2 , 'precio': 18.00}
                ],
                total: 0
            }
        },
        methods:{
            eliminar: function(index){
                this.productos.splice(index,1);
            }
        },
        computed:{
            calcularTotal(){
                this.total = 0;
                var item;
                for(item of this.productos){
                    this.total = this.total + (item.precio*item.cantidad);
                }
                return this.total;
            }
        },
        mounted() {
            console.log('ModalCarrito - Mounted')
        }

    }
</script>
