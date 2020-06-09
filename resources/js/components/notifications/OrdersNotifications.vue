<template>
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="javascript:void(0)" data-toggle="dropdown">
            <i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i>
            <span class="badge badge-pill badge-sm badge-danger badge-up badge-glow">{{orders.length}}</span>
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
                <a href="javascript:void(0)" v-if="orders.length === 0">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="media-heading info">No tiene nuevos pedidos</h6>
                        </div>
                    </div>
                </a>
                <!-- <a href="javascript:void(0)">
                    <div class="media">
                        <div class="media-left align-self-center"><i class="ft-save font-medium-4 mt-2 warning"></i></div>
                        <div class="media-body">
                        <h6 class="media-heading warning">New User Registered</h6>
                        <p class="notification-text font-small-3 text-muted text-bold-600">Aliquam tincidunt mauris eu risus.</p><small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">10:05 AM</time></small>
                        </div>
                    </div>
                </a>
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
            <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="/intranet/pedidos">Ver todos</a></li>
            </div>
        </ul>
    </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                orders:[]
            }
        },
        created(){
            Echo.channel(`ordersCompany.${company || 0}`)
            .listen('NewOrderEvent', (e) => {
                console.log(e);
                if (e.order == null) return;
                this.orders.push(e.order);
            });
        }
    }
</script>
