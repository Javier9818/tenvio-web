<template>
  <div>
    <h4>{{selected.length}} pedidos seleccionados</h4>
    <b-table
      ref="selectableTable"
      selectable
      select-mode="multi"
      :items="items"
      :fields="fields"
      @row-selected="onRowSelected"
      responsive="sm"
    >
      <!-- Example scoped slot for select state illustrative purposes -->
      <template v-slot:cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
    </b-table><br><br>
    <p>
      <b-button size="sm" @click="selectAllRows">Seleccionar todos</b-button>
      <b-button size="sm" @click="clearSelected">Limpiar seleccionados</b-button>
      <button class="btn bg-primary white float-right" @click="entregar" :disabled="selected.length == 0">Entregar</button>
    </p>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/intranet/pedidos',
			productos_pedido: [],
			pedidos: [],
			pedidoSeleccionado: [],
			fields: ['selected', 'idpedido', 'nombres', 'descripcion', 'direccion'],
			items: [
				{  pedido: 1, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo(1)', direccion:'Urb.Las Gardenias MazF.Lte23' },
				{  pedido: 2, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo(1)', direccion:'Urb.Las Gardenias MazF.Lte23' },
				{  pedido: 3, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo(1)', direccion:'Urb.Las Gardenias MazF.Lte23' },
				{  pedido: 4, cliente: 'Briceño Montaño Javier', descripcion: '1/4 de Pollo(2) 1/4 de Pollo(1)', direccion:'Urb.Las Gardenias MazF.Lte23' }
			],
			selected: [],
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
			if (operacion == 'Entregar')
				operacion = '/entregar';
			else
				return;
			var idpedido = this.pedidoSeleccionado.idpedido;
			axios.post(this.ruta+operacion, {
				comentario:comentario,
				idpedido:idpedido,
				idrepartidor:idrepartidor
			})
			.then(function (response) {
				let datos = response.data;
				Swal.fire(
					'Éxito',
					'Los cambios se realizaron correctamente',
					'success'
				)
				.then(()=>{
					if (bul){
						location.reload();
					}
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
		entregar: function(){
			var that = this;
			Swal.fire({
				title: '¿Estás seguro?',
				text: '¿Está seguro que desea Entregar este pedido?',
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
					that.selected.forEach((item) => {
						thet.pedidoSeleccionado = item;
						that.cambiaestado('Entregar', '', true, 0)
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
			axios.post(this.ruta+'/listarrecepcion')
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
		}
	},
	mounted() {
		this.pedidos = [];
		this.pedidosOriginal = [];
		this.cargarPedidos();
	}
}
</script>
