/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
window.Vue = require('vue');

//bustrapVue
//import { BootstrapVueIcons } from 'bootstrap-vue'
//Vue.use(BootstrapVueIcons)

//sweetalert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

//File agent
import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
Vue.use(VueFileAgent);

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
Vue.component('form-empleado', require('./components/FormEmpleado.vue').default);
Vue.component('sweet-alert', require('./components/AlertComponent.vue').default);
Vue.component('table-empleados', require('./components/TableEmpleados.vue').default);

Vue.component('form-empresa-register', require('./components/superAdmin/FormEmpresas.vue').default);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.component('menu-categorias', require('./components/menu/Categorias.vue').default);
Vue.component('menu-productos', require('./components/menu/Productos.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
