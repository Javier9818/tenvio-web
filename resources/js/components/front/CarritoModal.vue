<template>
    <div>
                <ul class="list-unstyled">

                   <li class="cart-item">
                    <div class="cart__item-img"><img src="assets/images/shop/grid/1.jpg" alt="thumb"></div>
                    <div class="cart__item-content">
                      <h6 class="cart__item-title">1/4 Pollo a la brasa</h6>
                      <div class="cart__item-detail">S/. 8.00</div>
                      <i class="cart__item-delete">&times;</i>
                    </div><!-- /.cart-item-content -->
                  </li>

                </ul>
                <div class="cart-subtotal">
                  <span>Total:</span>
                  <span class="color-theme">S/ 16.00</span>
                </div><!-- /.cart-subtotal -->
                <div class="cart-action d-flex justify-content-between">
                  <a href="#" class="btn btn__primary btn__hover2">Ver Pedidos</a>
                  <a href="#" class="btn btn__white">Finalizar</a>
                </div><!-- /.cart-action -->
    </div>
</template>

<script>
export default {
    mounted() {
            console.log('Carrito Modal cargado en Mounted.')
        }
}
</script>
