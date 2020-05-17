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
			<button class="btn btn-primary" v-b-modal.modal-mantenedor>Nueva Categoría</button>
		</div>
		<b-modal id="modal-mantenedor" size="sm" centered hide-backdrop title="Nueva Categoría" hide-footer>
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
				{ key: 'opciones', label: 'Opciones' }
			],
			descripcion: ''
		}
	},
	methods: {
		cargarCategorias: function(){
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
		this.cargarCategorias();
	}
}
</script>
