<template>
    <div>
        <a href="#" class="navbar__action-btn navbar__action-btn-pedido">
                <i class="fa fa-bell"></i><span class="cart__label">{{items.length}}</span>
        </a>
        <div class="pedido-popup main-menu">
            <h5 class="text-center" >Mis Pedidos</h5>
            <hr>
            <ul class="list-unstyled  " style=" overflow: auto; height:250px;word-wrap: break-word; width:110%;">
                <li class="cart-item" v-for="(item, index) of items" :key="index">
                <div class="cart__item-content">
                    <h6 class="cart__item-title">Restaurante: {{item.empresa}}</h6>
                    <div class="cart__item-detail"> {{item.date}}</div>
                    <button
                        :class="color(item.state).color + ' btn-sm btn-block mt-2'"
                        :title="color(item.state).title"
                        style="color:white; cursor:default"> {{(item.state).toUpperCase()}}

                    </button>
                </div><!-- /.cart-item-content -->
                </li>
                <infinite-loading @infinite="listPedidos">
                     <div slot="waveDots">Cargando </div>
                    <div slot="no-more"> </div>
                    <div slot="no-results"> </div>
                      
                </infinite-loading>
            </ul>
            <div class="cart-action text-center">
                <a href="/pedidos" class="mt-2">Ver todos mis pedidos</a>
            </div><!-- /.cart-action -->
        </div>
    </div>
</template>

<script>
    import EventBus from '../../event-bus';
    import Swal from 'sweetalert2'
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        components:
        {
            InfiniteLoading,
        },
        props:['user'],
        data(){
            return {
                items: [
                ],
                count:0

            }
        },
        methods:{

            notifyPush: function(message){
                Push.create("Nueva Notificacion",{
                    body: message,
                    icon: 'https://i.imgur.com/0LA2f7K.png',
                    timeout: 10000,
                    onClick: function(){
                        this.close();
                    }
                });


            },
            listPedidos: function ($state) {
                this.count++;
                var that = this;
                axios.post('/front/ListPedido',{page:this.count})
                .then(function (response) {
                    let pedidos= response.data.data
                    if (response.data=='Error')  
                         $state.complete();

                         
                     if(pedidos.length)
                     {
                         setTimeout(() => {
                             that.items=that.items.concat(pedidos);
                               $state.loaded();
                         }, 250);
                     }
                     else 
                        $state.complete();

                  
                }).catch((error)=>{  });
            },
            color: function (key) {
                switch (key.toUpperCase()) {
                    case 'PENDIENTE':
                        return { title: 'Su pedido será atentido pronto.', color:'btn btn-warning '}
                    case 'ACEPTADO':
                        return { title: 'Estamos preparando su pedido.', color:'btn btn-success '}
                    case 'CANCELADO':
                        return { title: '', color:'btn btn-danger '}
                    case 'ENVIANDO':
                        return { title: 'Su pedido está en camino, muchas gracias :)' , color:'btn btn-primary '}
                    case 'ENTREGADO':
                        return { title: 'Su pedido está en camino, muchas gracias :)' , color:'btn btn-success '}
                    default:
                        break;
                }
            }
        },
        mounted() {
            this.listPedidos();

        },
        created(){
            Echo.channel(`ordersClient.${this.user}`)
                .listen('ChangeStateOrderEvent', ({data}) => {
                    this.items.map( (item) => {
                        if(item.pedido === data.pedido.idpedido) {
                            item.state = data.state;
                            var messageNotify = `El pedido al negocio "${item.empresa}" con código ${data.pedido.idpedido} \n ${data.state == 'ENVIANDO' ? 'Se está ': 'Ha sido '} ${data.state}\n
                                 ${data.state === 'CANCELADO' ? 'Motivo: ' + data.comentario: ''}`
                            this.notifyPush(messageNotify)
                            Swal.fire(
                               'Cambio de estado',
                                messageNotify,
                                `${data.state === 'CANCELADO' ? 'error' : 'success'}`
                            ).then((data) => {location.href = '/pedidos'});
                        }
                    });
            });
        }
    }
</script>
