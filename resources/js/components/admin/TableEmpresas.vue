<template>
    <div>
        <b-table :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" responsive="sm">
            <template v-slot:cell(opciones)="row">
                <a :href="'/admin/empresa/'+row.item.id" class="mr-2" title="Editar"><i class="ft-edit success"></i></a>
                <a href="" title="Eliminar"><i class="ft-delete red"></i></a>
            </template>
        </b-table>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: [
            { key:'nombre', sortable: true},
            { key:'ruc', sortable: true},
            { key:'celular', sortable: true},
            { key:'opciones', sortable: false}
        ],
        items: []
      }
    },
    mounted(){
        console.log(empresas);
        this.items = empresas;
    }
  }
</script>
