<template>
    <div class="col-12">
        <div v-for="(item, index) in pedidos">
            <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pedido {{item.id}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
                        <li><button class="btn bg-primary white" v-on:click="aceptar(item.id)">Aceptar</button></li>
                        <li><button class="btn bg-danger white">Eliminar</button></li>
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
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
         data() {
            return {
				ruta: '/intranet/pedidos',
                pedidos:[
                    {id:1, state:true},
                    {id:2, state:true},
                    {id:3, state:true},
                    {id:4, state:true}
                ],
				productos_pedido: [],
            }
        },
        methods:{
            aceptar(id){
                this.pedidos.map((pedido) => {
                    if(pedido.id === id){
                        pedido.state = false
                    }
                });
            },
			refrescarProductoPedido: function(){
				let productos_pedido = this.productos_pedido;
				this.pedidos.forEach((itm, index)=>{
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
				axios.post(this.ruta+'/listar')
				.then(function (response) {
					let datos = response.data;
					that.productos_pedido = datos.productos_pedido;
					datos.pedidos.forEach((itm)=>{
						that.pedidos.push(itm);
					});
					that.refrescarProductoPedido();
					//console.log(that.pedidos);
				})
				.finally(()=>{
				});
			}
        },
        mounted() {
			this.pedidos = [];
			this.cargarPedidos();
        }
    }
</script>
