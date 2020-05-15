<template>
  <div>
    <b-form-group label="Repartidor:" label-cols-md="4">
      <b-form-select v-model="selectRepartidor" :options="repartidores" class="mb-1"></b-form-select>
    </b-form-group>
    <h4>{{selected.length}} pedidos asignados</h4>
    <b-table
      ref="selectableTable"
      selectable
      select-mode="multi"
      :items="items"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    >
      <!-- Example scoped slot for select state illustrative purposes -->
      <template v-slot:cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
    </b-table><br><br>
    <p>
      <b-button size="sm" @click="selectAllRows">Seleccionar todos</b-button>
      <b-button size="sm" @click="clearSelected">Limpiar seleccionados</b-button>
      <button class="btn bg-primary white float-right">Asignar</button>
    </p>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: ['selected', 'pedido', 'cliente', 'descripcion', 'direccion'],
        repartidores:['Montes Caceres Javier', 'Jose de la Vega Miguel'],
        items: [
          {  pedido: 1, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo', direccion:'Urb.Las Gardenias MazF.Lte23' },
          {  pedido: 2, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo', direccion:'Urb.Las Gardenias MazF.Lte23' },
          {  pedido: 3, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo', direccion:'Urb.Las Gardenias MazF.Lte23' },
          {  pedido: 4, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo', direccion:'Urb.Las Gardenias MazF.Lte23' }
        ],
        selectRepartidor: '',
        selected: []
      }
    },
    methods: {
      onRowSelected(items) {
        this.selected = items
      },
      selectAllRows() {
        this.$refs.selectableTable.selectAllRows()
      },
      clearSelected() {
        this.$refs.selectableTable.clearSelected()
      }
    }
  }
</script>
