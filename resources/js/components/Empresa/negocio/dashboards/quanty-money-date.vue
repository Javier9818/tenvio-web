<template>
  <div class=" row">
    <div class="col-6">                               
      <chart-lineal-dsh1 v-if="view" :datasets ="datasets" :labels="labels"></chart-lineal-dsh1>
    </div>
    <div class="col-6">
      <div class="input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Cantidad de </span>
        </div>
        <select v-model="type" class="form-control">
          <option value="0">pedidos</option>
          <option value="1">dinero</option>
        </select>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2">del total de pedidos</span>
        </div>
      </div>
      <div class="input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Fecha</span>
        </div>
        <input type="date" v-model="date" class=" form-control">
      </div>

      <input type="button" value="Cargar" class=" btn btn-success" @click="initDash">
    </div>    
  </div>
</template>

<script>
export default {
  props: ['form'],
  data: () => ({
    date: '',
    type: 0,
    labels: [],
    datasets: [],
    view: false,
    states: [
      {
        state: 'PENDIENTE',
        color: '#176295'
      },
      {
        state: 'ACEPTADO',
        color: '#0FC13D'
      },
      {
        state: 'CANCELADO',
        color: '#D22D13'
      }
    ],
  }),
  methods: {
    initDash(){
      var that = this
      this.view = false
      axios.post('/api/empresa-dashboard', {
        date: (this.date == '')? new Date(): this.date,
        states:this.states,
        empresa_id: this.form.id,

      })
      .then(function (res) {
        res = res.data
        if (res.success) {
          
          res = res.data
          that.dataChart = res
          that.prepareData()
        }
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    prepareData(){
      this.view = true
      this.datasets = []
      this.labels = []
      let i = 0
      this.labels.push('')
      this.dataChart.forEach(element => {        
        this.datasets.push({
            label: element.state,
            backgroundColor: this.states[i].color,
            order: i++,
            data: [(this.type == 0)? element.count: element.total, 0]
          })
      })
      console.log(this.datasets);      
    },
    dame_color_aleatorio(){
      let hexadecimal = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F")
      let color_aleatorio = "#";
      for (let i=0;i<6;i++){
          let posarray = this.aleatorio(0,hexadecimal.length)
          color_aleatorio += hexadecimal[posarray]
      }
      return color_aleatorio
    },
    aleatorio(inferior,superior){
      let numPosibilidades = superior - inferior
      let aleat = Math.random() * numPosibilidades
      aleat = Math.floor(aleat)
      return parseInt(inferior) + aleat
    }
  },
  mounted(){
    this.initDash()
  }
}
</script>

<style>

</style>