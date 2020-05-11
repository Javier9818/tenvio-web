<template>
  <div class="container">
       <b-form-radio-group
        v-model="selected"
        :options="options"
        class="mb-3"
        value-field="item"
        text-field="name"
        disabled-field="notEnabled"
        ></b-form-radio-group>
     <hr>
    <div class="row my-1">
      <div class="col-4"><h4>Número total de ventas: 56</h4></div>
      <div class="col-4"><h4>Monto total de ventas: $/.5600</h4></div>
      <div class="col-4"><h4>Monto de deuda: S/.560</h4></div>
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
            key: 'jornada',
            label:'Jornada',
            sortable: true
          },
          {
            key: 'pedidos',
            label:'Pedidos',
            sortable: true
          },
          {
            key: 'monto',
            label: 'Monto',
            sortable: true
          },
            {
            key: 'estado',
            label: 'Estado',
            sortable: false
            }
        ],
        items: [
          { isActive: true, jornada: '2020-14-04', pedidos:'20', monto: 'S/.14', estado:'Pendiente'},
          { isActive: true, jornada: '2020-20-04', pedidos:'50', monto: 'S/.150', estado:'Pendiente'},
          { isActive: true, jornada: '2020-18-04', pedidos:'200', monto: 'S/.170', estado:'Pendiente'},
          { isActive: true, jornada: '2020-25-04', pedidos:'150', monto: 'S/.110', estado:'Pendiente'},
        ],
        selected: '1',
        options: [
          { item: '1', name: 'Deudas' },
          { item: '2', name: 'Pagos realizados' },
          { item: '3', name: 'Buscar' }
        ]
      }
    }
  }
</script>
