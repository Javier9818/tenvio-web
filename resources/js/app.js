/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');
require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '23df8ad0a8b7617a4838',
    cluster: 'us2'
    //key: process.env.MIX_PUSHER_APP_KEY,
    // wsHost: window.location.hostname,
    // wsPort: 6001,
    // disableStats: true
});



//bustrapVue
//import { BootstrapVueIcons } from 'bootstrap-vue'
//Vue.use(BootstrapVueIcons)



//File agent
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
Vue.use(VueFileAgent);

//Vue-search-select
import 'vue-search-select/dist/VueSearchSelect.css';

//Vue-loaders
import 'vue-loaders/dist/vue-loaders.css'
import VueLoaders from 'vue-loaders'
Vue.use(VueLoaders)


//Vuelidate
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


//import Leaflet from 'leaflet'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('orders-notifications', require('./components/Empresa/notifications/OrdersNotifications.vue').default);
Vue.component('ventas-component', require('./components/Empresa/contabilidad/VentasComponent.vue').default);
Vue.component('pagos-component', require('./components/Empresa/contabilidad/PagosComponent.vue').default);
Vue.component('pedido-component', require('./components/Empresa/PedidoComponent.vue').default);
Vue.component('entrega-local-component', require('./components/Empresa/EntregaLocalComponent.vue').default);
Vue.component('asignacion-component', require('./components/Empresa/AsignacionComponent.vue').default);
Vue.component('estado-pedido-component', require('./components/Empresa/EstadoPedidoComponent.vue').default);
Vue.component('detalle-asignacion-component', require('./components/Empresa/DetalleAsignacionComponent.vue').default);
Vue.component('form-empleado', require('./components/Empresa/negocio/FormEmpleado.vue').default);
Vue.component('table-empleados', require('./components/Empresa/negocio/TableEmpleados.vue').default);
Vue.component('info-empresa', require('./components/Empresa/negocio/InformacionEmpresaComponent.vue').default);
Vue.component('foto-portada-empresa', require('./components/Empresa/negocio/PortadaEmpresa.vue').default);
Vue.component('data-empresa', require('./components/Empresa/negocio/InformacionEmpresa.vue').default);
Vue.component('form-empresa-edit', require('./components/Empresa/negocio/FormularioEmpresa.vue').default);
Vue.component('tipo-entrega', require('./components/Empresa/config/TipoEntregas.vue').default);
Vue.component('nombre-publico', require('./components/Empresa/config/NombrePublico.vue').default);
Vue.component('token-red-social', require('./components/Empresa/config/TokenFacebook.vue').default);
Vue.component('ubicacion-component', require('./components/Empresa/config/Ubicacion.vue').default);
Vue.component('tipo-pago', require('./components/Empresa/config/TipoPagos.vue').default);
Vue.component('transporte-component', require('./components/Empresa/Transporte/Transporte.vue').default);
Vue.component('menu-categorias', require('./components/Empresa/menu/Categorias.vue').default);
Vue.component('menu-productos', require('./components/Empresa/menu/Productos.vue').default);
Vue.component('loader', require('./components/Utils/LoaderAdmin.vue').default) /*loader pacman*/


//PARTE DEL ADMINISTRADOR GLOBAL
Vue.component('form-empresa-register', require('./components/admin/FormEmpresas.vue').default);
Vue.component('table-empresas', require('./components/Admin/TableEmpresas.vue').default);
Vue.component('table-tiponegocio', require('./components/Admin/TableTipoNegocios.vue').default);
Vue.component('table-solicitudes', require('./components/Admin/TableSolicitudes.vue').default);
Vue.component('cobros-component', require('./components/Admin/CobrosComponent.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
*/

const app = new Vue({
    el: '#app',
});
