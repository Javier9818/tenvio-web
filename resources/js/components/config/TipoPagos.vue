<template>
    <div>
      <div class="row">
        <div class="col-6">
          <div class="form-group" v-for="(tipo,index) in tipos" :key="index">
           
            {{tipo.nombre}}
             <a href="javascript:void(0)" @click="_config(index)"> <i class="ft-edit"></i> </a>
          </div>
        </div>
        <div class="col-6">
          <div class="row">
            <div class=" col-12">
              <b-modal ref="my-modal" hide-footer :title="tipo.nombre">
                <div class="form-group">
                  <label for="exampleInputEmail1">Número</label>
                  <input type="email" class="form-control" v-model="tipo.number" id="exampleInputEmail1" placeholder="Número de transferencia o telefónico">
                  <br>
                  <input type="checkbox" v-model="tipo.estado"> Activar
                   
                  <br>
                  <div class="text-center">
                    <b-img :src="'/storage/pagos/'+tipo.code" :hidden="tipo.code==''" class="img-fluid"></b-img>
                  </div>
                  <sube-archivos @archivosubido="archivosubido"></sube-archivos>
                </div>
                <loader :mostrar="mostrarLoader"></loader>
                <br>
                <b-button variant="danger"  @click="hideModal">Cancelar</b-button>
                <b-button variant="success"  @click="save" :disabled="mostrarLoader || deshabilitaboton">Guardar</b-button>
              </b-modal>  
            </div>
          </div>
        </div>
      </div>        
        <span v-if="alert === 0" style="color:red;"> Sus clientes no podrán realizar pedidos, se recomienda dejar un campo activado</span>
       
    </div>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        data() {
          return {
            alert:0,
            tipos:[],
            tipo:{
              nombre:'',
              code:''
            },
            index:null,
            deshabilitaboton: false,
            mostrarLoader: false
          }
        },
        mounted() {
            this._init()
        },
        methods:{            
            _config(index){
              this.index=index
              this.tipo= this.tipos[index]
              this.$refs['my-modal'].show()
            },
            save(){ 
              var that= this
              this.tipo.estado= (this.tipo.estado)? 1:0
              axios.put('/api/tipo-pago', {pago:this.tipo,idempresa: empresa}).then( ({data}) => {
                Swal.fire('Éxito', 'El dato ha sido actualizado', 'success');
                that.tipos[this.index]=that.tipo 
              }).catch( error => {
                Swal.fire('Error', 'Ha sucedido un error', 'error');
              });
              this.hideModal()
            },
            hideModal() {
              this.$refs['my-modal'].hide()
            },
            archivosubido: function({valor, fileRecords}){
              if (fileRecords.length == 1)
                fileRecords[0].urlResized = '.';
              console.log({valor, fileRecords});
              this.tipos[this.index].code = fileRecords;
              this.deshabilitaboton = valor;
            },
            _init(){
              axios.get(`/api/tipo-pago/${empresa}`).then( ({data}) => {
                this.tipos = data.tipos
              });
            } 

        }
    }
</script>
