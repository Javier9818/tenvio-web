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
			<button class="btn btn-primary" @click="nuevo" v-b-modal.modal-mantenedor>Nueva Categoría</button>
		</div>
		<b-modal id="modal-mantenedor" size="sm" centered hide-backdrop :title="texto+' Categoría'" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Descripcion"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="md"
				class="mb-0">
					<b-form-input v-model="categoria.descripcion" placeholder="Descripcion" :state="$v.categoria.descripcion.required"></b-form-input>
					<div class="text-danger" v-if="!$v.categoria.descripcion.required">La descripcion es requerida</div>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<br>
				<loader :mostrar="mostrarLoader"></loader>
				<br>
				<b-button variant="danger" size="sm" @click="cerrarModal">Cancelar</b-button>
				<b-button variant="success" size="sm" @click="setupddel(false)" :disabled="$v.$invalid || mostrarLoader">{{texto}}</b-button>
			</div>
			<br>
		</b-modal>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import { required } from 'vuelidate/lib/validators'
export default {
	data() {
		return {
			ruta: '/intranet/categorias',
			datos: [],
			columnas: [
				{ key: 'id', label: 'Id' },
				{ key: 'descripcion', label: 'Descripcion' },
				{ key: 'opciones', label: 'Opciones' }
			],
			categoria: {
				id: 0,
				descripcion: ''
			},
			texto: 'Registrar',
			mostrarLoader: false,
		}
	},
	validations: {
		categoria: {
			descripcion: { required }
		}
	},
	methods: {
		cargarCategorias: function(){
			this.datos = [];
			this.mostrarLoader = true;
			var that = this;
			axios.post(this.ruta+'/listar')
			.then(function (response) {
				that.datos = response.data;
			})
			.finally(() =>{
				that.mostrarLoader = false;
			});
		},
		cerrarModal(){
			this.$bvModal.hide('modal-mantenedor');
		},
		setupddel: function(eliminar){
			this.mostrarLoader = true;
			var that = this;
			axios.post(this.ruta+'/setupddel', {categoria: this.categoria, eliminar: eliminar})
			.then(function (response) {
				console.log(response);
				console.log(response.data);
				console.log(response.data==true);
				if(response.data == true){
					Swal.fire('Éxito', 'Se han guardado los cambios', 'success');
					that.cerrarModal();
					that.cargarCategorias();
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
		nuevo: function(){
			this.texto = "Registrar";
			this.categoria.id = 0;
			this.categoria.descripcion = "";
		},
		editar: function(item){
			this.texto = "Modificar";
			this.categoria.id = item.id;
			this.categoria.descripcion = item.descripcion;
		},
		eliminar: function(item){
			this.categoria.id = item.id;
			this.setupddel(true);
		},
	},
	mounted() {
	},
	created: function(){
		this.cargarCategorias();
	}
}
</script>
