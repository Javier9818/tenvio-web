<template>
  <div>
    <loader mostrar="loader" ref="modalcito" texto="Espere un momento por favor"></loader>
    <label for="address" class="label">Pagos</label>              
    <div class="cart__total-amount">
      <h6>TOTAL:</h6>
      <ul class="list-unstyled mb-0">
      <li><span>Órden Total :</span><span>S/ {{calcularTotal}}</span></li> 
      </ul>
      <br>
      <div class=""> 
        <b-form-group label="Medio de Pago">
          <b-form-radio v-model="empresa.medioPago" name="some-radios" v-for="(tipo,index) in tiposPago" :key="index" :value="tipo">{{tipo.nombre}}</b-form-radio>
        </b-form-group> 
        <br>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content  text-right">
        <button class="btn btn-primary" :disabled="verificar" @click="generaPedido">Realizar Pedido</button>
      </div>
    </div> 
    <!-- <b-modal ref="dataTempBot" hide-footer title="Datos">
      <div class="d-block text-center">
        <input type="email" class=" form-control" v-model="empresa.correo" placeholder="Correo" required>
        <input type="number" class=" form-control" v-model="empresa.number" placeholder="Número telefónico" required>
      </div>
      <div class=" text-center">
        <b-button variant="success"  @click="generaPedido" :disabled="!(empresa.correo!=null && empresa.number!=null && empresa.number.length>=9)">Registrar</b-button>
      </div>      
    </b-modal> -->
  </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
  props:['productos','empresa'],
  data(){
    return{
      tiposPago:[],
      total:0,
      description: 'Pedido',
      state:true
    }
  },
  methods:{
    //tipos de pago
    tipoPago(empresa){
      var that= this
      axios.get(`/api/tipo-pago-front/${empresa}`).then( function (response) {        
        that.tiposPago=response.data.tipos 
        if (that.empresa.medioPago!==null) {
          that.tiposPago.forEach(element => {
            if (that.empresa.medioPago==element.tipopago_id) {
              that.empresa.medioPago=element
            }
          })
        }
      })   
    },   
    //genera pedido
    generaPedido() { 
      // if (this.empresa.usuario==2 && this.state) {
      //   if (this.empresa.correo!=null && this.empresa.number!=null && this.empresa.number.length>=9) {
      //     this.state=false
      //     console.log(this.state);
      //     this.generaPedido()
      //   }else{
      //     this.$refs['dataTempBot'].show()
      //     return
      //   }        
      // }else{
      //   if (this.empresa.usuario==2) {
      //     this.$refs['dataTempBot'].hide()
      //   }
      // }
      console.log(this.empresa.usuario);
      if(this.empresa.lng === 0 && this.empresa.lat === 0){
        Swal.fire({
        icon: 'error',
        title: 'ERROR',
        showCancelButton: true,
        text: 'Debe de aceptar el acceso a su ubicación para continuar con el pedido'
        })
      }else{
        var that = this
        Swal.fire({
          icon: 'question',
          title: '¿Desea generar el pedido?',
          showCancelButton: true,
          text: 'Aviso'
        }).then((result) => {
          if (!result.value)
            return
          if (that.empresa.medioPago.value=='C') {             
            that.generaPedidoCulqi()
          }else{
            that.generaPedidoFin([])
          }
        })
      }      
    },
    //mostrará modal culqi con moto del pedido
    generaPedidoCulqi: function(e){
		  Culqi.settings({
			  title: 'Tenvio Perú',
			  currency: 'PEN',
			  description: this.description,
			  amount: this.generatotal() * 100
		  });
      Culqi.open();
      e.preventDefault();
    },
    //general el pedido
    generaPedidoFin: function(datos){
		  var that = this;
      this.$refs.modalcito.showModal();
      if (this.empresa.usuario==1) {
        this.empresa.correo='-'
        this.empresa.number='-'
        console.log(this.empresa.usuario);
      }
      this.empresa.total=this.generatotal()
		  axios.post('/front/GeneraPedido', {
			  empresas: this.empresa,
			  productos: this.productos,
			  datos: datos,
		  }).then(function (response) {
			  that.$refs.modalcito.hideModal()
			  if (response.data.success == true){
			  	Swal.fire({
				  	text:'Su pedido se ha registrado satisfactoriamente, en unos minutos la empresa se contactará contigo.',
				  	icon: 'success',
				  	title: 'Éxito',
			  	}).then(() => {
            let productos=[]
            that.productos.forEach(element => {
              if (element.empresa!=that.empresa.empresa) 
                productos.push(element)              
            });
            that.$cookies.set('carrito',JSON.stringify(productos))            
            // if (this.empresa.usuario==1) {
            //   window.open('/mipago/'+response.data.id, '_blank')            
            // }
            location.href="/"
           
			  	})
			  }
			  else{
				  Swal.fire({
					  icon: 'error',
					  title: 'Error',
					  text: response.data.msj
				  });
			  }
		  }).catch(function (response){
			  that.$refs.modalcito.hideModal()
			  Swal.fire({
				  icon: 'error',
				  title: 'ERROR',
				  text: 'Sucedió un problema, intente nuevamente en los próximos minutos'
			  }).then(() => {location.reload()})
		  })
    },
    generatotal(){
      let total=0
      this.productos.forEach(element => {   
        if (this.empresa.empresa==element.empresa) {
          total = total + (element.precio*element.cant) 
        }
      }) 
      return total
    }
  },
  computed:{
    //total de los productos
    calcularTotal(){     
      let total=0
      this.productos.forEach(element => {   
        if (this.empresa.empresa==element.empresa) {
          total = total + (element.precio*element.cant) 
        }
      }) 
      return total
    },
    verificar(){
      if (this.empresa.tipoEntrega>0 && this.empresa.direccion!='' && this.empresa.medioPago!=null) {
        return false
      }
      return true
    } 
  },
  mounted(){
    this.tipoPago(this.empresa.empresa)
  },
  created: function () {       
    document.addEventListener('enviarpagoculqi', (datos) => {
      datos.detail.description = this.description;
      this.generaPedidoFin(datos.detail);
    });
  }
}
</script>

<style>

</style>