window.Vue = require('vue');

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '23df8ad0a8b7617a4838',
    cluster: 'us2'
    // wsHost: window.location.hostname,
    // wsPort: 6001,
    // disableStats: true
});

require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
Vue.$cookies.config('1d')


//loader circular
Vue.component('loader', require('./components/Utils/LoaderFront.vue').default)


//FRONT CLIENTE
Vue.component('modal-carrito', require('./components/Cliente/ModalCarrito.vue').default)
Vue.component('modal-pedidos', require('./components/Cliente/ModalPedidos.vue').default)

/*Front*/
Vue.component('front-categories-component', require('./components/Cliente/categoriesComponent.vue').default)
Vue.component('front-menu-component', require('./components/Cliente/menuComponent.vue').default)
Vue.component('front-cart-component', require('./components/Cliente/cartComponent.vue').default)
Vue.component('form-wizard-unt', require('./components/Cliente/formWizard/App.vue').default);
Vue.component('front-pedidos-component', require('./components/Cliente/pedidosComponent.vue').default);
Vue.component('front-seguimiento-component', require('./components/Cliente/seguimientoComponent.vue').default);
Vue.component('list-type-A', require('./components/Cliente/listCartA.vue').default)
Vue.component('cart-new', require('./components/Cliente/cartNuevo.vue').default)
Vue.component('method-envio', require('./components/Cliente/methodEnvio.vue').default)
Vue.component('ubication', require('./components/Cliente/ubication.vue').default)
Vue.component('pago', require('./components/Cliente/cartPago.vue').default)
Vue.component('detail-pago', require('./components/Cliente/detailCart.vue').default)

Vue.component('tenvio-promo-component', require('./components/Cliente/landing_pages/tenvio_promo.vue').default);
Vue.component('tenvio-registro-component', require('./components/Cliente/landing_pages/tenvio_registro.vue').default);
Vue.component('tenvio-padre-component', require('./components/Cliente/landing_pages/tenvio_padre.vue').default);

Vue.component('recover-component', require('./components/Cliente/recoverComponent.vue').default);
Vue.component('post-recover-component', require('./components/Cliente/postRecoverComponent.vue').default);

Vue.component('list-map', require('./components/Cliente/inList_Map.vue').default);

Vue.component('search-bussiness-near', require('./components/Cliente/bussiness_near/searchBussinessNearComponent.vue').default);


// const EventBus = new Vue();
const app = new Vue({
    el: '#app',
});
