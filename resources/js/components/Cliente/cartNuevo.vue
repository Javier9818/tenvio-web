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
            <div class="col-12 col-md-8">
              <!--Ubicación del cliente-->
              <ubication :empresa="empresa"></ubication>
            </div>
            <div class="form-group col-12 col-md-4">
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
  props:['databot'],
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
            total:0,
            usuario:1,
            correo:null,
            number:null
          }
        }
      )
    },
    //método que inicializa todo
    recarga: function () {
      let cockie=JSON.parse(this.$cookies.get('carrito'))
      this.productos = (cockie==null)? []:cockie
      this.empresas=this.distinct(this.productos)
      console.log(this.empresas);
    },
    /*
      usuario
        Tipo 1= persona registrada
        Tipo 2= bot
    */
    transform(){
      let d_bot=JSON.parse(this.databot)
      console.log(d_bot);
      let productosBot=[]
      this.empresas.push({
        empresa: d_bot.idempresa,
        name_empresa: d_bot.name_empresa,
        tipoEntrega:d_bot.metodo_envio,
        lat:0,
        lng:0,
        direccion:d_bot.direccion,
        isReserva:{
          time:null,
          date:null
        },
        medioPago:d_bot.metodo_pago,
        total:0,
        usuario:2,
        correo:d_bot.correo,
        number:d_bot.referencia
      }) 
      d_bot.productos.forEach(element => {
        this.productos.push(
          {
            descripcion:' ',
            foto:element.foto,
            nombre:element.nombre,
            precio:element.precio,
            cant:element.cantidad, 
            id:element.idproducto, 
            empresa:d_bot.idempresa, 
            name_empresa:d_bot.name_empresa
          }
        )
      });
      this.$cookies.set('carrito',JSON.stringify(this.productos))
    } 
  },
  mounted(){
    if (this.databot!== undefined) {
      this.transform()
    }
    else{
      setTimeout(() => {      
        this.recarga()
      }, 1000)
    }    
  }, 
}
</script>

<style>

</style>