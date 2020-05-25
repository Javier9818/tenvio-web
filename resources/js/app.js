/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
window.Vue = require('vue');

import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
Vue.$cookies.config('1d')

//bustrapVue
//import { BootstrapVueIcons } from 'bootstrap-vue'
//Vue.use(BootstrapVueIcons)

//sweetalert
import Swal from 'sweetalert2'
//Vue.use(Swal);

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
Vue.component('ventas-component', require('./components/VentasComponent.vue').default);
Vue.component('pagos-component', require('./components/PagosComponent.vue').default);
Vue.component('pedido-component', require('./components/PedidoComponent.vue').default);
Vue.component('asignacion-component', require('./components/AsignacionComponent.vue').default);
Vue.component('form-empleado', require('./components/negocio/FormEmpleado.vue').default);
Vue.component('table-empleados', require('./components/negocio/TableEmpleados.vue').default);
Vue.component('info-empresa', require('./components/negocio/InformacionEmpresaComponent.vue').default);
Vue.component('foto-portada-empresa', require('./components/negocio/PortadaEmpresa.vue').default);
Vue.component('data-empresa', require('./components/negocio/InformacionEmpresa.vue').default);
Vue.component('form-empresa-edit', require('./components/negocio/FormularioEmpresa.vue').default);
Vue.component('tipo-entrega', require('./components/config/TipoEntregas.vue').default);

Vue.component('form-empresa-register', require('./components/admin/FormEmpresas.vue').default);
Vue.component('table-empresas', require('./components/admin/TableEmpresas.vue').default);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.component('loader', require('./components/extras/Loader.vue').default)
Vue.component('sube-archivos', require('./components/extras/SubeArchivos.vue').default)

Vue.component('menu-categorias', require('./components/menu/Categorias.vue').default);
Vue.component('menu-productos', require('./components/menu/Productos.vue').default);

Vue.component('foto-perfil', require('./components/auth/fotoPerfil.vue').default);
Vue.component('user-perfil', require('./components/auth/perfil.vue').default);
Vue.component('clave-perfil', require('./components/auth/contraseña.vue').default);


//FRONT CLIENTE
Vue.component('modal-carrito', require('./components/front/ModalCarrito.vue').default)


/*Front*/
Vue.component('front-menu-component', require('./components/front/menuComponent.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const EventBus = new Vue();
const app = new Vue({
    el: '#app',
});

