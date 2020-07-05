<template>
    <div>
        <a href="javascript:void(0)" @click="modeMap = !modeMap" class=" btn btn-primary btn-sm mb-1"> <i class="ft-eye"></i> {{modeMap ? 'Ver en modo lista': 'Ver en modo mapa'}}</a>
        <div v-if="!modeMap">
            <b-table responsive striped hover :items="items" :fields="fields">
                <template v-slot:cell(opciones)="row">
                    <b-button size="sm" class="mr-2 btn-primary" @click="entregaPedido(row.item.id)">
                        Entregar
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
                            <p><b>Celular:</b></p>
                            <p class="ml-1"><a :href="'https://api.whatsapp.com/send?phone=51'+infoModal.data.celular+'&text='" target="_blank" title="Hablar por Whatsapp"><i class="fab fa-whatsapp"></i> {{infoModal.data.celular}}</a></p>
                            <p class="ml-1"><a :href="'tel:+'+infoModal.data.celular" title="Llamar a cliente"><i class="ft-phone blue"></i> {{infoModal.data.celular}}</a></p>
                            <p><b>Dirección: </b>{{infoModal.data.direccion}}</p>
                            <p><b>Monto: </b>S/.{{infoModal.data.monto}}</p>
                            <ul>
                                <li v-for="producto in infoModal.detalle" :key="producto.id">
                                    {{producto.nombre}} - {{producto.cantidad}} unidad(es)
                                </li>
                            </ul>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="row ">
                                <b-button  class="btn-primary mr-2" @click="entregaPedido(infoModal.data.id)">
                                    Entregar
                                </b-button>
                                <b-button  class="btn-danger" @click="cancelaPedido(infoModal.data.id)">
                                     Cancelar
                                </b-button>
                            </div>
                            
                        </div>
                    </div>
                    <mapa-interactivo :clickDisabled ='true' height='75vh' width='100%' @geoPosition='geoPosition' :layers='[infoModal.data]' ></mapa-interactivo>
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
            this.items = this.formatLayer();
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
                fields: [
                    'cliente', 
                    {key:'id', label:'Pedido'},
                    {key:'direccion', label:'Dirección'}, 
                    {
                        key:'monto', 
                        label:'Monto', 
                        formatter: (value, key, item) => {
                            return `S/.${value}`
                        },
                    }, 
                    'opciones'
                ],
                items: []
            }
        },
        methods:{
            formatLayer(){
                var data = []
                pedidosAsignados.forEach(item => {
                    data.push({
                        ...item,
                        popup:`
                        <h3>Pedido Cod.${item.id}</h3>
                        <b>${item.direccion}</b>
                        <p><b>Cliente: </b>${item.cliente}</p>
                        <p><b>Celular: <a href="https://api.whatsapp.com/send?phone=51${item.celular}&text=" target="_blank">${item.celular}</a></b></p>`
                    });
                });
                return data
            },
            geoPosition(data){
                this.location = data;
            },
            verDetalle(data){
                console.log(data)
                this.infoModal.data = data;
                this.infoModal.loading = true;
                axios.get(`/api/detallePedido/${data.id}`).then( ({data}) => {
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

<style scoped>
.link_map{
    font-size: 1.7em;
}
</style>
