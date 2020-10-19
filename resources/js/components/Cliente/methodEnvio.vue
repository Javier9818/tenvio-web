<template>
   <div class="form-group col-12">
      <b-form-group label="Selecciona el método de envio" class="label">
        <b-form-radio-group
          id="radio-group-1"
          v-model="empresa.tipoEntrega"
          :options="tipoPedidos"
          name="radio-options"
          required
          @change="tipoEnvio()"
        ></b-form-radio-group>
      </b-form-group>
      <div class="form-group col-12" v-if="showReserva">
        <label for="address" class="label">Ingresar fecha de reserva</label>
        <div class="row">
          <div class="col-6">
            <input type="date" v-model="empresa.isReserva.date" class=" form-control">
          </div>
          <div class="col-6">
            <input type="time" v-model="empresa.isReserva.time" class=" form-control">
          </div>
        </div>    
      </div>
    </div>
</template>

<script>
export default {
  props:['empresa'],
  data(){
    return{
      showReserva:false,
      tipoPedidos:[]
    }
  },
  methods:{
    //tipos de envio, el 3 es reserva
    tipoEnvio(){    
      setTimeout(() => {
        this.tipoPedidos.forEach(element => {
          if (element.value==this.empresa.tipoEntrega) {            
          clickComponent(element.text+'-'+this.empresa.empresa)
          }
        });
        if (this.empresa.tipoEntrega==3) {
          this.showReserva=true
        }else{
          this.showReserva=false
        }
      }, 250)                
    },
    tiposEntrega() {
      var that = this
      axios.post('/front/TipoPedido',{empresas:this.empresa.empresa})
      .then(function (response) {
        that.tipoPedidos= response.data
      })
    }
  },
  mounted(){
    this.tiposEntrega()
  }

}
</script>

<style>

</style>