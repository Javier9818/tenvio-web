<template>
  <div>
    <div class="panel-group">
      <div class=" row">
        <div class=" col-12 col-lg-4">
          <h3>Tu pedido</h3>
          <div class="panel panel-info">           
            <div class="panel-body">
                <ul class="list-group">
                  <li class="list-group-item">Fecha: {{pedido.date}}</li>
                  <li class="list-group-item">Empresa: {{pedido.empresa}}</li>
                  <li class="list-group-item" style=" color: green">{{pedido.state}}</li>                 
                </ul>
            </div>
          </div>
        </div>
        <div class=" col-12 col-lg-8">
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
                <tr class="cart__product " v-for="(item, index) of detalle" :key="index">                  
                  <td class="cart__product-item">                     
                    <div class="cart__product-img">
                        <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                    </div>
                    <div class="cart__product-title mt-1">
                        <h6>{{item.nombre}}</h6>
                    </div>
                  </td>
                  <td class="cart__product-price">S/. {{item.precio_unit}}</td>
                  <td class="cart__product-quantity">                       
                    <span style=" border: lightgray 0.5px solid" class=" px-2">{{item.cantidad}}</span>                      
                  </td>
                  <td class="cart__product-total">
                      S/. {{item.precio_unit*item.cantidad}}
                  </td>                   
                </tr>
                <tr><td colspan="3"></td><td class=" text-center" style=" font-weight: bolder font-size:1rem">S/. {{calcularTotal}} </td></tr>
              </tbody>
            </table>
          </div><!-- /.cart-table -->
        </div>
        <div class=" col-12 col-lg-12">
          <div class="panel panel-primary">             
            <div class="panel-body">              
              <mapa-interactivo ref="mapaComponent" width='100' height='400px'></mapa-interactivo>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
export default {
  props:['data'],
  data()
  {
    return{
      pedido:{},
      detalle:[],
      total:0
    }
  },
  methods:{
    getPedido: function () {      
      var that = this
      axios.post('/front/getPedido',{id:this.data})
      .then(function (response) {
          that.pedido= response.data[0]    
          that.detalle = response.data[1]       
      })
    }
  },
  mounted()
  {
    this.getPedido()
  },
  computed:{
    calcularTotal(){
      this.total = 0 
      this.detalle.forEach(element => {
        this.total += (element.precio_unit*element.cantidad)
      })
      return this.total
    }
  }
}
</script>

<style>

</style>