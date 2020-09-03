 <template>
  <div>
    <div >
     
      <div class="cart-table table-responsive" >
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr class="cart__product " v-for="(item, index) of productos" :key="index">
              <template v-if="empresa.name_empresa === item.name_empresa">
                  <td class="cart__product-item">
                    <div class="cart__product-remove">
                    <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
                    </div>
                    <div class="cart__product-img">
                        <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                    </div>
                    <div class="cart__product-title mt-1">
                        <h6>{{item.nombre}}</h6>
                    </div>
                </td>
                <td class="cart__product-price">S/. {{item.precio}}</td>
                <td class="cart__product-quantity">
                  <b-form-spinbutton id="demo-sb" @change="funAdd(item,index)" v-model="item.cant" min="1" max="50"></b-form-spinbutton>                   
                </td>
                <td class="cart__product-total">
                    S/. {{item.precio*item.cant}}
                </td>
              </template>
            </tr>
          </tbody>
        </table>
      </div><!-- /.cart-table -->
       
    </div>
  </div>
</template>

<script>
import EventBus from '../../event-bus'
export default {
  props:['productos','empresa'],
  data(){
    return{ 
      productos1:[]
    }
  },
  methods:{    
    //Agrega o quita cantidad a producto
    funAdd: function (item,index) {      
      this.productos[index]=item
      let cockie=this.productos
      this.$cookies.set('carrito',JSON.stringify(cockie))
      EventBus.$emit('ActualizaEnCart', true)
    },
     //Elimina un producto del carrito
    eliminar: function(index){
      this.productos.splice(index,1)
      let cockie=this.productos
      this.$cookies.set('carrito',JSON.stringify(cockie))
      EventBus.$emit('elimiarEnCart', true) 
    },
  },
  mounted(){
     
  }
}
</script>

<style>

</style>