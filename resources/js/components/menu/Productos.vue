<template>
    <div class="container text-center">
		<loader :mostrar="mostrarLoader"></loader>
        <div class="row">
            <div class="table-responsive">
                <b-container fluid>
					<b-table show-empty small stacked="md" :items="datos" :fields="columnas" empty-text="No hay elementos para mostrar">
						<template v-slot:cell(opciones)="row">
							<!--<a :href="'/panel/cuestionario/mantenedor/' + row.item.id_cuestionario">Ver</a>-->
							<b-button variant="warning" size="sm" @click="editar(row.item)" v-b-modal.modal-mantenedor>Editar</b-button>
							<b-button variant="danger" size="sm" @click="eliminar(row.item)" :disabled="mostrarLoader">Eliminar</b-button>
						</template>
					</b-table>
				</b-container>
            </div>
        </div>
		<div class="text-center">
			<button class="btn btn-primary" v-b-modal.modal-mantenedor @click="nuevo">Nuevo Producto</button>
		</div>
		<b-modal id="modal-mantenedor" size="lg" scrollable centered hide-backdrop :title="texto+' Producto'" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Nombre"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.nombre" placeholder="Nombre"></b-form-input>
					<div class="text-danger" v-if="!$v.producto.nombre.required">Campo requerido</div>
				</b-form-group>
				<b-form-group
				label="Descripcion"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.descripcion" placeholder="Descripcion"></b-form-input>
					<div class="text-danger" v-if="!$v.producto.descripcion.required">Campo requerido</div>
				</b-form-group>
				<b-form-group
				label="Categoría"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<model-list-select v-model="producto.categorias_menu_id" :list="categorias" option-value="value" option-text="text" placeholder="Seleccione Categoría"></model-list-select>
					<div class="text-danger" v-if="!$v.producto.categorias_menu_id.required">Seleccione una categoría</div>
				</b-form-group>
				<b-form-group
				label="Precio"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="producto.precio" type="number" placeholder="Precio"></b-form-input>
					<div class="text-danger" v-if="!$v.producto.precio.minValue">El precio debe ser mayor a 0</div>
				</b-form-group>
				<b-form-group
				label="Foto del Producto"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0"
				:hidden="texto=='Modificars'">
					<div class="text-center">
						<b-img :src="'/'+rutaImagenes+producto.foto" :hidden="producto.foto==''" class="img-fluid"></b-img>
					</div>
					<sube-archivos @archivosubido="archivosubido"></sube-archivos>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<br>
				<loader :mostrar="mostrarLoader"></loader>
				<br>
				<b-button variant="danger" size="sm" @click="cerrarModal">Cancelar</b-button>
				<b-button variant="success" size="sm" @click="setupddel(false)" :disabled="$v.$invalid || mostrarLoader || deshabilitaboton">{{texto}}</b-button>
			</div>
			<br>
		</b-modal>
    </div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import { required, minValue } from 'vuelidate/lib/validators'
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
				foto: '',
				categorias_menu_id: null,
				fotosubida: null,
			},
			rutaImagenes: '',
			texto: 'Registrar',
			deshabilitaboton: false,
			mostrarLoader: false,
		}
	},
	validations: {
		producto: {
			nombre: { required },
			descripcion: { required },
			categorias_menu_id: { required },
			precio: { minValue: (value) => value > 0 }
		},
	},

	methods: {
		archivosubido: function({valor, fileRecords}){
			if (fileRecords.length == 1)
				fileRecords[0].urlResized = '.';
			console.log({valor, fileRecords});
			this.producto.fotosubida = fileRecords;
			this.deshabilitaboton = valor;

		},
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
			this.producto.foto = '';
			this.producto.fotosubida = null;
			this.producto.categorias_menu_id = null;
		},
		editar: function(item){
			console.log(item);
			this.texto = "Modificar";
			this.producto.id = item.id;
			this.producto.nombre = item.nombre;
			this.producto.descripcion = item.descripcion;
			this.producto.precio = item.precio;
			this.producto.foto = item.foto;
			this.producto.categorias_menu_id = item.categorias_menu_id;
		},
		eliminar: function(item){
			this.producto.id = item.id;
			this.producto.foto = '';
			this.producto.fotoSubida = '';
			this.setupddel(true);
		},
		setupddel: function(eliminar){
			console.log(this.producto);
			if(eliminar == false){
				if (this.producto.nombre == ''){
					Swal.fire('Advertencia', 'Debe ingresar un nombre de producto', 'warning');
					return;
				}
				if (this.producto.descripcion == ''){
					Swal.fire('Advertencia', 'Debe ingresar una descripcion del producto ', 'warning');
					return;
				}
				if (this.producto.precio <= 0){
					Swal.fire('Advertencia', 'El precio del producto debe ser mayor a s/0.00', 'warning');
					return;
				}
				if (this.producto.categorias_menu_id == null){
					Swal.fire('Advertencia', 'Debe ingresar la categoría del producto ', 'warning');
					return;
				}
			}
			this.mostrarLoader = true;
			var that = this;
			axios.post(this.ruta+'/setupddel', {producto: this.producto, eliminar: eliminar})
			.then(function (response) {
				//console.log(response.data);
				if(response.data == true){
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
				that.mostrarLoader = true;
			});
		},
		cargarProductos: function(){
			this.datos = [];
			this.mostrarLoader = true;
			var that = this;
			axios.post(this.ruta+'/listar')
			.then(function (response) {
				that.datos = response.data.productos;
				that.rutaImagenes = response.data.rutaImagenes;
			})
			.finally(()=>{
				that.mostrarLoader = false;
			});
		}
	},
	mounted() {
		console.log(this.$v.producto);
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
