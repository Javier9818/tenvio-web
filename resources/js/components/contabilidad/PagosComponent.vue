<template>
	<div class="container">
		<!--
		<div class="row my-1">
			<div class="col-4"><h4>Número total de ventas: 56</h4></div>
			<div class="col-4"><h4>Monto total de ventas: $/.5600</h4></div>
			<div class="col-4"><h4>Monto de deuda: S/.560</h4></div>
		</div>
		-->
		<!--
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
		-->
		<div class="text-center">
			<loader :mostrar="mostrarLoader"></loader>
			<b-button @click="cargarRenovarContrato" variant="primary" size="sm" v-b-modal.actualizar-plan>Renovar Contrato</b-button>
		</div>
		<br>
		<b-table :bordered="true" responsive :hover="true" headVariant="dark" :items="contratos" :fields="fields" :tbody-tr-class="rowClass">
			<template v-slot:cell(opciones)="row">
				<b-button @click="cargarVer(row)" v-b-modal.ver-contrato variant="success" size="sm">Ver</b-button>
				<b-button v-if="row.item.estado=='RECHAZADO'" @click="cargarActualizarVocher(row)" v-b-modal.actualizar-voucher variant="info" size="sm">Reintentar Pago</b-button>
				<!--<b-button v-if="row.item.estado=='VIGENTE'" @click="cargarExtenderPlan()" v-b-modal.extender-plan variant="warning" size="sm">Extender mi Plan</b-button>-->
			</template>
		</b-table>
		<b-modal id="ver-contrato" size="lg" scrollable centered hide-backdrop title="Ver Contrato" hide-footer>
			<b-form-group label="Estado" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.estado}} desde el {{contratoSeleccionado.fecha_aprob_rech}}
			</b-form-group>
			<b-form-group label="Fecha de Inicio" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.fecha_inicio}}
			</b-form-group>
			<b-form-group label="Fecha de Vencimiento" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.fecha_vencimiento}}
			</b-form-group>
			<b-form-group label="Precio del Plan" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.precio_}}
			</b-form-group>
			<b-form-group label="Pedidos Realizados" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.pedidos_contador}}
			</b-form-group>
			<b-form-group label="Total de Pedidos" label-cols-sm="5" class="mb-0">
				{{contratoSeleccionado.pedidos_total}}
			</b-form-group>
			<div class="text-center">
				<loader :mostrar="mostrarLoader2"></loader>
			</div>
			<div class="row">
				<div v-for="(lista_pagos, i) in contratoSeleccionado.listapagos" class="col-6">
					<div class="text-center">
						<h4>Pago {{(i+1)}}: {{lista_pagos.tipo}} {{lista_pagos.plan_nombre}}</h4>
					</div>
					<b-form-group label="Fecha de Pago" label-cols-sm="5" class="mb-0">
						{{lista_pagos.fecha_pago}}
					</b-form-group>
					<b-form-group label="Fecha de Revisión" label-cols-sm="5" class="mb-0">
						{{lista_pagos.fecha_aprob_rech}}
					</b-form-group>
					<b-form-group label="Estado" label-cols-sm="5" class="mb-0">
						{{lista_pagos.estado}}
					</b-form-group>
					<b-form-group label="Observacion" label-cols-sm="5" class="mb-0" v-if="lista_pagos.observacion!=null">
						{{lista_pagos.observacion}}
					</b-form-group>
					<b-form-group label="Precio" label-cols-sm="5" class="mb-0">
						{{lista_pagos.precio}}
					</b-form-group>
					<b-form-group label="Cantidad de Pedidos" label-cols-sm="5" class="mb-0">
						{{lista_pagos.cantidad_pedidos}}
					</b-form-group>
					<br>
				</div>
			</div>
			<div class="text-center pt-1">
				<b-button @click="cerrarModal" variant="danger" size="sm">Cerrar</b-button>
				<b-button v-if="contratoSeleccionado.estado=='VIGENTE'" @click="cargarExtenderPlan()" v-b-modal.extender-plan variant="success" size="sm">Extender mi Plan</b-button>
			</div>
		</b-modal>
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
			<div class="text-center">
				<loader :mostrar="mostrarLoader3"></loader>
			</div>
			<div class="text-center pt-1">
				<b-button @click="cerrarModal" variant="danger" size="sm">Cerrar</b-button>
				<b-button @click="enviarPagoExtension" variant="success" size="sm" :disabled="deshabilitaboton">Extender mi Plan</b-button>
			</div>
		</b-modal>
	</div>
</template>

