<template>
  <div class="row">
    <div class="col-12">
      <b-tabs content-class="mt-3">
        <!--Crea tabs por empresas de pedido-->
        <b-tab  v-for="(empresa, index) in empresas " 
        :key="index" lazy
        :title="empresa.name_empresa"
        >       
          <div class="row">
            <div class="col-12">
              <!--Métodos de envio-->
            <method-envio :empresa="empresa"></method-envio>
            </div>
            <div class="col-12">
              <!--Lista de prodcutos-->
              <list-type-A       
              :productos="productos"
              :empresa="empresa" 
              ></list-type-A>
            </div>
            <div class="col-8">
              <!--Ubicación del cliente-->
              <ubication :empresa="empresa"></ubication>
            </div>
            <div class="form-group col-4">
              <!--Zona de pagos-->
              <pago 
              :productos="productos"
              :empresa="empresa" ></pago>    
            </div>
          </div>  
        </b-tab>    
      </b-tabs>
    </div>    
  </div>
</template>

<script>
export default {
  props:['user'],
  data(){
    return {
      productos: [],
      empresas:[],       
      client:{
        username:'',
        password:''
      }
    }
  },
  methods:{
    //crea un array de empresas a partir de los produtos del carrito
    distinct: function (array) {
      return Array.from(new Set(array.map(s=>s.empresa)))
      .map(
        empresa => {          
          return{
            empresa: empresa,
            name_empresa: array.find(s=> s.empresa===empresa).name_empresa,
            tipoEntrega:0,
            lat:0,
            lng:0,
            direccion:'',
            isReserva:{
              time:null,
              date:null
            },
            medioPago:null,
            total:0
          }
        }
      )
    },
    //método que inicializa todo
    recarga: function () {
      let cockie=JSON.parse(this.$cookies.get('carrito'))
      this.productos = (cockie==null)? []:cockie
      this.empresas=this.distinct(this.productos)
    } 
  },
  mounted(){
    setTimeout(() => {      
      this.recarga()
    }, 1000);
  }, 
}
</script>

<style>

</style>