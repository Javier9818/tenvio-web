<template>
	<div class="container">
		<label for="fecha">Fecha de jornada</label><br>
		<input id="fecha" type="date" v-model="date" @change="cambiafecha" class="form-control">
		<div class="text-center">
			<loader :mostrar="mostrarLoader" texto="Cargando los registros, espere un momento por favor"></loader>
		</div>
		<hr>
		<div class="row my-1">
			<div class="col-6"><h4>Número total de ventas: {{cantidad}}</h4></div>
			<div class="col-6"><h4>Monto de ventas: {{monto}}</h4></div>
		</div>
		<b-table :bordered="true" :hover="true"  :headVariant="dark" :items="pedidos" :fields="fields"></b-table>
	</div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/intranet/ventas',
			dark:'dark',
			date:'',
			// Note 'isActive' is left out and will not appear in the rendered table
			fields: [
				{
					key: 'idpedido',
					label:'Codigo',
					sortable: true
				},
				{
					key: 'descripcion',
					label:'Descripción',
					sortable: true
				},
				{
					key: 'fecha_entrega',
					label:'Fecha y Hora',
					sortable: false
				},
				{
					key: 'monto',
					label: 'Monto',
					sortable: true
				}
			],
			/*
			items: [
				{ isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.14'},
				{ isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.15'},
				{ isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.17'},
				{ isActive: true, descripcion: 'Pollo a la brasa 1/4', fecha:'2020-18-04', monto: 'S/.11'},
			],
			*/
			pedidos: [],
			pedidosOriginal: [],
			productos_pedido: [],
			cantidad: 0,
			monto: 0,
			mostrarLoader: false
		}
	},
	methods:{
		cambiafecha: function(){
			console.log(this.date);
			this.cargarPedidos();
		},
		ponerProductosDescripcion: function(){
			//console.log(this.pedidos);
			this.cantidad = 0;
			this.monto = 0;
			this.pedidos.forEach((itm, index)=>{
				this.cantidad++;
				this.monto += parseFloat(itm.monto);
				this.pedidos[index].monto = 'S/ ' + itm.monto;
				console.log(itm.productos);
				let prds = [];
				itm.productos.forEach((itm2, index2)=>{
					prds.push(itm2.nombre + " (" + itm2.cantidad + ")");
				});
				//console.log(prds);
				this.pedidos[index].descripcion = prds.join(', ');
			});
		},
		refrescarProductoPedido: function(){
			let productos_pedido = this.productos_pedido;
			this.pedidosOriginal.forEach((itm, index)=>{
				let ids = itm.ids.split(',');
				let cantidades = itm.cantidades.split(',');
				var longitud = ids.length;
				itm.productos = [];
				for (var i = 0; i < longitud; i++){
					var cantidad = cantidades[i];
					var idBuscarProducto = ids[i];
					var descripcionProducto;
					var categoria_id;
					productos_pedido.forEach((item)=>{
						if (item.id == idBuscarProducto){
							descripcionProducto = item.nombre;
							categoria_id = item.categoria_id;
							return;
						}
					});
					itm.productos.push({
						nombre: descripcionProducto,
						cantidad: cantidad,
						categoria_id: categoria_id
					});
				}
				this.pedidos[index].productos = itm.productos;
			});
			this.ponerProductosDescripcion();
		},
		cargarPedidos: function(){
			this.mostrarLoader = true;
			this.pedidos = [];
			this.pedidosOriginal = [];
			var that = this;
			axios.post(this.ruta+'/listarentregados', {fecha:this.date})
			.then(function (response) {
				let datos = response.data;
				that.productos_pedido = datos.productos_pedido;
				datos.pedidos.forEach((itm)=>{
					that.pedidos.push(itm);
					that.pedidosOriginal.push(itm);
				});
				that.refrescarProductoPedido();
			})
			.catch((error)=>{
				console.log(error);
				Swal.fire(
					'Error',
					'Hubo un error inesperado, por favor contactese con el administrador del sistema',
					'error'
				)
			})
			.finally(()=>{
				that.mostrarLoader = false;
			});
		},
	},
	mounted() {
		const d = new Date()
		const year = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d)
		const month = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d)
		const day = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d)
		console.log(`${year}-${month}-${day}`);
		this.date = `${year}-${month}-${day}`;
		this.cargarPedidos();
	},
}
</script>
