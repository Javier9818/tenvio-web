<template>
	<div>
		<!--grid  list-->
		<VueFileAgent
		ref="vueFileAgent"
		:theme="'grid'"
		:multiple="true"
		:deletable="true"
		:meta="true"
		:accept="'image/*'"
		:maxSize="'10MB'"
		:maxFiles="1"
		:helpText="'Arrastre su imagen o haga click para seleccionar'"
		:uploadUrl="uploadUrl"
		@select="filesSelected($event)"
		@delete="fileDeleted($event)"
		v-model="fileRecords"></VueFileAgent>
		<div class="text-center" :hidden="!mostrarLoader">
			<loader :mostrar="mostrarLoader"></loader>
			<br>
			Su archivo se está procesando, espere un momento por favor
		</div>
		<br>
	</div>
</template>

<script>
export default {
	props: {

	},
	data() {
		return {
			fileRecords: [],
			fileRecordsForUpload: [],
			uploadUrl: '/extras/addArchivo',
			uploadHeaders: {
				'_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				'X-Test-Header': 'vue-file-agent',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			},
			varRepeticiones: null,
			mostrarLoader: false
		}
	},
	methods: {
		invocar: function(valor){
			this.mostrarLoader = valor;
			this.$emit('archivosubido', {valor: valor, fileRecords: this.fileRecords});
		},
		funccionn: function(that){
			//true=ya subió, false=todavía
			var bul = true;
			that.fileRecords.forEach((item)=>{
				bul = bul && (item.upload.data!=null);
			});
			if (bul){
				this.invocar(false);
				clearInterval(this.varRepeticiones);
			}
		},
		funcionnn: function() {
			this.invocar(true);
			var that = this;
			this.varRepeticiones = setInterval(this.funccionn, 500, that);
		},
		uploadFiles: function() {
			this.$refs.vueFileAgent.upload(this.uploadUrl, this.uploadHeaders, this.fileRecordsForUpload);
			this.fileRecordsForUpload = [];
		},
		deleteUploadedFile: function(fileRecord) {
			this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, fileRecord);
		},
		filesSelected: function(fileRecordsNewlySelected) {
			this.funcionnn();
			var validFileRecords = fileRecordsNewlySelected.filter((fileRecord) => !fileRecord.error);
			this.fileRecordsForUpload = this.fileRecordsForUpload.concat(validFileRecords);
		},
		fileDeleted: function(fileRecord) {
			var i = this.fileRecordsForUpload.indexOf(fileRecord);
			if (i !== -1) {
				this.fileRecordsForUpload.splice(i, 1);
			} else {
				this.deleteUploadedFile(fileRecord);
			}
		}
	},
	mounted() {
	},
	created: function(){
	},
}
</script>
