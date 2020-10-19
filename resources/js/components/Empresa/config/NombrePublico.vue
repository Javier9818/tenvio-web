<template>
    <div>
        <a :href="rutita+'/empresa/'+nombreUnico"><h6>{{rutita}}/empresas/<p class="namePublic d-inline">{{nombreUnico}}</p></h6></a>
        <a href="javascript:void(0)" v-on:click="stateComponent=true" v-if="!stateComponent"> <i class="ft-edit"></i> Modificar</a>
       <form v-on:submit.prevent="submit" v-if="stateComponent">
           <div class="row">
                <div class="col-md-12">
                    <label>Nombre público del negocio</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombre único" v-model="nombreUnico" required
                     v-on:keyup="convert" :class="{ 'is-invalid': (error), 'is-valid': (error === false) }" >
                    <p v-if="$v.nombreUnico.$error" class="help is-danger text-danger">Este campo es inválido</p>
                    <div class="valid-tooltip">
                     El nombre está disponible
                    </div>
                    <div class="invalid-tooltip">
                    El nombre no está disponible
                    </div>
                    <p v-if="busy">Validando...</p>
                </div>
           </div>
           <a href="javascript:void(0)" v-on:click="() => {stateComponent=false; nombreUnico = data.nombreUnico}" class="mt-1"> <i class="ft-edit"></i> Cancelar</a>
           <button type="submit" class="btn btn-sm btn-primary my-1 float-right" v-if="nombreUnico!== data.nombreUnico">Guardar cambios</button>
           <button type="submit" class="btn btn-sm btn-primary my-1 float-right" disabled v-else>Guardar cambios</button>

       </form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import {validationMixin} from 'vuelidate'
import {required, numeric, minValue, maxValue, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
const alpha = helpers.regex('alpha', /^[a-z0-9À-ÿ&\s]*$/)
    export default {
        mounted() {
			this.rutita = window.location.origin;
            axios.get(`/api/nombre-unico/${empresa}`).then( ({data}) => {
                this.nombreUnico = data.nombreUnico;
                this.data = data;
            });
        },
        data() {
            return {
				rutita: '',
                stateComponent:false,
                nombreUnico:'',
                error:null,
                data:null,
                busy:null
            }
        },
        validations: {
            nombreUnico: {
                required,
                alpha,
                maxLength: maxLength(100)
            }
        },
        methods:{
            convert: function(){
                this.error = null
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
                this.$v.$touch()
                if(this.nombreUnico !== this.data.nombreUnico && !this.$v.$invalid){
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
