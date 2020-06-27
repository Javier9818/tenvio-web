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
				<b-button v-if="row.item.pagos_id==null || row.item.estado=='ANULADO'" v-b-modal.modal-pago variant="success" size="sm" @click="pagar(row.item, row.index)">Pagar</b-button>
				<b-button v-else v-b-modal.modal-pago variant="info" size="sm" @click="verpago(row.item, row.index)">Ver Pago</b-button>
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
						<b-img v-if="texto=='Ver'" :src="'/'+rutaImagenes+contrato.urlfoto" :hidden="contrato.urlfoto==''" class="img-fluid"></b-img>
					</div>
					<sube-archivos v-if="texto=='Registrar'" @archivosubido="archivosubido"></sube-archivos>
				</b-form-group>
			</b-col>
			<div class="text-center">
				<br>
				<b-button variant="danger" size="sm" @click="cerrarModal">Cerrar</b-button>
				<b-button v-if="texto=='Registrar'" @click="guardarVoucher" variant="success" size="sm" :disabled="deshabilitaboton">Guardar</b-button>
			</div>
			<br>
		</b-modal>
	</div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/intranet/pagos',
			// Note 'isActive' is left out and will not appear in the rendered table
			fields: [
				{ key: 'plan_nombre', label:'Plan', sortable: true },
				{ key: 'periodo', label:'Periodo del Contrato', sortable: true },
				//{ key: 'pedidos', label:'Pedidos', sortable: false },
				{ key: 'monto_', label: 'Monto', sortable: true },
				{ key: 'estado', label: 'Estado', sortable: true },
				{ key: 'opciones', label: 'Opciones', sortable: true }
			],
			contratos: [],
			contrato: {},
			indexcontrato: -1,
			rutaImagenes: '',
			texto: '',
			fotovouchersubir: '',
			deshabilitaboton: false
		}
	},
	methods:{
		pagar: function(item, index){
			this.contrato = item;
			this.indexcontrato = index;
			this.texto = 'Registrar';
		},
		verpago: function(item, index){
			this.contrato = item;
			this.indexcontrato = index;
			this.texto = 'Ver';
		},
		guardarVoucher: function(){
			var that = this;
			axios.post(this.ruta+'/registrarvoucher', {contrato: this.contrato})
			.then(function (response) {
				let datos = response.data;
				if (datos.mensaje == ''){
					Swal.fire(
						'Éxito',
						'El registro del pago se realizó correctamente, por favor espere a que sea validado por los administradores del sistema',
						'success'
					)
					.then(()=>{
						location.reload();
					});
				}
				else{
					Swal.fire(
						'Error',
						'Hubo un error registrando su voucher, intente nuevamente',
						'error'
					)
				}
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
		cerrarModal: function(){
			this.$bvModal.hide('modal-pago');
		},
		archivosubido: function({valor, fileRecords}){
			//console.log({valor, fileRecords});
			if (fileRecords.length == 1)
				fileRecords[0].urlResized = '.';
			//console.log({valor, fileRecords});
			this.contrato.fotovouchersubir = fileRecords;
			this.deshabilitaboton = valor;
		},
		formatearContratos: function(){
			if (this.contratos.length > 0){
				this.contratos.forEach((item, index)=>{
					this.contratos[index].periodo = item.fecha_inicio + ' ' + item.fecha_vencimiento;
					this.contratos[index].monto_ = 'S/ ' + item.monto;
				})
			}
		},
		cargarContratos: function(){
			var that = this;
			axios.post(this.ruta+'/listacontratos')
			.then(function (response) {
				let datos = response.data;
				that.contratos = datos.lista;
				that.rutaImagenes = datos.rutaImagenes;
				that.formatearContratos();
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
