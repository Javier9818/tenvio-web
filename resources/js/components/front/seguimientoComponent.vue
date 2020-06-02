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
                  <li class="list-group-item" style=" color: green;">{{pedido.state}}</li>                 
                </ul>
            </div>
          </div>
        </div>
        <div class=" col-12 col-lg-8">
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
      pedido:{}
    }
  },
  methods:{
    getPedido: function () {      
      var that = this;
      axios.post('/front/getPedido',{id:this.data})
      .then(function (response) {
          that.pedido= response.data[0];          
      });
    }
  },
  mounted()
  {
    this.getPedido();
  }
}
</script>

<style>

</style>