<script>
import { ModelListSelect } from 'vue-search-select'
import Swal from 'sweetalert2'
export default {
	data() {
		return {
			ruta: '/intranet/pagos',
			fields: [
				{ key: 'plan_nombre', label:'Plan', sortable: true },
				{ key: 'periodo', label:'Periodo del Contrato', sortable: true },
				//{ key: 'precio_', label: 'Precio', sortable: true },
				{ key: 'pedidos_contador_', label: 'Pedidos Hechos', sortable: true },
				//{ key: 'pedidos_contador', label: 'Pedidos Hechos', sortable: true },
				{ key: 'pedidos_total_', label: 'Total de Pedidos', sortable: true },
				{ key: 'estado', label: 'Estado', sortable: true },
				{ key: 'opciones', label: 'Opciones', sortable: true }
			],
			listaPlanes: [],
			idPlanSeleccionado: -1,
			planSeleccionado: {},
			fotovouchersubir: [],
			deshabilitaboton: true,
			rutaImagenes: '',
			contratos: [],
			contratoSeleccionado: {},
			indexContratoSeleccionado: -1,
			listaExtensiones: [],
			idExtensionSeleccionada: -1,
			extensionSeleccionada: {},
			mostrarLoader: false,
			mostrarLoader2: false,
			mostrarLoader3: false,
		}
	},
	methods:{
		cargarPagosPorContrato: function(){
			var that = this;
			this.mostrarLoader2 = true;
			axios.post(this.ruta+'/pagosporcontrato', {contrato_id: this.contratoSeleccionado.id})
			.then(function (response) {
				let datos = response.data;
				that.contratoSeleccionado.listapagos = datos;
				//console.log(datos);
			})
			.catch(()=>{
				that.mensajeError(true);
			})
			.finally(()=>{
				that.mostrarLoader2 = false;
			});
		},
		cargarVer: function(row){
			this.contratoSeleccionado = row.item;
			this.indexContratoSeleccionado = row.index;
			if(this.contratoSeleccionado.listapagos == null)
				this.cargarPagosPorContrato();
			//console.log(row);
		},
		enviarPagoExtension: function(){
			var that = this;
			this.mostrarLoader3 = true;
			axios.post(this.ruta+'/extenderplan', {
				voucher: this.fotovouchersubir,
				contrato_id: this.contratoSeleccionado.id,
				plan_id: this.idExtensionSeleccionada
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
						//REGULARIZAR
						that.contratoSeleccionado.listapagos = null;
						that.cerrarModal();
						//
					}
					else{
						that.mensajeError(false);
					}
			})
			.catch((error)=>{
				console.log(error);
				that.mensajeError(true);
			})
			.finally(()=>{
				that.mostrarLoader3 = false;
			});
		},
		cargarExtenderPlan: function(row){
			//this.contratoSeleccionado = row.item;
			//this.indexContratoSeleccionado = row.index;
			this.fotovouchersubir = [];
			this.idExtensionSeleccionada = -1;
			if (this.listaExtensiones.length == 0)
				this.cargarExtensiones();
		},
		actualizarVoucher: function(){
			//console.log(this.contratoSeleccionado.pago_id);
			//console.log(this.fotovouchersubir);
				var that = this;
				axios.post(this.ruta+'/actualizarvoucher', {voucher:this.fotovouchersubir, pago_id:this.contratoSeleccionado.pago_id})
				.then(function (response) {
						let datos = response.data;
						if (datos.mensaje == ''){
							Swal.fire(
								'Éxito',
								//'Usted acaba de actualizar su voucher de pago, por favor espere nuevamente a la revisión de los administradores',
								'Usted acaba de actualizar su voucher de pago, su pago está siendo procesado',
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
			//console.log(this.contratoSeleccionado);
			//console.log(this.indexContratoSeleccionado);
		},
		cerrarModal: function(){
			this.$bvModal.hide('ver-contrato');
			this.$bvModal.hide('actualizar-plan');
			this.$bvModal.hide('actualizar-voucher');
			this.$bvModal.hide('extender-plan');
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
			//console.log(this.extensionSeleccionada);
		},
		seleccionoPlan(item){
			this.planSeleccionado = this.listaPlanes.filter((itm) => itm.id == item);
			this.planSeleccionado = this.planSeleccionado[0];
			//console.log(this.planSeleccionado);
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
		rowClass(item, type) {
			if (!item || type !== 'row')
				return;
			if (item.estado === 'Vigente'){
				if ((1.0 * item.pedidos_contador) / item.pedidos_total >= 0.7)
					return 'table-danger';
				else
					return 'table-success';
			}
			else if (item.estado === 'Rechazado')
				return 'table-warning';
			else if (item.estado === 'En espera a validar')
				return 'table-info';
			else
				return 'table-secondary';
		},
		formatearContratos: function(){
			if (this.contratos.length > 0){
				this.contratos.forEach((item, index)=>{
					this.contratos[index].periodo = item.fecha_inicio + ' ' + item.fecha_vencimiento;
					this.contratos[index].precio_ = item.precio === 0 ? 'Gratuito' : ('S/ ' + item.precio);
					var prctnj = (parseFloat(item.pedidos_contador)/item.pedidos_total*100).toFixed(2);
					this.contratos[index].pedidos_contador_ = item.pedidos_contador + ' (' + String(prctnj) + '%)';
					if (item.pedidos_total_ != null)
						this.contratos[index].pedidos_total_ = item.pedidos_total_.split(',').join(' + ');
					else
						this.contratos[index].pedidos_total_ = '-';
				})
			}
		},
		cargarContratos: function(){
			var that = this;
			this.mostrarLoader = true;
			axios.post(this.ruta+'/listacontratos')
			.then(function (response) {
				let datos = response.data;
				that.contratos = datos.lista;
				that.rutaImagenes = datos.rutaImagenes;
				that.formatearContratos();
			})
			.catch((error)=>{
				//console.log(error);
				that.mensajeError(true);
			})
			.finally(()=>{
				that.mostrarLoader = false;
			});
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
					this.contratos[index].monto_ = item.monto === 0 ? 'Gratuito' : ('S/ ' + item.monto);
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
		*/
	},
	mounted() {
		this.cargarContratos();
	},
	components: {
		ModelListSelect
	}
}
</script>
