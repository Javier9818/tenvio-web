<template>
    <div class="container text-center">
        <div class="row">
            <div class="table-responsive">
                <b-container fluid>
					<b-table show-empty small stacked="md" :items="datos" :fields="columnas" empty-text="No hay elementos para mostrar">
						<template v-slot:cell(opciones)="row">
							<!--<a :href="'/panel/cuestionario/mantenedor/' + row.item.id_cuestionario">Ver</a>-->
							editar, eliminar
						</template>
					</b-table>
				</b-container>
            </div>
        </div>
		<div class="text-center">
			<button class="btn btn-primary" v-b-modal.modal-mantenedor>Nuevo Producto</button>
		</div>
		<b-modal id="modal-mantenedor" size="sm" centered hide-backdrop title="Nuevo Producto" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Descripcion"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="descripcion" placeholder="Descripcion"></b-form-input>
				</b-form-group>
				<b-form-group
				label="Categoría"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-select v-model="categoria" :options="categorias"></b-form-select>
				</b-form-group>
				<b-form-group
				label="Precio"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0">
					<b-form-input v-model="precio" type="number" placeholder="Precio"></b-form-input>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<br>
				<b-button variant="danger" size="sm" @click="$bvModal.hide('modal-mantenedor')">Cancelar</b-button>
				<b-button variant="success" size="sm">Aceptar</b-button>
			</div>
			<br>
		</b-modal>
    </div>
</template>

<script>
export default {
	data() {
		return {
			datos: [],
			columnas: [
				{ key: 'id', label: 'Id' },
				{ key: 'descripcion', label: 'Descripcion' },
				{ key: 'categoria', label: 'Categoria' },
				{ key: 'precio', label: 'Precio' },
				{ key: 'opciones', label: 'Opciones' }
			],
			descripcion: '',
			categoria: null,
			precio: '',
			categorias: [
          		{ value: null, text: 'Seleccione', disabled: true },
				{ value: 'a', text: 'Option' },
				{ value: 'b', text: 'Option' }
			]
		}
	},
	methods: {
		cargarProductos: function(){
			var that = this;
			axios.post('/')
			.then(function (response) {
				that.datos = response.data;
			});
		}
	},
	mounted() {
	},
	created: function(){
		this.cargarProductos();
	}
}
</script>
