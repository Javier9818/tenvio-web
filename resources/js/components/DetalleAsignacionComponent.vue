<template>
	<div class="col-12"> 
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
									
									<li v-for="itm in item.productos" :key="itm.nombre ">
										 
										{{itm.nombre}} ({{itm.cantidad}} unidad(es)) x {{itm.precio_unit}}
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
							<div class="col-md-2">
								<h4 style="display:inline;">Estado</h4>
								<h3 style="display:inline;">{{item.state}}</h3>
							</div>		
							<div class="col-md-12">
								<h4 style="display:inline;">Tipo de Pedido:</h4>
								<h5 style="display:inline;">{{item.tipo_entrega}}</h5>
							</div>
						 
						
						</div>
						<div class="text-center">
						 	<h4 style="display:inline;">Monto:{{item.mount}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import Swal from 'sweetalert2'
export default {
	props:['id'],
	data() {
		return {
			ruta: '/intranet/pedidos',
			 
			pedidos: []
		}
	},
	methods: {
		
		 montoPedido: function (params) {
				var that = this; 			 
			axios.post(this.ruta+'/montoPedido', {idpedido:params.idpedido})
			.then(function (response) {	 
				console.log(params.productos);
				that.pedidos.push(
					{
						idpedido: params.idpedido,			 
						nombres:params.nombres,
						celular:params.celular,
						direccion:params.direccion,
						tipo_entrega:params.tipo_entrega,
						state:params.state,
						mount:response.data[0].mount,	
						productos:params.productos	
					}
				);
				 
			});		
		 
		},
	  listPedidos: function () {		 
				var that = this; 			 
				that.pedidos=[];
				axios.post(this.ruta+'/ListaPedidos', {id:this.id})
				.then(function (response) {	  
					 
					response.data.forEach(element => {
						that.montoPedido(element);	
					});					 
				});		 
		}
	},
	mounted() {
		this.listPedidos();
	}
}
</script>
