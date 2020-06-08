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
                        style="color:white;"> {{(item.state).toUpperCase()}}

                    </button>
                </div><!-- /.cart-item-content -->
                </li>
            </ul>
            <div class="cart-action">
                <a href="/pedidos" class="mt-2">Ir a panel de seguimiento</a>
            </div><!-- /.cart-action -->
        </div>
    </div>
</template>

<script>
    import EventBus from '../../event-bus';
    import Swal from 'sweetalert2'
    export default {
        props:['user'],
        data(){
            return {
                items: [
                ]
            }
        },
        methods:{
            listPedidos: function () {
                var that = this;
                axios.post('/front/ListPedido')
                .then(function (response) {
                    that.items= response.data;
                    console.log(response.data);
                }).catch((error)=>{ console.log('Login please')});
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
            console.log('ModalPedidos - Mountedww');
        },
        created(){
            Echo.channel(`ordersClient.${this.user}`)
                .listen('ChangeStateOrderEvent', ({data}) => {
                    console.log(data);
                    this.items.map( (item) => {
                        if(item.pedido === data.pedido.idpedido) {
                            item.state = data.state;
                            Swal.fire(
                                'Cambio de estado',
                                `El pedido al negocio "${item.empresa}" con código ${data.pedido.idpedido} <br> ${data.state == 'ENVIANDO' ? 'Se está ': 'Ha sido '} ${data.state}<br>
                                 ${data.state === 'CANCELADO' ? 'Motivo: ' + data.comentario: ''}`,
                                `${data.state === 'CANCELADO' ? 'error' : 'success'}`
                            ).then((data) => {location.href = '/pedidos'});

                        }
                    });

            });
        }
    }
</script>
