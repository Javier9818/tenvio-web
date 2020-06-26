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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('orders-notifications', require('./components/notifications/OrdersNotifications.vue').default);
Vue.component('ventas-component', require('./components/VentasComponent.vue').default);
Vue.component('pagos-component', require('./components/PagosComponent.vue').default);
Vue.component('pedido-component', require('./components/PedidoComponent.vue').default);
Vue.component('entrega-local-component', require('./components/EntregaLocalComponent.vue').default);
Vue.component('asignacion-component', require('./components/AsignacionComponent.vue').default);
Vue.component('estado-pedido-component', require('./components/EstadoPedidoComponent.vue').default);
Vue.component('detalle-asignacion-component', require('./components/DetalleAsignacionComponent.vue').default);
Vue.component('form-empleado', require('./components/negocio/FormEmpleado.vue').default);
Vue.component('table-empleados', require('./components/negocio/TableEmpleados.vue').default);
Vue.component('info-empresa', require('./components/negocio/InformacionEmpresaComponent.vue').default);
Vue.component('foto-portada-empresa', require('./components/negocio/PortadaEmpresa.vue').default);
Vue.component('data-empresa', require('./components/negocio/InformacionEmpresa.vue').default);
Vue.component('form-empresa-edit', require('./components/negocio/FormularioEmpresa.vue').default);
Vue.component('tipo-entrega', require('./components/config/TipoEntregas.vue').default);
Vue.component('nombre-publico', require('./components/config/NombrePublico.vue').default);
Vue.component('transporte-component', require('./components/transporte/Transporte.vue').default);

Vue.component('form-empresa-register', require('./components/admin/FormEmpresas.vue').default);
Vue.component('table-empresas', require('./components/admin/TableEmpresas.vue').default);
Vue.component('table-solicitudes', require('./components/admin/TableSolicitudes.vue').default);



Vue.component('loader', require('./components/extras/Loader.vue').default)
Vue.component('sube-archivos', require('./components/extras/SubeArchivos.vue').default)

Vue.component('menu-categorias', require('./components/menu/Categorias.vue').default);
Vue.component('menu-productos', require('./components/menu/Productos.vue').default);

Vue.component('foto-perfil', require('./components/auth/fotoPerfil.vue').default);
Vue.component('user-perfil', require('./components/auth/perfil.vue').default);
Vue.component('clave-perfil', require('./components/auth/contraseña.vue').default);

Vue.component('mapa-interactivo', require('./components/maps/MapaInteractivo.vue').default);
Vue.component('card-map', require('./components/maps/CardMapComponent.vue').default);

//FRONT CLIENTE
Vue.component('modal-carrito', require('./components/front/ModalCarrito.vue').default)
Vue.component('modal-pedidos', require('./components/front/ModalPedidos.vue').default)

/*Front*/
Vue.component('front-menu-component', require('./components/front/menuComponent.vue').default)
Vue.component('front-cart-component', require('./components/front/cartComponent.vue').default)

Vue.component('front-pedidos-component', require('./components/front/pedidosComponent.vue').default);
Vue.component('front-seguimiento-component', require('./components/front/seguimientoComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
