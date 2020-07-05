<template>
    <div> 
      <b-form-group
      id="fieldset-1"
      description="Nombre único o codigo"
      label="Buscar"
      label-for="input-1" 
    >
      <div class=" row text-left">
        <div class=" col-12 col-md-6 col-lg-6">
          <b-form-input v-model="text" placeholder="Nombre único o codigo"></b-form-input>
        </div>
        <div class=" col-12 col-md-4 col-md-4">
          <b-form-select v-model="selected" :options="options" ></b-form-select>
        </div>
        <div class=" col-12 col-md-2 col-md-2">
          <b-button variant="success" @click="search">Buscar</b-button>
        </div>
      </div> 
    </b-form-group> 
      <b-table :items="items" :fields="fields" responsive="sm">
        <template v-slot:cell(opciones)="row">
          <a :href="'/admin/empresa/'+row.item.id" class="mr-2" title="Editar"><i class="ft-edit success"></i></a>
          <a href="" title="Eliminar"><i class="ft-delete red"></i></a>
        </template>
      </b-table>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
  export default {
    data() {
      return {
        fields: [
          { key:'nombre', sortable: true},
          { key:'ruc', sortable: true},
          { key:'celular', sortable: true},
          { key:'opciones', sortable: false}
        ],
        items: [],
        selected: null,
        options: [ 
          { value: null, text: 'Por favor, seleccione una opción' },
          { value: 'id', text: 'Codigo' },
          { value: 'nombre_unico', text: 'Nombre Único' }           
        ],
        text:''
      }
    },
    methods:{
      search(){
        var that= this
        if (this.selected!=null) {
          axios.post('/api/empresa/search', {
          column:this.selected,
          text_search: this.text
          }).then((response)=>{
            that.items = response.data 
          }).catch((error) => {
            Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error')
          })
        }
      }
    },
    mounted(){
        console.log(empresas)
        this.items = empresas
    }
  }
</script>
