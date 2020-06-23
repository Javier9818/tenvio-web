<template>
    <div>
        <b-table :items="items" :fields="fields" responsive="sm">
            <template v-slot:cell(opciones)="row">
                <button class="mr-2 btn btn-sm btn-success" title="Ver detale" @click="showModal(row.item)"><i class="ft-eye"></i>Detalle</button>
            </template>
        </b-table>
        <b-modal id="formEmpresa" title="Solicitud de empresa" size="lg" scrollable hide-footer>
            <form-empresa-register @click="$bvModal.hide('formEmpresa')" @close="$bvModal.hide('formEmpresa')" @update="update" :dataFields="{departamentos, provinciasGlobal, distritosGlobal}" :dataForm="dataForm"></form-empresa-register>
        </b-modal>
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
            this.$root.$emit('bv::show::modal', 'formEmpresa')
        }
    }
  }
</script>
