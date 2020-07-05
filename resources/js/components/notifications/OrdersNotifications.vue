<template>
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
            <i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i>
            <span class="badge badge-pill badge-sm badge-danger badge-up badge-glow">{{orders.length + countIntelligence}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <div class="arrow_box_right">
            <li class="dropdown-menu-header">
                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificaciones</span></h6>
            </li>
            <li class="scrollable-container media-list w-100 ps">
                <a href="/intranet/pedidos" v-for="order in orders" :key="order.idpedido">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-share info font-medium-4 mt-2"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading info">Nuevo pedido recibido</h6>
                        <p class="notification-text font-small-3 text-muted text-bold-600">{{order.nombres}}</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"></time></small>
                        </div>
                    </div>
                </a>
                <a href="/intranet/pedidos" v-if="pendientes > 0">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-alert-circle font-medium-4 mt-2 warning"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading secondary">{{pendientes}} pedidos pendientes</h6>
                        </div>
                    </div>
                </a>
                <a href="/intranet/asignar-delivery" v-if="aceptadas > 0">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-alert-circle font-medium-4 mt-2 warning"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading secondary">{{aceptadas}} pedidos aceptados</h6>
                        </div>
                    </div>
                </a>
                <a href="/intranet/transporte" v-if="enviadas > 0">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-alert-circle font-medium-4 mt-2 warning"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading secondary">{{enviadas}} pedidos en transporte</h6>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0)" v-if="orders.length + countIntelligence === 0">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-check font-medium-4 mt-2 success"></i></div>
                        <div class="media-body">
                            <h6 class="media-heading ">No tiene nuevas notificaciones</h6>
                        </div>
                    </div>
                </a>

                <!--
                <a href="javascript:void(0)">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-repeat font-medium-4 mt-2 danger"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading danger">New Purchase</h6>
                        <p class="notification-text font-small-3 text-muted text-bold-600">Lorem ipsum dolor sit ametest?</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0)">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-shopping-cart font-medium-4 mt-2 primary"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading primary">New Item In Your Cart</h6><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                        </div>
                    </div>
                </a>
                <a href="javascript:void(0)">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-heart font-medium-4 mt-2 info"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading info">New Sale</h6><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                        </div>
                    </div>
                </a> -->
                <!-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                    </div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
                    </div>
                </div> -->
            </li>
            <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="/intranet/pedidos">Ver pedidos</a></li>
            </div>
        </ul>
    </li>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        mounted() {
            axios.get(`/api/notifications/${empresa.id || empresa}`)
				.then(({data}) => {
                    this.pendientes = data.ordenesPendientes;
                    this.aceptadas = data.ordenesAceptadas;
                    this.enviadas = data.ordenesEnviadas;
                    this.countIntelligence = (data.ordenesPendientes > 0 ? 1:0) + (data.ordenesAceptadas > 0 ? 1:0) + (data.ordenesEnviadas > 0 ? 1:0);
				})
				.catch(()=>{
					Swal.fire(
						'Error',
						'Hubo un error inesperado, por favor contactese con el administrador del sistema',
						'error'
					)
				});
        },
        data(){
            return {
                orders:[],
                pendientes:0,
                aceptadas:0,
                enviadas:0,
                countIntelligence:0
            }
        },
        methods: {
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
        },
        created(){
            Echo.channel(`ordersCompany.${company || 0}`)
            .listen('NewOrderEvent', (e) => {

                if (e.order == null) return;
                else{
                    this.orders.push(e.order);
                    var messageNotify = `Tienes nueo pedido, revisa tus notificaciones`
                    this.notifyPush(messageNotify)
                }

            });
        }
    }
</script>
