<template>
    <div>
        <h5>wwww.teloenvio.com/empresas/<p class="namePublic">{{nombreUnico}}</p></h5>
       <form v-on:submit.prevent="submit">
           <div class="row">
                <div class="col-md-12">
                    <label>Nombre público del negocio</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombre único" v-model="nombreUnico" required
                     v-on:keyup="convert" :class="{ 'is-invalid': (error), 'is-valid': (error === false) }" >
                    <div class="valid-tooltip">
                     El nombre está disponible
                    </div>
                    <div class="invalid-tooltip">
                    El nombre no está disponible
                    </div>
                    <p v-if="busy">Validando...</p>
                </div>
           </div>
           <button type="submit" class="btn btn-sm btn-primary mt-3">Actualizar</button>
       </form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                nombreUnico:'',
                error:null,
                data:null,
                busy:null
            }
        },
        mounted() {
            console.log('Component mounted.')
            axios.get(`/api/nombre-unico/${empresa}`).then( ({data}) => {
                this.nombreUnico = data.nombreUnico;
                this.data = data;
            });
        },
        methods:{
            convert: function(){
                this.nombreUnico = (this.nombreUnico.toLowerCase()).replace(/\s/gi, "")
            },
            valida: async function(){
                var res;
                await axios.post(`/api/nombre-unico`, {nombreUnico: this.nombreUnico}).then( ({data}) => {
                    res = data.message;
                }).catch((error) => {
                    Swal.fire('Error', 'Ha sucedido un error', 'error');
                    res = error;
                });

                return res;
            },
            submit: async function (){
                if(this.nombreUnico !== this.data.nombreUnico){
                    this.busy = true;
                    var valida = await this.valida();
                    if(!valida) this.update();
                    else {this.error = true; this.busy=false;}
                }
                else
                    this.error = null;
            },
            update: function(){
                axios.put(`/api/nombre-unico`, {nombreUnico: this.nombreUnico, empresa}).then( (data) => {
                    this.busy = false;
                    this.data.nombreUnico = this.nombreUnico;
                    Swal.fire('Éxito', 'El nombre público ha sido actualizado', 'success').then( () => {
                        this.error = null;
                    })
                }).catch( (error) => {
                    Swal.fire('Error', 'Ha sucedido un error durante la actualización, vuelva a intentar por favor', 'error');
                    this.nombreUnico = data.nombreUnico;
                    this.busy = false;
                });
            }
        }
    }
</script>

<style scoped>
.namePublic{
    color: rgb(172, 47, 47) !important;
}
</style>
