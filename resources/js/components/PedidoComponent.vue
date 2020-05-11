<template>
    <div class="col-12">
        <div v-for="pedido in pedidos" :key="pedido.id">
            <div class="card" v-if="pedido.state === true">
            <div class="card-header">
                <h4 class="card-title">Pedido {{pedido.id}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
                        <li><button class="btn bg-primary white" v-on:click="aceptar(pedido.id)">Aceptar</button></li>
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
                                <li>1/4 de Pollo a la braza (2 unidades)</li>
                                <li>1/4 de Pollo a la braza (2 unidades)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Cliente</h4>
                            <ul>
                                <li>Celular: 981559813</li>
                                <li>Nombres: Briceño Montaño Javier Rodolfo</li>
                                <li>Destino: Urb. Las Gardenias MaznF. Lte 23</li>
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
                pedidos:[
                    {id:1, state:true},
                    {id:2, state:true},
                    {id:3, state:true},
                    {id:4, state:true}
                ]
            }
        },
        methods:{
            aceptar(id){
                this.pedidos.map((pedido) => {
                    if(pedido.id === id){
                        pedido.state = false
                    }
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
