<template>
    <div> 
      <!-- <b-form-group
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
      </b-form-group>  -->
      <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-12" v-for="item in items" :key="item.id">
            <div class="card pull-up ecom-card-1 bg-white">
                <div class="card-content ecom-card2 height-180">
                    <h5 class="text-muted primary position-absolute p-1">{{item.nombre}}</h5>
                    <div>
                        <i class="ft-home primary font-large-1 float-right p-1"></i>
                    </div>
                    <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                        <div class="container mt-1">
                            <div class="row mt-1">
                                <div class="col-3"><b>Ruc:</b></div>
                                <div class="col-9">{{item.ruc}}</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-3"><b>Celular:</b></div>
                                <div class="col-9">{{item.celular}}</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-3"><b>Ciudad:</b></div>
                                <div class="col-9">{{item.ciudad}}</div>
                            </div>
                            <div class="row justify-content-end">
                                <a :href="'/admin/empresa/'+item.id" class="btn btn-primary btn-sm mr-1">Ver</a>
                                <button class="btn btn-danger btn-sm mr-1">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
     
     <div class="contenedor">
        <button class="botonF1" data-toggle="modal" data-target="#empresa">
            <span>+</span>
        </button>
      </div>
      
      <!-- <b-table :items="items" :fields="fields" responsive="sm">
        <template v-slot:cell(opciones)="row">
          <a :href="'/admin/empresa/'+row.item.id" class="mr-2" title="Editar"><i class="ft-edit success"></i></a>
          <a href="" title="Eliminar"><i class="ft-delete red"></i></a>
        </template>
      </b-table> -->
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
