<template>
    <div class="container text-center">
        <div class="row">
            <div class="table-responsive">
                <b-container fluid>
					<b-table show-empty small stacked="md" :items="datos" :fields="columnas" empty-text="No hay elementos para mostrar">
						<template v-slot:cell(opciones)="row">
							<!--<a :href="'/panel/cuestionario/mantenedor/' + row.item.id_cuestionario">Ver</a>-->
							<b-button variant="warning" size="sm" @click="editar(row.item)" v-b-modal.modal-mantenedor>Editar</b-button>
							<b-button variant="danger" size="sm" @click="eliminar(row.item)">Eliminar</b-button>
						</template>
					</b-table>
				</b-container>
            </div>
        </div>
		<div class="text-center">
			<button class="btn btn-primary" v-b-modal.modal-mantenedor>Nuevo Producto</button>
		</div>
		<b-modal id="modal-mantenedor" size="sm" centered hide-backdrop :title="texto+' Producto'" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Nombre"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.nombre" placeholder="Nombre"></b-form-input>
				</b-form-group>
				<b-form-group
				label="Descripcion"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.descripcion" placeholder="Descripcion"></b-form-input>
				</b-form-group>
				<b-form-group
				label="Categoría"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<model-list-select v-model="producto.categorias_menu_id" :list="categorias" option-value="value" option-text="text" placeholder="Seleccione Categoría"></model-list-select>
				</b-form-group>
				<b-form-group
				label="Precio"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.precio" type="number" placeholder="Precio"></b-form-input>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<br>
				<b-button variant="danger" size="sm" @click="cerrarModal">Cancelar</b-button>
				<b-button variant="success" size="sm" @click="setupddel(false)">{{texto}}</b-button>
			</div>
			<br>
		</b-modal>
    </div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			rutaCategorias: '/intranet/categorias',
			ruta: '/intranet/productos',
			datos: [],
			columnas: [
				{ key: 'id', label: 'Id' },
				{ key: 'nombre', label: 'Nombre' },
				{ key: 'descripcion', label: 'Descripcion' },
				{ key: 'categoria', label: 'Categoria' },
				{ key: 'precio', label: 'Precio' },
				{ key: 'opciones', label: 'Opciones' }
			],
			categorias: [],
			producto: {
				id: 0,
				nombre: '',
				descripcion: '',
				precio: 0,
				categorias_menu_id: null,
			},
			texto: 'Registrar',
		}
	},
	methods: {
		cargarCategorias: function(){
			var that = this;
			axios.post(this.rutaCategorias+'/listarvselect')
			.then(function (response) {
				that.categorias = response.data;
			});
		},
		cerrarModal(){
			this.$bvModal.hide('modal-mantenedor');
		},
		nuevo: function(){
			this.texto = "Registrar";
			this.producto.id = 0;
			this.producto.nombre = '';
			this.producto.descripcion = '';
			this.producto.precio = 0;
			this.producto.categorias_menu_id = null;
		},
		editar: function(item){
			console.log(item);
			this.texto = "Modificar";
			this.producto.id = item.id;
			this.producto.nombre = item.nombre;
			this.producto.descripcion = item.descripcion;
			this.producto.precio = item.precio;
			this.producto.categorias_menu_id = item.categorias_menu_id;
		},
		eliminar: function(item){
			console.log(item);
			this.setupddel(true);
		},
		setupddel: function(eliminar){
			//console.log(this.categoria);
			var that = this;
			axios.post(this.ruta+'/setupddel', {producto: this.producto, eliminar: eliminar})
			.then(function (response) {
				//console.log(response.data);
				if(response.data){
					Swal.fire('Éxito', 'Se han guardado los cambios', 'success');
					that.cerrarModal();
					that.cargarProductos();
				}
				else{
					Swal.fire('Error', 'Ha sucedido un error, recargue la página e intente nuevamente', 'error');
				}
			})
			.catch(function(error){
				Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
			})
			.finally(function(){

			});
		},
		cargarProductos: function(){
			var that = this;
			axios.post(this.ruta+'/listar')
			.then(function (response) {
				that.datos = response.data;
			});
		}
	},
	mounted() {
	},
	created: function(){
		this.cargarCategorias();
		this.cargarProductos();
	},
    components: {
      ModelListSelect
    }
}
</script>
