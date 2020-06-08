<template>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Filtrar Pedidos</h4>
			</div>
			<div class="card-content collapse show">
				<div class="card-body text-center">
					<b-button v-b-modal.modal-center variant="success">Click acá para filtrar</b-button>
				</div>
			</div>
			<b-modal id="modal-center" centered title="Filtrar" ok-only hide-backdrop>
                <label for="">Filtrar Pedidos</label>
                <div class="container">
					<select class="form-control" v-model="filtropedido" @change="filtrar">
						<option value="TODOS">TODOS</option>
						<option value="DELIVERY">DELIVERY</option>
						<option value="RECEPCIÓN EN LOCAL">RECEPCIÓN EN LOCAL</option>
					</select>
                </div>
				<!--<label for="">Filtrar por Categorías</label>-->
  			</b-modal>
			<!--
			<div class="card-content collapse show">
				<div class="card-body">
                    <label for="">Buscar pedido</label>
                    <div class="row ml-2">
                        <input type="text" class="form-control col-8 col-md-10" v-model="textoBusqueda">
                        <button class="btn bg-success white" v-on:click="buscar">Aceptar</button>
                    </div>
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
                    <label for="">Filtrar pedidos</label>
                    <div class="row ml-2">
						<select class="form-control col-12 col-md-12" v-model="filtropedido" @change="filtrar">
							<option value="TODOS">TODOS</option>
							<option value="DELIVERY">DELIVERY</option>
							<option value="RECEPCIÓN EN LOCAL">RECEPCIÓN EN LOCAL</option>
						</select>
                    </div>
				</div>
			</div>
			-->
		</div>
		<div v-for="(item, index) in pedidos" :key="item.id">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Pedido {{item.id}}</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
							<li><button class="btn bg-primary white" v-on:click="aceptar(item, index)">Aceptar</button></li>
							<li><button class="btn bg-danger white" v-on:click="anular(item, index)">Anular</button></li>
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<h4>Descripción</h4>
								<ul>
									<li v-for="itm in item.productos" :key="itm.nombre + item.id">
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
							<div class="col-md-12">
								<h4 style="display:inline;">Tipo de Pedido:</h4>
								<h5 style="display:inline;">{{item.tipo_entrega}}</h5>
							</div>
						</div>
						<div class="text-center">
							<button class="btn bg-primary white" v-on:click="aceptar(item, index)">Aceptar</button>
							<button class="btn bg-danger white" v-on:click="anular(item, index)">Anular</button>
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
				categorias_productos: [],
				pedidoSeleccionado: null,
				indexPedidoSeleccionado: -1,
				textoBusqueda: '',
				filtropedido: 'TODOS',
				filtrocategoria: ''
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
			filtrar: function(){
				//TODOS
				//DELIVERY
				//RECEPCIÓN EN LOCAL
		        switch (this.filtropedido){
		            case('DELIVERY'):
		                this.pedidos = this.pedidosOriginal.filter(function (item) {
		                    return item.tipo_entrega.match(/DELIVERY/)
		                });
		                break;
					case('RECEPCIÓN EN LOCAL'):
						this.pedidos = this.pedidosOriginal.filter(function (item) {
							return item.tipo_entrega.match(/RECEPCIÓN EN LOCAL/)
						});
						break;
		            case('TODOS'):
		            default:
		                this.pedidos = this.pedidosOriginal;
		                break;
				}
			},
			cambiaestado: function(operacion, comentario, bul, idrepartidor){
				if (operacion == 'Aceptar')
					operacion = '/aceptar';
				else if (operacion == 'Anular')
					operacion = '/anular';
				else
					return;
                var idpedido = this.pedidoSeleccionado.idpedido;
                var idusuario = this.pedidoSeleccionado.idusuario;
				var that = this;
				axios.post(this.ruta+operacion, {
					comentario,
					idpedido,
                    idrepartidor,
                    idusuario,
                    pedido: this.pedidoSeleccionado
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
			aceptar: function(item, index){
				this.pedidoSeleccionado = item;
				this.indexPedidoSeleccionado = index;
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
			anular: function(item, index){
				this.pedidoSeleccionado = item;
				this.indexPedidoSeleccionado = index;
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
					that.categorias_productos = datos.categorias_productos;
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
					this.pedidos.push(e.order);
					this.pedidosOriginal.push(e.order);
					this.refrescarProductoPedido();
                });
            console.log(`ordersCompany.${empresa}`);
        },
    }
</script>
