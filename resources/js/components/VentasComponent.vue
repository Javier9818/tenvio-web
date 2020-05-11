<template>
  <div class="container">
      <label for="fecha">Fecha de jornada</label><br>
      <input id="fecha" type="date" v-model="date">
     <hr>
    <div class="row my-1">
      <div class="col-6"><h4>Número total de ventas: 56</h4></div>
      <div class="col-6"><h4>Monto de ventas: S/.560</h4></div>
    </div>
    <b-table :bordered="true" :hover="true"  :headVariant="dark" :items="items" :fields="fields"></b-table>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        dark:'dark',
        date:'',
        // Note 'isActive' is left out and will not appear in the rendered table
        fields: [
          {
            key: 'descripcion',
            label:'Descripción',
            sortable: true
          },
          {
            key: 'fecha',
            label:'Fecha y hora',
            sortable: false
          },
          {
            key: 'monto',
            label: 'Monto',
            sortable: true
          }
        ],
        items: [
          { isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.14'},
          { isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.15'},
          { isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.17'},
          { isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.11'},
        ]
      }
    }
  }
</script>
