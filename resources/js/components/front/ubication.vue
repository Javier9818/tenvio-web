<template>
  <div class="row">
    <div class="form-group col-12">
      <label for="address" class="label">Ingrese la dirección de destino</label>
      <input type="text" id="address" v-model="empresa.direccion" class="form-control focused form__control__javier" placeholder="Ingresar dirección" required>
    </div>
    <div class="col-12">
      <div class="cart__shiping">
        <p >Ayúdenos a que su órden se entregue lo más rápido posible.<br><b>Por favor indíque su ubicación en el mapa.</b></p>
        <mapa-interactivo ref="mapaComponent" width='100' height='400px' @geoPosition="saveMap"></mapa-interactivo>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props:['empresa'],
  data(){
    return{
      
    }
  },
  methods:{
    saveMap(map){ 
      this.empresa.lat=map.lat
      this.empresa.lng=map.lng
    }
  }
}
</script>

<style>

</style>