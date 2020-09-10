<template>
    <div>
        
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
                                    <div class="col-3"><b>Distrito:</b></div>
                                    <div class="col-9">{{ubicacion(item.distrito_id)}}</div>
                                </div>
                                <div class="row justify-content-end">
                                    <button class="btn btn-sm btn-success mr-1" title="Ver detale" @click="showModal(item)"><i class="ft-eye"></i> Detalle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <b-modal id="modalFormEmpresa" title="Solicitud de empresa" size="lg" scrollable hide-footer>
            <form-empresa-register @click="$bvModal.hide('modalFormEmpresa')" @close="$bvModal.hide('modalFormEmpresa')" @update="update" :dataFields="{departamentos, provinciasGlobal, distritosGlobal}" :dataForm="dataForm"></form-empresa-register>
        </b-modal> -->
        <div class="modal fade " id="modalFormEmpresa" tabindex="-1" role="dialog" aria-labelledby="  " aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form-empresa-register @close="close" @update="update" :dataFields="{departamentos, provinciasGlobal, distritosGlobal}" :dataForm="dataForm" v-if="modalState"></form-empresa-register>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        fields: [
            { key:'nombre', sortable: true},
            { key:'ruc', label:'RUC', sortable: true},
            { key:'celular', sortable: true},
            {
                key:'distrito_id',
                label: 'Distrito',
                sortable: true,
                formatter: (value, key, item) => {
                    return value ? this.ubicacion(value) : 'Inactivo'
                },
            },
            { key:'opciones', sortable: false}
        ],
        items: [],
        dataForm:{},
        departamentos:[],
        provinciasGlobal:[],
        distritosGlobal:[],
        modalState: false
        // optionsTipoNegocios: tiponegocios
      }
    },
    mounted(){
        console.log(empresas);
        this.items = empresas;
        axios.get('/json/departamentos.json').then(({data}) => { this.departamentos = data;});
        axios.get('/json/provincias.json').then(({data}) => { this.provinciasGlobal = data });
        axios.get('/json/distritos.json').then(({data}) => { this.distritosGlobal = data });
        // axios.get('/api/tipoNegocios').then(({data})=>{ this.optionsTipoNegocios = data.tiponegocios; });
    },
    methods:{
        close(){
            $('#modalFormEmpresa').modal('hide')
            this.modalState = false
        },
        update(){},
        ubicacion: function(id){
            let index = this.binarySearch(id, this.distritosGlobal);
            return (index !== -1) ? this.distritosGlobal[index].name: 'No se encontró';
        },
        binarySearch: function(value, list) {
            let first = 0;    //left endpoint
            let last = list.length - 1;   //right endpoint
            let position = -1;
            let found = false;
            let middle;

            while (found === false && first <= last) {
                middle = Math.floor((first + last)/2);
                if (parseInt(list[middle].id, 10) == value) {
                    found = true;
                    position = middle;
                } else if (parseInt(list[middle].id, 10) > value) {  //if in lower half
                    last = middle - 1;
                } else {  //in in upper half
                    first = middle + 1;
                }
            }
            return position;
        },
        showModal(item){
            this.dataForm = item
            this.modalState = true
            $('#modalFormEmpresa').modal('show')
            $('#modalFormEmpresa').on('hidden.bs.modal', () => {this.close()})
            // this.$root.$emit('bv::show::modal', 'modalFormEmpresa')
        }
    }
  }
</script>
