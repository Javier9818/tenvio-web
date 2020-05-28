<template>

   <div class="row">      
    <div class="col-sm-12 col-md-12 col-lg-12">
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
              <template v-for="empresa in empresas">
                <tr><td colspan="4" > <h4>{{empresa.name_empresa}}</h4></td></tr>
                <tr class="cart__product " v-for="(item, index) of productos" v-if="empresa.name_empresa==item.name_empresa" :key="index">               
                  <td class="cart__product-item">
                    <div class="cart__product-remove">
                      <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
                    </div>
                    <div class="cart__product-img">
                      <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                    </div>
                    <div class="cart__product-title">
                      <h6>{{item.nombre}}</h6>
                    </div>
                  </td>
                  <td class="cart__product-price">S/. {{item.precio}}</td>
                  <td class="cart__product-quantity">
                    <i class="fa fa-minus decrease-qty text-danger  " style=" cursor: pointer" @click="funAdd('-',index)"></i>
                    <span style=" border: lightgray 0.5px solid" class=" px-2">{{item.cant}}</span>
                    <i class="fa fa-plus increase-qty text-success  " style=" cursor: pointer" @click="funAdd('+',index)"></i>
                  </td>
                  <td class="cart__product-total"> 
                    S/. {{item.precio*item.cant}}
                  </td>
                </tr>
              </template>
            <!-- <tr><td colspan="4">sadasd</td></tr>
            <tr class="cart__product " v-for="(item, index) of productos" :key="index">               
              <td class="cart__product-item">
                <div class="cart__product-remove">
                  <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
                </div>
                <div class="cart__product-img">
                  <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                </div>
                <div class="cart__product-title">
                  <h6>{{item.nombre}}{{item.name_empresa}}</h6>
                </div>
              </td>
              <td class="cart__product-price">S/. {{item.precio}}</td>
              <td class="cart__product-quantity">
                <i class="fa fa-minus decrease-qty text-danger  " style=" cursor: pointer" @click="funAdd('-',index)"></i>
                <span style=" border: lightgray 0.5px solid" class=" px-2">{{item.cant}}</span>
                <i class="fa fa-plus increase-qty text-success  " style=" cursor: pointer" @click="funAdd('+',index)"></i>
              </td>
              <td class="cart__product-total"> 
                S/. {{item.precio*item.cant}}
              </td>
            </tr> -->

            <tr class="cart__product-action">
              <td colspan="4">
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content">
                    <!-- <div class="d-flex flex-wrap">
                      <input type="text" class="form-control mb-10 mr-10" placeholder="Cupon de descuento">
                      <button type="submit" class="btn btn-primary mb-10">Aplicar Cupon</button>
                    </div> --> 
                    <button class="btn btn-primary ">Realizar Pedido</button>                                        
                  </div><!-- /.col-lg-2  -->
                </div><!-- /.row  -->
              </td>
            </tr>
          </tbody>
        </table>
      </div><!-- /.cart-table -->
    </div><!-- /.col-lg-12 -->
    <div class="col-sm-12 col-md-6 col-lg-6">
      <div class="cart__shiping">
        <h6>A donde llevamos tu pedido ?</h6>
        <form class="row">
          <div class="col-md-12">
            AQUI VA EL MAPA
          </div>
        </form>
      </div><!-- /.cart__shiping -->
    </div><!-- /.col-lg-6 -->
    <div class="col-sm-12 col-md-6 col-lg-6">
      <div class="cart__total-amount">
        <h6>TOTAL:</h6>
        <ul class="list-unstyled mb-0">
          <li><span>Subtotal :</span><span>S/ {{calcularTotal-calcularTotal*0.18}}</span></li>
          <li><span>IGV :</span><span>S/ {{calcularTotal*0.18}}</span></li>
          <li><span>Órden Total :</span><span>S/ {{calcularTotal}}</span></li>
        </ul>
      </div><!-- /.cart__total-amount -->
    </div><!-- /.col-lg-6 -->
   </div>
</template>

<script>  
import EventBus from '../../event-bus';
export default {      
    data(){
        return {
            productos: [],
            total: 0,
            producto:{descripcion:'',foto:'',nombre:'',precio:'',cant:0, id:0, empresa:0},
            temp_productos:[],
            empresas:[]
        }
    },
    methods:{
      funAdd: function (key,index) {
        
         this.producto=this.productos[index];         
        switch (key) {
          case '+':
            this.producto.cant++;
            break;
          case '-':
            if(this.producto.cant==0)
              break;
            this.producto.cant--;
            break;
          default:
            break;
        }
         this.productos[index]=this.producto;
        let cockie=this.productos;
        this.$cookies.set('carrito',JSON.stringify(cockie))
        ;
        EventBus.$emit('ActualizaEnCart', true);          
      },
        eliminar: function(index){
            this.productos.splice(index,1);
            let cockie=this.productos;
            this.$cookies.set('carrito',JSON.stringify(cockie));           
             EventBus.$emit('elimiarEnCart', true);            
        },
        recarga: function () {
          let cockie=JSON.parse(this.$cookies.get('carrito'));
          this.productos = (cockie==null)? []:cockie; 
          //this.temp(this.productos);
          this.empresas=this.distinct(this.productos);
        },
        temp: function (productos) {
          this.temp_productos= productos.sort(
            function (a, b) {
              if (a.name_empresa < b.name_empresa)
                return -1;
              if (a.name_empresa > b.name_empresa)
                return 1;
              return 0;
            }
          );
          this.empresas=this.distinct(this.temp_productos);
          console.log(this.empresas);
        },
        distinct: function (array) {
          return Array.from(new Set(array.map(s=>s.empresa)))
          .map(
            empresa => {
              return{
                empresa: empresa,
                name_empresa: array.find(s=> s.empresa===empresa).name_empresa
              }
            }
          );
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
        EventBus.$on('EliminarenModal', function(boolean)  {           
          if(boolean)
           this.recarga(); 
        }.bind(this));
    }
}
</script>

<style>

</style>