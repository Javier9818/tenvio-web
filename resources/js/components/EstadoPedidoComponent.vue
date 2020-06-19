<template>
  <div>
		<b-row>
			<b-col cols="6">
				<label for="example-datepicker">Choose a date</label>
			 	<input type="date" v-model="value">
				<p>Value: '{{ value }}'</p>
			</b-col>
			<b-col cols="6">
				<b-form-group label="Repartidor:" label-cols-md="4">
     		 <!--<b-form-select v-model="selectRepartidor" :options="repartidores" class="mb-1"></b-form-select>-->
				<model-list-select v-model="selectRepartidor" :list="repartidores" option-value="id" option-text="nombres" placeholder="Seleccione Repartidor"></model-list-select>
				</b-form-group> 
			</b-col>
		</b-row> 
    
    <b-table
      ref="selectableTable"
      selectable
      select-mode="multi"
      :items="items"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    > 
    </b-table><br><br>
    <p>
      <b-button size="sm" @click="selectAllRows">Seleccionar todos</b-button>
      <b-button size="sm" @click="clearSelected">Limpiar seleccionados</b-button>
      <button class="btn bg-primary white float-right" @click="asignar" :disabled="selected.length == 0 || selectRepartidor==null">Asignar</button>
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
			fields: [  'idpedido', {key:'nombres', label:'Cliente'}, 'descripcion', 'direccion'],
			repartidores:[],
			items: [],
			selectRepartidor: null,
			selected: [],
			 value: ''
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
		},
		cambiaestado: function(operacion, comentario, bul, idrepartidor){
			if (operacion == 'Asignar')
				operacion = '/asignar';
			else
				return;
			var idpedido = this.pedidoSeleccionado.idpedido;
			var that = this;
			axios.post(this.ruta+operacion, {
				comentario:comentario,
				idpedido:idpedido,
				idrepartidor:idrepartidor
			})
			.then(function (response) {
				let datos = response.data;
				that.pedidos.splice(that.indexPedidoSeleccionado, 1);
				that.pedidosOriginal.splice(that.indexPedidoSeleccionado, 1);
				that.indexPedidoSeleccionado = -1;
				Swal.fire(
					'Éxito',
					'Los cambios se realizaron correctamente',
					'success'
				)
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
		asignar: function(){
			console.log(this.selectRepartidor);
			var that = this;
			Swal.fire({
				title: '¿Estás seguro?',
				text: '¿Está seguro que desea Asignar este pedido?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.value) {
					console.log(that.selected);
					//that.pedidoSeleccionado = item;
					var thet = that;
					that.selected.forEach((item, index) => {
						this.indexPedidoSeleccionado = index;
						thet.pedidoSeleccionado = item;
						that.cambiaestado('Asignar', '', true, this.selectRepartidor)
					});
				}
			})
		},
		refrescarProductoPedido: function(){
			let productos_pedido = this.productos_pedido;
			this.pedidos.forEach((itm, index)=>{
				let ids = itm.ids.split(',');
				let cantidades = itm.cantidades.split(',');
				var longitud = ids.length;
				itm.productos = [];
				this.pedidos[index].descripcion = '';
				for (var i = 0; i < longitud; i++){
					var cantidad = cantidades[i];
					var idBuscarProducto = ids[i];
					var descripcionProducto;
					productos_pedido.forEach((item)=>{
						if (item.id == idBuscarProducto){
							descripcionProducto = item.nombre;
							return;
						}
					});
					itm.productos.push({
						nombre: descripcionProducto,
						cantidad: cantidad
					});
					this.pedidos[index].descripcion += descripcionProducto + '(' + cantidad + ') | ';
				}
				this.pedidos[index].descripcion = this.pedidos[index].descripcion.substr(0, this.pedidos[index].descripcion.length - 3);
				this.pedidos[index].productos = itm.productos;
			});
			this.items = this.pedidos;
		},
		cargarPedidos: function(){
			var that = this;
			axios.post(this.ruta+'/listardelivery')
			.then(function (response) {
				let datos = response.data;
				that.productos_pedido = datos.productos_pedido;
				datos.pedidos.forEach((itm)=>{
					that.pedidos.push(itm);
				});
				that.refrescarProductoPedido();
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
		this.cargarPedidos();
		this.cargarEmpleados();
	},
    components: {
      ModelListSelect
    }
}
</script>
