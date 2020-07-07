<template>
  <div>
  <b-table
      show-empty
      small
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
    >
      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="verSeguimiento(row.item.pedido)">
          Ver seguimiento
        </b-button>
      </template>
  </b-table>
  <b-pagination
    v-model="currentPage"
    :total-rows="totalRows"
    :per-page="perPage"
    align="fill"
    size="sm"
    class="my-0"
  ></b-pagination>
  </div>
</template>

<script>
export default {
  data()
  {
    return{
      items: [],
      fields: [
        { key: 'empresa', label: 'Empresa'   },
        { key: 'date', label: 'Fecha' },
        { key: 'state', label: 'Estado' },
        { key: 'actions', label: 'Aciones' }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
    }
  },
  methods:
  {
    verSeguimiento: function (id_pedido) {
      var that = this;
      axios.post('/front/encripta',{id:id_pedido})
      .then(function (response) {
          location.href= response.data;
      });
    },
    listPedidos: function () {
      var that = this;
      axios.post('/front/ListPedido')
      .then(function (response) {
        that.items= response.data.data;
        that.totalRows = that.items.length
      });


    }
  },
  mounted()
  {
    this.listPedidos();
  }
}
</script>

<style>

</style>
