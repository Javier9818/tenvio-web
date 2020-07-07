<template>
	<div class="container">
		<b-table :bordered="true" responsive :hover="true" headVariant="dark" :items="pagos" :fields="fields">
			<template v-slot:cell(opciones)="row">
				<b-button @click="verPago(row)" v-b-modal.cargar-voucher variant="info" size="sm">Ver</b-button>
				<!--
				<b-button @click="rechazar(row)" v-if="row.item.estado=='Pendiente a Aprobar'" variant="danger" size="sm">Rechazar Pago</b-button>
				<b-button @click="aprobar(row)" v-if="row.item.estado=='Pendiente a Aprobar'" variant="success" size="sm">Aprobar Pago</b-button>
				-->
				<!--
				<b-button v-if="row.item.estado=='Válido'" @click="cargarExtenderPlan(row)" v-b-modal.extender-plan variant="warning" size="sm">Extender mi Plan</b-button>
				-->
			</template>
		</b-table>
		<b-modal id="cargar-voucher" size="lg" scrollable centered hide-backdrop title="Ver Pago" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Foto del Voucher" label-align="center" class="text-center">
					<b-img :src="'/'+rutaImagenes+rowPagoSelccionado.item.urlfoto" class="img-fluid"></b-img>
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12">
				<b-form-group label="Acciones" label-align="center" class="text-center">
					<b-button @click="rechazar(rowPagoSelccionado)" v-if="rowPagoSelccionado.item.estado=='PENDIENTE A APROBAR'" variant="danger" size="sm">Rechazar Pago</b-button>
					<b-button @click="cerrarModal" variant="info" size="sm">Cerrar</b-button>
					<b-button @click="aprobar(rowPagoSelccionado)" v-if="rowPagoSelccionado.item.estado=='PENDIENTE A APROBAR'" variant="success" size="sm">Aprobar Pago</b-button>
				</b-form-group>
			</b-col>
			<br>
		</b-modal>
		<!--
		<div class="text-center">
			<b-button @click="cargarRenovarContrato" variant="primary" size="sm" v-b-modal.actualizar-plan>Renovar Contrato</b-button>
		</div>
		<br>
		<b-table :bordered="true" responsive :hover="true" headVariant="dark" :items="contratos" :fields="fields">
			<template v-slot:cell(opciones)="row">
				<b-button @click="" variant="success" size="sm">Ver</b-button>
				<b-button v-if="row.item.estado=='Rechazado'" @click="cargarActualizarVocher(row)" v-b-modal.actualizar-voucher variant="info" size="sm">Volver a Pagar</b-button>
				<b-button v-if="row.item.estado=='Válido'" @click="cargarExtenderPlan(row)" v-b-modal.extender-plan variant="warning" size="sm">Extender mi Plan</b-button>
			</template>
		</b-table>
		<b-modal id="actualizar-plan" size="lg" scrollable centered hide-backdrop title="Renovar Contrato" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Seleccione su plan"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center"
				style="position:relative; z-index:4;">
					<b-form-select v-model="idPlanSeleccionado" :options="listaPlanes" @change="seleccionoPlan"></b-form-select>
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idPlanSeleccionado==-1">
				<b-form-group
				label="Descripcion"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					{{planSeleccionado.descripcion}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idPlanSeleccionado==-1">
				<b-form-group
				label="Precio"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					S/ {{planSeleccionado.precio}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idPlanSeleccionado==-1">
				<b-form-group
				label="Cantidad de Pedidos"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					{{planSeleccionado.cantidad_pedidos}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idPlanSeleccionado==-1">
				<b-form-group
				label="Foto del Voucher"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0"
				style="position:relative; z-index:1;">
					<sube-archivos @archivosubido="archivosubido"></sube-archivos>
				</b-form-group>
			</b-col>
			<div class="text-center pt-1">
				<b-button @click="cerrarModal" variant="danger" size="sm">Cerrar</b-button>
				<b-button @click="enviarPagoContrato" variant="success" size="sm" :disabled="deshabilitaboton">Renovar Contrato</b-button>
			</div>
		</b-modal>
		<b-modal id="actualizar-voucher" size="lg" scrollable centered hide-backdrop title="Volver a Pagar / Actualizar Voucher de Pago" hide-footer>
			<b-col sm="12" md="12">
				<sube-archivos @archivosubido="archivosubido"></sube-archivos>
			</b-col>
			<div class="text-center">
				<b-button @click="cerrarModal" variant="danger" size="sm">Cerrar</b-button>
				<b-button @click="actualizarVoucher" variant="success" size="sm" :disabled="deshabilitaboton">Guardar</b-button>
			</div>
			<br>
		</b-modal>
		<b-modal id="extender-plan" size="lg" scrollable centered hide-backdrop title="Extender mi Plan" hide-footer>
			<b-col sm="12" md="12">
				<b-form-group
				label="Seleccione su plan"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center"
				style="position:relative; z-index:4;">
					<b-form-select v-model="idExtensionSeleccionada" :options="listaExtensiones" @change="seleccionoExtension"></b-form-select>
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idExtensionSeleccionada==-1">
				<b-form-group
				label="Descripcion"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					{{extensionSeleccionada.descripcion}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idExtensionSeleccionada==-1">
				<b-form-group
				label="Precio"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					S/ {{extensionSeleccionada.precio}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idExtensionSeleccionada==-1">
				<b-form-group
				label="Cantidad de Pedidos"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0 text-center">
					{{extensionSeleccionada.cantidad_pedidos}}
				</b-form-group>
			</b-col>
			<b-col sm="12" md="12" :hidden="idExtensionSeleccionada==-1">
				<b-form-group
				label="Foto del Voucher"
				label-cols-sm="5"
				label-align-sm="left"
				label-align="center"
				class="mb-0"
				style="position:relative; z-index:1;">
					<sube-archivos @archivosubido="archivosubido"></sube-archivos>
				</b-form-group>
			</b-col>
			<div class="text-center pt-1">
				<b-button @click="cerrarModal" variant="danger" size="sm">Cerrar</b-button>
				<b-button @click="enviarPagoExtension" variant="success" size="sm" :disabled="deshabilitaboton">Extender mi Plan</b-button>
			</div>
		</b-modal>
		-->
	</div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/admin/cobros',
			fields: [
				{ key: 'id', label:'Id', sortable: true },
				{ key: 'plan_nombre', label:'Plan', sortable: true },
				{ key: 'precio_', label: 'Precio', sortable: true },
				{ key: 'cantidad_pedidos', label: 'Cantidad de Pedidos', sortable: true },
				{ key: 'fecha_pago', label:'Fecha de Pago', sortable: true },
				{ key: 'estado', label: 'Estado', sortable: true },
				{ key: 'opciones', label: 'Opciones', sortable: true }
			],
			rutaImagenes: '',
			pagos: [],
			rowPagoSelccionado: {
				item: { urlfoto:'' }
			},
			/*
			listaPlanes: [],
			idPlanSeleccionado: -1,
			planSeleccionado: {},
			fotovouchersubir: [],
			deshabilitaboton: true,
			contratos: [],
			contratoSeleccionado: {},
			indexContratoSeleccionado: -1,
			listaExtensiones: [],
			idExtensionSeleccionada: -1,
			extensionSeleccionada: {},
			*/
		}
	},
	methods:{
		cerrarModal: function(){
			this.$bvModal.hide('cargar-voucher');
		},
		verPago: function(row){
			this.rowPagoSelccionado = row;
		},
		aprobar: function(row){
			this.rowPagoSelccionado = row;
			this.cambiarEstado(true, 'aprobar', 'aprobando')
		},
		rechazar: function(row){
			this.cerrarModal();
			this.rowPagoSelccionado = row;
			this.cambiarEstado(false, 'rechazar', 'rechazando')
		},
		enviarCambioEstado: function(bul, txt=''){
			var pago_id = this.rowPagoSelccionado.item.id;
			axios.post(this.ruta+'/respuestavoucher', {estado:bul, observacion:txt, pago_id:pago_id})
			.then(function (response) {
				let datos = response.data;
				if (datos.mensaje == ''){
					Swal.fire(
						'Éxito',
						'El pago ha sido '+((bul)?'Aprobado':'Rechazado')+' con éxito',
						'success'
					)
					.then(()=>{
						//location.reload();
					});
				}
				else
					that.mensajeError(false);

			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		cambiarEstado: function(bul, t1, t2){
			var that = this;
			Swal.fire({
				title: '¿Estás seguro?',
				text: '¿Está seguro que desea '+t1+' este pedido?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.value) {
					var thet = that;
					if (!bul){
						Swal.fire({
							title: 'Ingrese el motivo por el cual está rechazando el voucher',
							input: 'textarea',
							inputValue: '',
							confirmButtonText: 'Confirmar',
							showCancelButton: true,
							cancelButtonText: 'Cancelar',
							inputValidator: (value) => {
								if (!value) {
									return 'Por favor, ingrese el motivo'
								}
								else if (value.length > 100){
									return 'El texto ingresado no debe tener más de 100 caracteres'
								}
							}
						})
						.then((text)=>{
							if (text.value != null){
								thet.enviarCambioEstado(false, text.value);
							}
						});
					}
					else{
						thet.enviarCambioEstado(true);
					}
				}
			})
		},
		cargarPagos: function(){
			var that = this;
			axios.post(this.ruta+'/listarpagos')
			.then(function (response) {
				let datos = response.data;
				that.pagos = datos.lista;
				that.rutaImagenes = datos.rutaImagenes;
				that.formatearContratos();
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		formatearContratos: function(){
			if (this.pagos.length > 0){
				this.pagos.forEach((item, index)=>{
					this.pagos[index].precio_ = item.precio === 0 ? 'Gratuito' : ('S/ ' + item.precio);
				})
			}
		},
		mensajeError: function(bul){
			var mensaje = '';
			if (bul)
				mensaje = 'Hubo un error inesperado, por favor contactese con el administrador del sistema';
			else
				mensaje = 'Hubo un error al realizar la opracion, intente nuevamente';
			return Swal.fire(
				'Error',
				mensaje,
				'error'
			)
		},
		/*
		enviarPagoExtension: function(){
			var that = this;
			axios.post(this.ruta+'/extenderplan', {
				voucher:this.fotovouchersubir,
				contrato_id:this.contratoSeleccionado.id,
				plan_id:this.idExtensionSeleccionada
			})
			.then(function (response) {
					let datos = response.data;
					if (datos.mensaje == ''){
						Swal.fire(
							'Éxito',
							'Usted acaba de registrar su extensión de plan, por favor espere a que el voucher enviado sea aprobado por los administradores',
							'success'
						)
						.then(()=>{
							//location.reload();
						});
					}
					else{
						that.mensajeError(false);
					}
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		cargarExtenderPlan: function(row){
			this.contratoSeleccionado = row.item;
			this.indexContratoSeleccionado = row.index;
			this.fotovouchersubir = [];
			this.idExtensionSeleccionada = -1;
			if (this.listaExtensiones.length == 0)
				this.cargarExtensiones();
		},
		actualizarVoucher: function(){
			console.log(this.contratoSeleccionado.pago_id);
			console.log(this.fotovouchersubir);
				var that = this;
				axios.post(this.ruta+'/actualizarvoucher', {voucher:this.fotovouchersubir, pago_id:this.contratoSeleccionado.pago_id})
				.then(function (response) {
						let datos = response.data;
						if (datos.mensaje == ''){
							Swal.fire(
								'Éxito',
								'Usted acaba de actualizar su volver voucher de pago, espere nuevamente a la revisión de los administradores',
								'success'
							)
							.then(()=>{
								//location.reload();
							});
						}
						else{
							that.mensajeError(false);
						}
				})
				.catch(()=>{
					that.mensajeError(true);
				})
				.finally(()=>{});
		},
		cargarActualizarVocher: function(row){
			this.fotovouchersubir = [];
			this.contratoSeleccionado = row.item;
			this.indexContratoSeleccionado = row.index;
			console.log(this.contratoSeleccionado);
			console.log(this.indexContratoSeleccionado);
		},
		cerrarModal: function(){
			this.$bvModal.hide('modal-pago');
			this.$bvModal.hide('actualizar-voucher');
		},
		enviarPagoContrato: function(){
			//console.log(this.fotovouchersubir);
			var that = this;
			axios.post(this.ruta+'/renovarcontrato', {voucher:this.fotovouchersubir, plan_id:this.idPlanSeleccionado})
			.then(function (response) {
					let datos = response.data;
					if (datos.mensaje == ''){
						Swal.fire(
							'Éxito',
							'Usted acaba de actualizar su plan, por favor espere a que el voucher enviado sea aprobado por los administradores',
							'success'
						)
						.then(()=>{
							location.reload();
						});
					}
					else{
						that.mensajeError(false);
					}
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		archivosubido: function({valor, fileRecords}){
			if (fileRecords.length == 1)
				fileRecords[0].urlResized = '.';
			this.fotovouchersubir = fileRecords;
			this.deshabilitaboton = valor;
		},
		cargarRenovarContrato: function(){
			this.fotovouchersubir = [];
			this.idPlanSeleccionado = -1;
			if (this.listaPlanes.length == 0)
				this.cargarPlanes();
		},
		seleccionoExtension(item){
			this.extensionSeleccionada = this.listaExtensiones.filter((itm) => itm.id == item);
			this.extensionSeleccionada = this.extensionSeleccionada[0];
			console.log(this.extensionSeleccionada);
		},
		seleccionoPlan(item){
			this.planSeleccionado = this.listaPlanes.filter((itm) => itm.id == item);
			this.planSeleccionado = this.planSeleccionado[0];
			console.log(this.planSeleccionado);
		},
		cargarExtensiones: function(){
			var that = this;
			axios.post(this.ruta+'/listaextensiones')
			.then(function (response) {
				let datos = response.data;
				that.listaExtensiones = datos;
				that.listaExtensiones.forEach((item, i) => {
					that.listaExtensiones[i].value = item.id;
					that.listaExtensiones[i].text = item.nombre;
					that.listaExtensiones[i].precio = item.precio.toFixed(2);
				});
				var nulo = [{
					value: -1,
					text: 'Por favor seleccione un Plan de Extensión',
					disabled: true
				}];
				that.listaExtensiones = nulo.concat(that.listaExtensiones);
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		cargarPlanes: function(){
			var that = this;
			axios.post(this.ruta+'/listaplanes')
			.then(function (response) {
				let datos = response.data;
				that.listaPlanes = datos;
				that.listaPlanes.forEach((item, i) => {
					that.listaPlanes[i].value = item.id;
					that.listaPlanes[i].text = item.nombre;
					that.listaPlanes[i].precio = item.precio.toFixed(2);
				});
				var nulo = [{
					value: -1,
					text: 'Por favor seleccione un Plan',
					disabled: true
				}];
				that.listaPlanes = nulo.concat(that.listaPlanes);
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		formatearContratos: function(){
			if (this.contratos.length > 0){
				this.contratos.forEach((item, index)=>{
					this.contratos[index].periodo = item.fecha_inicio + ' ' + item.fecha_vencimiento;
					this.contratos[index].precio_ = item.precio === 0 ? 'Gratuito' : ('S/ ' + item.precio);
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
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{});
		},
		mensajeError: function(bul){
			var mensaje = '';
			if (bul)
				mensaje = 'Hubo un error inesperado, por favor contactese con el administrador del sistema';
			else
				mensaje = 'Hubo un error al realizar la opracion, intente nuevamente';
			return Swal.fire(
				'Error',
				mensaje,
				'error'
			)
		},
		*/
	},
	mounted() {
		this.cargarPagos();
	},
	components: {
		ModelListSelect
	}
}
</script>
