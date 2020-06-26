<template>
	<div class="container">
		<!--
		<div class="row my-1">
			<div class="col-4"><h4>Número total de ventas: 56</h4></div>
			<div class="col-4"><h4>Monto total de ventas: $/.5600</h4></div>
			<div class="col-4"><h4>Monto de deuda: S/.560</h4></div>
		</div>
		-->
		<b-table :bordered="true" :hover="true"  headVariant="dark" :items="contratos" :fields="fields">
			<template v-slot:cell(opciones)="row">
				<b-button v-if="row.item.estado=='PENDIENTE'" v-b-modal.modal-pago variant="success" size="sm" @click="pagar(row.item)">Pagar</b-button>
				<b-button v-if="row.item.estado=='PAGADO'" v-b-modal.modal-pago variant="info" size="sm" @click="verpago(row.item)">Ver Pago</b-button>
			</template>
		</b-table>

		<b-modal id="modal-pago" size="lg" scrollable centered hide-backdrop :title="texto+' Voucher de pago'" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Foto del Voucher"
				label-cols-sm="12"
				label-align-sm="left"
				label-align="center"
				label-size="sm"
				class="mb-0"
				:hidden="texto=='Modificar'">
					<div class="text-center">
						<b-img v-if="texto=='Ver'" :src="'/'+rutaImagenes+fotovoucher" :hidden="fotovoucher==''" class="img-fluid"></b-img>
					</div>
					<sube-archivos v-if="texto=='Registrar'" @archivosubido="archivosubido"></sube-archivos>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<b-button variant="danger" size="sm" @click="cerrarModal">Cerrar</b-button>
				<b-button v-if="texto=='Registrar'" variant="success" size="sm" :disabled="deshabilitaboton">Guardar</b-button>
			</div>
			<br>
		</b-modal>
	</div>
</template>

<script>
export default {
	data() {
		return {
			ruta: '/intranet/pagos',
			// Note 'isActive' is left out and will not appear in the rendered table
			fields: [
				{ key: 'plan_nombre', label:'Plan', sortable: true },
				{ key: 'periodo', label:'Periodo del Contrato', sortable: true },
				//{ key: 'pedidos', label:'Pedidos', sortable: false },
				{ key: 'monto', label: 'Monto', sortable: true },
				{ key: 'estado', label: 'Estado', sortable: true },
				{ key: 'opciones', label: 'Opciones', sortable: true }
			],
			contratos: [],
			rutaImagenes: '',
			fotovoucher: '',
			texto: '',
			fotovouchersubir: '',
			deshabilitaboton: false
		}
	},
	methods:{
		pagar: function(){
			this.texto = 'Registrar';
		},
		verpago: function(){
			this.texto = 'Ver';
		},
		cerrarModal: function(){
			this.$bvModal.hide('modal-pago');
		},
		archivosubido: function({valor, fileRecords}){
			console.log({valor, fileRecords});
			if (fileRecords.length == 1)
				fileRecords[0].urlResized = '.';
			console.log({valor, fileRecords});
			this.fotovouchersubir = fileRecords;
			this.deshabilitaboton = valor;
		},
		cargarContratos: function(){
			var that = this;
			axios.post(this.ruta+'/listacontratos')
			.then(function (response) {
				let datos = response.data;
				datos.forEach((item, index)=>{
					datos[index].periodo = item.fecha_inicio + ' ' + item.fecha_vencimiento;
					datos[index].monto = 'S/ ' + item.monto;
				})
				that.contratos = datos;
			})
			.catch((error)=>{
				Swal.fire(
					'Error',
					'Hubo un error inesperado, por favor contactese con el administrador del sistema',
					'error'
				)
			})
			.finally(()=>{});
		},
	},
	mounted() {
		this.cargarContratos();
	},
}
</script>
