<template>
  <div>
		<b-row>
			<b-col cols="6">
				<label for="example-datepicker">Elegir fecha</label>
			 	<input type="date" v-model="date">				 
			</b-col>
			<b-col cols="6">
				<b-form-group label="Repartidor:" label-cols-md="4">
     		 <!--<b-form-select v-model="selectRepartidor" :options="repartidores" class="mb-1"></b-form-select>-->
				<model-list-select v-model="selectRepartidor" :list="repartidores" option-value="id" option-text="nombres" placeholder="Seleccione Repartidor"></model-list-select>
				</b-form-group> 
			</b-col>
			<b-col cols="8">
			</b-col>
			<b-col cols="4" class=" text-right">
				<button class="btn btn-success" @click="cargarPedidos">Cargar</button>
			</b-col>
		</b-row> 
    
    <b-table
      ref="selectableTable"
      selectable
      select-mode="multi"
      :items="items"
      :fields="fields" 
      responsive="sm"
    > 
    </b-table><br><br>
    <p>
       
      
    </p>
  </div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/intranet/pedidos',
			productos_pedido: [],
			pedidos: [],
			pedidoSeleccionado: [],
			indexPedidoSeleccionado: -1,
			fields: [
				{
            key: 'Idpedido',
            label: 'Pedido'
        }, 
				{
            key: 'direccion',
            label: 'Dirección'
        },
				{
            key: 'date',
            label: 'Fecha'
        },
				{
            key: 'mount',
            label: 'Monto'
        }
				],
			repartidores:[],
			items: [],
			selectRepartidor: null,
			selected: [],
			 date: ''
		}
	},
	methods: {
	  montoPedido: function (params) {
				var that = this; 			 
			axios.post(this.ruta+'/montoPedido', {Idpedido:params.Idpedido})
			.then(function (response) {	 
				that.items.push(
					{
						Idpedido: params.Idpedido,
						direccion:params.direccion,
						date:params.date,
						mount:response.data[0].mount
					}
				);	 
			});		 
		},
		cargarPedidos: function(){
			var that = this; 
			that.items=[];
			axios.post(this.ruta+'/listaxRepartidor', {user:this.selectRepartidor,fecha:this.date})
			.then(function (response) {		 
				response.data.forEach(element => {
					that.montoPedido(element);									
				});
			 
			})
			.catch(()=>{
				Swal.fire(
					'Error',
					'Hubo un error inesperado, por favor contactese con el administrador del sistema',
					'error'
				)
			})
			.finally(()=>{
			});
		},
		cargarEmpleados: function(){
			var that = this;
			axios.post(this.ruta+'/listarempleados')
			.then(function (response) {
				let datos = response.data;
				that.repartidores = datos;
				console.log(datos);
			})
			.catch(()=>{
				Swal.fire(
					'Error',
					'Hubo un error inesperado, por favor contactese con el administrador del sistema',
					'error'
				)
			})
			.finally(()=>{
			});
		}
	},
	mounted() {
		this.pedidos = [];
		this.pedidosOriginal = [];
		// this.cargarPedidos();
		this.cargarEmpleados();
	},
    components: {
      ModelListSelect
    }
}
</script>
