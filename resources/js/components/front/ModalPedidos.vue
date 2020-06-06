<template>
    <div>
        <a href="#" class="navbar__action-btn navbar__action-btn-pedido">
                <i class="fa fa-bell"></i><span class="cart__label">{{items.length}}</span>
        </a>
        <div class="pedido-popup main-menu">
            <ul class="list-unstyled  " style=" overflow: auto; height:250px;word-wrap: break-word; width:110%;">
                <li class="cart-item" v-for="(item, index) of items" :key="index">                 
                <div class="cart__item-content">
                    <h6 class="cart__item-title">   {{item.empresa}}</h6>
                    <div class="cart__item-detail"> {{item.date}}</div>  
                    <div :class="color(item.state) + ' btn-sm btn-block '"> {{item.state}} </div>                                                
                </div><!-- /.cart-item-content -->
                </li>
            </ul>           
            <div class="cart-action d-flex justify-content-between">
                <!-- <a href="/pedidos" class="btn btn__primary btn__hover2 btn-block">Ver más</a>                 -->
            </div><!-- /.cart-action -->
        </div>        
    </div>
</template>

<script>     
    import EventBus from '../../event-bus';
    export default {      
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
                }); 
            },
            color: function (key) {
                switch (key) {
                    case 'PENDIENTE':
                        return 'btn btn-warning '                    
                    case 'ACEPTADO':
                        return 'btn btn-primary '                   
                    case 'CANCELADO':
                        return 'btn btn-danger '                    
                    case 'ENVIANDO':
                        return 'btn btn-primary '                   
                    case 'ENTREGADO':
                        return 'btn btn-success '                                      
                    default:
                        break;
                }
            }
        } ,
        computed()
        {

        },
        mounted() {
            this.listPedidos();
            console.log('ModalPedidos - Mounted')
        } 
    }
</script>
