<template>
  <div>
    <h2>Gracias, tu orden fue recibida</h2>
    <b-overlay :show="show" rounded="sm">
       <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h3>Empresa: {{pedido.empresa}}</h3>
                  <table class="table table-striped">           
                    <tbody>
                      <tr>
                        <th scope="row">Ruc</th>
                        <td>{{pedido.ruc}}</td>               
                      </tr>
                      <tr class=" d-none">
                        <th scope="row">Correo</th>
                        <td></td>               
                      </tr>
                      <tr>
                        <th scope="row">Teléfono</th>
                        <td>{{pedido.telefono}}</td>               
                      </tr>
                      <tr class=" d-none">
                        <th scope="row">Titular</th>
                        <td></td>               
                      </tr>                
                    </tbody>
                  </table>
                </div>
                <div class="col-4">
                  <img src="" class=" img-fluid" alt="">
                  <a href="#">Ver código  para realizar el pago (pulsar imagen)</a>
                </div>
              </div>
            </div>
          </div>          
        </div>
        <div class="col-12 mt-2">
          <div class="card">
            <div class="card-body">
              <h3>Detalles del pedido</h3>
              <table class="table table-striped">           
                <tbody>
                  <tr>
                    <th scope="row">Total de artículos</th>
                    <td>{{detalle.length}}</td>               
                  </tr>
                  <tr>
                    <th scope="row">Tiempo de entrega</th>
                    <td></td>               
                  </tr>
                  <tr>
                    <th scope="row">Fecha de pedido</th>
                    <td>{{pedido.date}}</td>               
                  </tr>
                  <tr>
                    <th scope="row">Lugar de entraga</th>
                    <td>{{pedido.direccion_pedido}}</td>               
                  </tr>
                  <tr>
                    <th scope="row">Descripción de los articulos</th>
                    <td>
                      <p class=" text-dark" v-for="(item,index) in detalle" :key="index">{{item.nombre}} - Cantidad:{{item.cantidad}} - S/{{item.precio_unit}}</p>
                    </td>               
                  </tr>
                  <tr>
                    <th scope="row">Tipo de moneda</th>
                    <td>Soles</td>               
                  </tr>
                </tbody>
              </table>
              <h3 class=" text-right">Orden total: S/{{calcularTotal}}</h3>
            </div>
          </div>        
        </div>
        <div class=" mt-2 col-12 text-center">
          <b-button-group>
            <b-button variant="success" @click="gotoBack">Regresar a inicio</b-button>
            <b-button variant="info">Imprimir detalle del pago</b-button>
            <b-button variant="warning" @click="verSeguimiento">Realizar seguimiento</b-button>
          </b-button-group>
        </div>
      </div>
    </b-overlay>    
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
      total:0,
      show:true
    }
  },
  methods:{
    getPedido: function () {      
      var that = this
      axios.post('/front/getPedido',{id:this.data})
      .then(function (response) {
        that.pedido= response.data[0]
        that.detalle = response.data[1]
        that.show=false
      })
    },
    verSeguimiento() {
      var that = this;
      axios.post('/front/encripta',{id:this.data})
      .then(function (response) {
        location.href= response.data;
      });
    },
    gotoBack(){
      location.href="/"
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