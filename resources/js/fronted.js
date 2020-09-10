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
Vue.component('loader', require('./components/extras/LoaderFront.vue').default)

Vue.component('mapa-interactivo', require('./components/maps/MapaInteractivo.vue').default);
//FRONT CLIENTE
Vue.component('modal-carrito', require('./components/front/ModalCarrito.vue').default)
Vue.component('modal-pedidos', require('./components/front/ModalPedidos.vue').default)

/*Front*/
Vue.component('front-categories-component', require('./components/front/categoriesComponent.vue').default)
Vue.component('front-menu-component', require('./components/front/menuComponent.vue').default)
Vue.component('front-cart-component', require('./components/front/cartComponent.vue').default)
Vue.component('form-wizard-unt', require('./components/formWizard/App.vue').default);
Vue.component('front-pedidos-component', require('./components/front/pedidosComponent.vue').default);
Vue.component('front-seguimiento-component', require('./components/front/seguimientoComponent.vue').default);
Vue.component('list-type-A', require('./components/front/listCartA.vue').default)
Vue.component('cart-new', require('./components/front/cartNuevo.vue').default)
Vue.component('method-envio', require('./components/front/methodEnvio.vue').default)
Vue.component('ubication', require('./components/front/ubication.vue').default)
Vue.component('pago', require('./components/front/cartPago.vue').default)
Vue.component('detail-pago', require('./components/front/detailCart.vue').default)

Vue.component('tenvio-promo-component', require('./components/landing_pages/tenvio_promo.vue').default);
Vue.component('tenvio-registro-component', require('./components/landing_pages/tenvio_registro.vue').default);
Vue.component('tenvio-padre-component', require('./components/landing_pages/tenvio_padre.vue').default);

Vue.component('recover-component', require('./components/front/recoverComponent.vue').default);
Vue.component('post-recover-component', require('./components/front/postRecoverComponent.vue').default);

Vue.component('list-map', require('./components/front/inList_Map.vue').default);

Vue.component('search-bussiness-near', require('./components/front/bussiness_near/searchBussinessNearComponent.vue').default);

Vue.component('foto-perfil', require('./components/auth/fotoPerfil.vue').default);
Vue.component('user-perfil', require('./components/auth/perfil.vue').default);
Vue.component('clave-perfil', require('./components/auth/contraseña.vue').default);


// const EventBus = new Vue();
const app = new Vue({
    el: '#app',
});
