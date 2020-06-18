<template>
    <div>
        <a href="javascript:void(0)" @click="modeMap = !modeMap">{{modeMap ? 'Modo lista': 'Modo mapa'}}</a>
        <div v-if="!modeMap">
            <b-table responsive striped hover :items="items" :fields="fields">
                <template v-slot:cell(opciones)="row">
                    <b-button size="sm" class="mr-2 btn-primary" @click="entregaPedido(row.item.id)">
                        Listo
                    </b-button>
                    <b-button size="sm" class="mr-2 btn-danger" @click="cancelaPedido(row.item.id)">
                        Cancelar
                    </b-button>
                </template>
                <template v-slot:cell(id)="row">
                    <b-button size="sm" class="mr-2 btn-success" @click="verDetalle(row.item)">
                        Cod. {{row.item.id}}
                    </b-button>
                </template>
            </b-table>

            <b-modal id="modal-detalle" :title="'Detalle de pedido Cod.'+infoModal.data.id" ok-only  size="lg" hide-backdrop>
                <h4 v-if="infoModal.loading">Cargando datos...</h4>
                <div v-else >
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Cliente: </b>{{infoModal.data.cliente}}</p>
                            <p><b>Celular: <a :href="'https://api.whatsapp.com/send?phone=51'+infoModal.data.celular+'&text='" target="_blank">{{infoModal.data.celular}}</a></b></p>
                            <p><b>Dirección: </b>{{infoModal.data.direccion}}</p>
                            <p><b>Monto: </b>S/.{{infoModal.data.monto}}</p>
                            <ul>
                                <li v-for="producto in infoModal.detalle" :key="producto.id">
                                    {{producto.nombre}} - {{producto.cantidad}} unidad(es)
                                </li>
                            </ul>
                        </div>
                        <div class="mb-1 col-md-6">
                            <b-button  class="btn-primary" @click="entregaPedido(infoModal.data.id)">
                            Entregar
                            </b-button>
                            <b-button  class="btn-danger">
                                Cancelar
                            </b-button>
                        </div>
                    </div>
                    <mapa-interactivo height='75vh' width='100%' @geoPosition='geoPosition' :layer='infoModal.data'></mapa-interactivo>
                </div>
            </b-modal>
        </div>
        <div v-else>
            <mapa-interactivo height='75vh' width='100%' @geoPosition='geoPosition' :layers='items'></mapa-interactivo>
            {{location}}
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        mounted() {
            console.log('Component mounted.')
            this.items = pedidosAsignados;
        },
        data(){
            return{
                modeMap:false,
                location:null,
                infoModal:{
                    loading: true,
                    data:'',
                    detalle:[]
                },
                fields: ['cliente', {key:'id', label:'Pedido'},{key:'direccion', label:'Dirección'}, 'monto', 'opciones'],
                items: []
            }
        },
        methods:{
            geoPosition(data){
                this.location = data;
            },
            verDetalle(data){
                this.infoModal.data= data;
                this.infoModal.loading = true;
                axios.get(`/api/detallePedido/${data.id}`).then( ({data}) => {
                    console.log(data);
                    this.infoModal.loading = false;
                    this.infoModal.detalle = data.detalle;
                });
                this.$bvModal.show('modal-detalle');
            },
            entregaPedido(id){
                Swal.fire({
					title: '¿Estás seguro?',
					text: '¿Está seguro que desea entregar este pedido?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						axios.post('/api/entregaPedido', {idpedido: id}).then((data) => {
                            Swal.fire('Éxito','El pedido se entregó con éxito','success')
                            this.items.map( (item, index) => {
                            if(item.id === id ) this.items.splice(index, 1);
                        });
                        }).catch(()=>{Swal.fire('Error','Ha ocurrido un error','error')});
					}
				})

            },
            cancelaPedido(id){
                Swal.fire({
					title: '¿Estás seguro?',
					text: '¿Está seguro que desea cancelar este pedido?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						axios.post('/api/cancelaPedido', {idpedido: id}).then((data) => {
                            Swal.fire('Éxito','El pedido se canceló con éxito','success')
                            this.items.map( (item, index) => {
                            if(item.id === id ) this.items.splice(index, 1);
                        });
                        }).catch(()=>{Swal.fire('Error','Ha ocurrido un error','error')});
					}
				})

            }
        }
    }
</script>
