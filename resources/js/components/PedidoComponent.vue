<template>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Buscar Pedidos</h4>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<b-form-group
							label="Filtro de Búsqueda"
							label-cols-sm="4"
							label-align-sm="center"
							label-align="center"
							label-size="sm"
							class="mb-0">
								<b-form-input v-model="textoBusqueda" placeholder="Palabra Clave"></b-form-input>
							</b-form-group>
						</div>
					</div>
					<div class="text-center">
						<button class="btn bg-success white" v-on:click="buscar">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
		<div v-for="(item, index) in pedidos">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Pedido {{item.id}}</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
							<li><button class="btn bg-primary white" v-on:click="aceptar(item)">Aceptar</button></li>
							<li><button class="btn bg-danger white" v-on:click="anular(item)">Anular</button></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<h4>Descripción</h4>
								<ul>
									<li v-for="(itm, idx) in item.productos">
										{{itm.nombre}} ({{itm.cantidad}} unidad(es))
									</li>
									<!--<li>1/4 de Pollo a la braza (2 unidades)</li>-->
								</ul>
							</div>
							<div class="col-md-6">
								<h4>Cliente</h4>
								<ul>
									<li>Celular: {{item.celular}}</li>
									<li>Nombres: {{item.nombres}}</li>
									<li>Destino: {{item.direccion}}</li>
								</ul>
							</div>
						</div>
						<div class="text-center">
							<button class="btn bg-primary white" v-on:click="aceptar(item)">Aceptar</button>
							<button class="btn bg-danger white" v-on:click="anular(item)">Anular</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'
    export default {
		data() {
			return {
				ruta: '/intranet/pedidos',
				pedidosOriginal: [],
				pedidos:[
					{id:1, state:true},
					{id:2, state:true},
					{id:3, state:true},
					{id:4, state:true}
				],
				productos_pedido: [],
				pedidoSeleccionado: null,
				textoBusqueda: ''
			}
		},
        methods:{
			/*
            aceptar(item){
                this.pedidos.map((pedido) => {
                    if(pedido.id === item.id){
                        pedido.state = false
                    }
                });
            },
			*/
			buscar: function(){
				let texto = this.textoBusqueda;
				this.pedidos = [];
				var that = this;
				this.pedidosOriginal.forEach(function (item) {
					if (
						item.nombres.toUpperCase().includes(texto.toUpperCase()) ||
						item.celular.toUpperCase().includes(texto.toUpperCase())
					)
						that.pedidos.push(item);
				});

				//this.pedidos = this.pedidosOriginal.filter(function (item) {
					//return item.celular.match(/ANULADO/) || item.nombres.match(/ANULADO/)
				//});
				//console.log(this.items);
			},
			cambiaestado: function(operacion, comentario, bul, idrepartidor){
				if (operacion == 'Aceptar')
					operacion = '/aceptar';
				else if (operacion == 'Anular')
					operacion = '/anular';
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
			aceptar: function(item){
				this.pedidoSeleccionado = item;
				var that = this;
				Swal.fire({
					title: '¿Estás seguro?',
					text: '¿Está seguro que desea aceptar este pedido?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						that.cambiaestado('Aceptar', '', true, 0);
					}
				})
			},
			anular: function(item){
				this.pedidoSeleccionado = item;
				var that = this;
				Swal.fire({
					title: '¿Estás seguro?',
					text: '¿Está seguro que desea anular este pedido?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						var thet = that;
						Swal.fire({
							title: 'Ingrese el motivo por el cual está cancelando el pedido',
							input: 'textarea',
							inputValue: '',
							confirmButtonText: 'Confirmar',
							showCancelButton: true,
							cancelButtonText: 'Cancelar',
							inputValidator: (value) => {
								if (!value) {
									return 'Por favor, ingrese el motivo'
								}
								else if (value.length > 100){
									return 'El texto ingresado no debe tener más de 100 caracteres'
								}
							}
						})
						.then((text)=>{
							//console.log(text.value);
							if (text.value != null)
								thet.cambiaestado('Anular', text.value, true, 0);
						});
					}
				})
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
					}
					this.pedidos[index].productos = itm.productos;
				});
			},
			cargarPedidos: function(){
				var that = this;
				axios.post(this.ruta+'/listartodo')
				.then(function (response) {
					let datos = response.data;
					that.productos_pedido = datos.productos_pedido;
					datos.pedidos.forEach((itm)=>{
						that.pedidos.push(itm);
						that.pedidosOriginal.push(itm);
					});
					that.refrescarProductoPedido();
					//console.log(that.pedidos);
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
        },
        created(){
             Echo.channel(`ordersCompany.${empresa}`)
                .listen('NewOrderEvent', (e) => {
                    console.log(e);
					if (e.order == null)
						return;
					this.pedidos = [e.order,...this.pedidos];
					this.pedidosOriginal = [e.order,...this.pedidosOriginal];
					this.refrescarProductoPedido();
                    Swal.fire(
						'Éxito',
						'Ya llego un pedido nuevo, apura!',
						'success'
					)
                });
            console.log(`ordersCompany.${empresa}`);
        }
    }
</script>
