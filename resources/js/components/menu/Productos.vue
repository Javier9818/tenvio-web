<template>
    <div class="container-fluid text-center">
		<loader :mostrar="mostrarLoader"></loader>

		<div class="row">
			<div v-for="product in datos" :key="product.id" class="col-12 col-md-6 col-xl-4">
				<div class="card">
					<div class="img-card">
						<img  :src="`/storage/imgproductos/${product.foto}`" alt="Card image cap">
					</div>
					<div class="card-body text-left">
						<div class="row mb-1">
							<b class="col-4">Nombre: </b> <div class="col-8">{{product.nombre}}</div>
						</div>
						<div class="row mb-1">
							<b class="col-4">Descripción: </b> <div class="col-8">{{product.descripcion}}</div>
						</div>
						<div class="row mb-1">
							<b class="col-4">Categoria: </b> <div class="col-8">{{product.categoria}}</div>
						</div>
						<div class="row mb-1">
							<b class="col-4">Precio: </b> <div class="col-8">S/.{{product.precio}}</div>
						</div>
						
						<div class="row justify-content-center">
							<b-button variant="warning" class="mr-1" size="sm" @click="editar(product)" v-b-modal.modal-mantenedor :disabled="mostrarLoader">Editar</b-button>
							<b-button variant="info" class="mr-1" size="sm" v-if="product.usuario_puede_ver==1" @click="mostrarocultar(row.item)" :disabled="mostrarLoader">Ocultar</b-button>
							<b-button variant="success" class="mr-1" size="sm" v-else @click="mostrarocultar(product)" :disabled="mostrarLoader">Mostrar</b-button>
							<b-button variant="danger"  size="sm" @click="eliminar(product)" :disabled="mostrarLoader">Eliminar</b-button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="contenedor">
			<button class="botonF1" v-b-modal.modal-mantenedor @click="nuevo" title="Nuevo producto">
				<span>+</span>
			</button>
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
					<div class="text-danger" v-if="!$v.producto.nombre.nombreProducto">El nombre del producto no puede contener caracteres especiales</div>
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
					<div class="text-danger" v-if="!$v.producto.descripcion.nombreProductoDescripcion">La descripcion no puede contener caracteres especiales</div>
				</b-form-group>
				<b-form-group
				label="Categoría"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0"
				style="position:relative; z-index:4;">
					<model-list-select v-model="producto.categorias_menu_id" :list="categorias" option-value="value" option-text="text" placeholder="Seleccione Categoría"></model-list-select>
					<div class="text-danger" v-if="!$v.producto.categorias_menu_id.required">Seleccione una categoría</div>
				</b-form-group>
				<b-form-group
				label="Precio"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0"
				style="position:relative; z-index:1;">
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
	import { nombreProducto, nombreProductoDescripcion } from '../../utils/expresiones-regulares.js'
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
					usuario_puede_ver: 1
				},
				rutaImagenes: '',
				texto: 'Registrar',
				deshabilitaboton: false,
				mostrarLoader: false,
			}
		},
		validations: {
			producto: {
				nombre: { required, nombreProducto },
				descripcion: { required, nombreProductoDescripcion },
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
				this.producto.usuario_puede_ver = 1;
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
				this.producto.usuario_puede_ver = item.usuario_puede_ver;
			},
			eliminar: function(item){
				this.producto.id = item.id;
				this.producto.foto = '';
				this.producto.fotoSubida = '';
				this.setupddel(true);
			},
			mostrarocultar: function(item){
				this.editar(item);
				if (this.producto.usuario_puede_ver == 0)
					this.producto.usuario_puede_ver = 1;
				else
					this.producto.usuario_puede_ver = 0;
				this.setupddel(false);
			},
			setupddel: function(eliminar){
				console.log(this.producto);
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
					else if(response.data.mensaje != null){
						Swal.fire('Hay un problema', response.data.mensaje, 'error');
					}
					else{
						Swal.fire('Error', 'Ha sucedido un error, recargue la página e intente nuevamente', 'error');
					}
				})
				.catch(function(error){
					Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
				})
				.finally(function(){
					that.mostrarLoader = false;
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

<style scoped>
	.img-card{
		padding: 10px;
		height: 200px;
		display:flex;
		align-items: center;
		justify-content: center;
	}

	

	@supports(object-fit: cover){
		.img-card img{
			height: 100%;
			object-fit: cover;
			object-position: center center;
		}
	}
</style>
