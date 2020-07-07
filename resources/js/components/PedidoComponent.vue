<template>
	<div class="col-12">
        <b-button v-b-modal.modal-center variant="warning" class="mb-2">{{pedidos.length}} pedidos</b-button>
        <b-button v-b-modal.modal-center variant="success" class="mb-2">Filtrar</b-button>
        <b-button variant="danger" @click="cancelar_todos" class="mb-2">Cancelar todos los pedidos</b-button>
        <b-modal id="modal-center" centered title="Filtrar" ok-only hide-backdrop>
            <label for="">Filtrar Pedidos</label>
            <div class="container">
                <select class="form-control" v-model="filtropedido" @change="filtrar_tipopedido">
                    <option value="TODOS">TODOS</option>
                    <option value="DELIVERY">DELIVERY</option>
                    <option value="RECEPCIÓN EN LOCAL">RECEPCIÓN EN LOCAL</option>
                </select>
            </div>
			<label for="">Filtrar por Categoria</label>
			<div class="container">
				<multi-select :options="categorias_productos"
				   :selected-options="filtrocategorias"
				   option-value="value"
				   option-text="text"
				   placeholder="Seleccionar Categorias"
				   @select="filtrar_categorias">
			   </multi-select>
			</div>
            <!--<label for="">Filtrar por Categorías</label>-->
        </b-modal>
		<div v-for="(item, index) in pedidos" :key="item.idpedido">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Pedido {{index + 1}} - Código: {{item.idpedido}}</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<h4>Descripción</h4>
								<ul>
									<li v-for="itm in item.productos" :key="itm.nombre + (item.id || 10)">
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
							<button class="btn bg-danger white" v-on:click="cancelar(item, index)">Cancelar / Anular</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { MultiSelect } from 'vue-search-select'
	import Swal from 'sweetalert2'
    export default {
		data() {
			return {
				ruta: '/intranet/pedidos',
				pedidosOriginal: [],
				pedidos:[],
				productos_pedido: [],
				categorias_productos: [],
				pedidoSeleccionado: null,
				indexPedidoSeleccionado: -1,
				textoBusqueda: '',
				filtropedido: 'TODOS',
				//filtrocategoria: '',
				filtrocategorias: [],
				//lastSelectItem: [],
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
			filtrar_categorias: function(filtrocategorias, lastSelectItem){
				this.filtrocategorias = filtrocategorias;
				//this.lastSelectItem = lastSelectItem;
				this.filtrar();
			},
			filtrar_tipopedido: function(){
				this.filtrar();
			},
			filtrar: function(){
				//filtro segun el modo de entrega
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
				//filtro segun productos por categoria
				var that = this;
				var pedidosTemp = [];
				this.pedidos.forEach(function (item1) {
					var bul = false;
					item1.productos.forEach((item2, index)=>{
						var categoria_id = item2.categoria_id;
						that.filtrocategorias.forEach((item3, index)=>{
							if(categoria_id == item3.value){
								bul = true;
							}
						});
					});
					if (bul)
						pedidosTemp.push(item1);
				});
				this.pedidos = pedidosTemp;
			},
			cambiaestado: function(operacion, comentario, bul, idrepartidor){
				if (operacion == 'Aceptar')
					operacion = '/aceptar';
				else if (operacion == 'Cancelar')
					operacion = '/cancelar';
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
			cancelar: function(item, index){
				this.pedidoSeleccionado = item;
				this.indexPedidoSeleccionado = index;
				var that = this;
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
					//para iniciar el filtro
					that.filtrocategorias = that.categorias_productos;
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
			cancelartodospedidos: function(pedidos, comentario){
				axios.post(this.ruta+'/cancelartodos', {pedidos:pedidos, comentario:comentario})
				.then(function (response) {
					//let datos = response.data;
					//console.log(datos);
					Swal.fire(
						'Éxito',
						'Se han cancelado todos los pedidos',
						'success'
					)
					.then(()=>{
						location.reload();
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
			cancelar_todos: function(){
				var pedidos = this.pedidos;
				//console.log(pedidos);
				//console.log(pedidos.length);
				var that = this;
				Swal.fire({
					title: '¿Estás seguro?',
					text: '¿Está seguro que desea cancelar todos los pedidos?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					var thet = that;
					if (result.value) {
						Swal.fire({
							title: 'Ingrese el motivo por el cual está cancelando los pedidos',
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
							//console.log(text.value);{
							if (text.value != null){
								thet.cancelartodospedidos(pedidos, text.value);
							}
						});
					}
				})
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

					if (e.order == null)
						return;
					this.pedidos.push(e.order);
					this.pedidosOriginal.push(e.order);
					this.refrescarProductoPedido();
                });
            //console.log(`ordersCompany.${empresa}`);
        },
		components: {
			MultiSelect
		}
	}
</script>
