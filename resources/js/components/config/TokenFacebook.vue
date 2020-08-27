<template>
    <div>
       
       <form v-on:submit.prevent="submit">
           <div class="row">
                <div class="col-md-12">
                    <b>
                        Token Facebook 
                        <a href="javascript:void(0)" v-on:click="() => {stateComponent=!stateComponent}" class="mt-1" title="Editar" v-if="stateComponent"> <i class="ft-edit"></i></a>
                        <a href="javascript:void(0)" v-on:click="() => {stateComponent=!stateComponent; tokenFb = data.tokenFb}" class="mt-1" title="Editar" v-else><i class="ft-x"></i> Cancelar</a>
                    </b>
                    <p v-if="stateComponent">{{tokenFb || 'No se encontró token registrado'}}</p>
                    <input type="text" class="form-control" placeholder="Ingrese nombre único" v-model="tokenFb" required
                    :class="{ 'is-invalid': (error), 'is-valid': (error === false) }" v-else >
                </div>
           </div>
           <button type="submit" class="btn btn-sm btn-primary my-1 float-right" v-if="tokenFb!== data.tokenFb">Guardar cambios</button>

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
            console.log(empresa);
            axios.get(`/api/token-fb/${empresa}`).then( ({data}) => {
                this.tokenFb = data.tokenFb;
                this.data = data;
            });
        },
        data() {
            return {
                stateComponent:true,
                tokenFb:null,
                error:null,
                data:{tokenFb:null},
                busy:null
            }
        },
        validations: {
            tokenFb: {
                required
            }
        },
        methods:{
            convert: function(){
                this.error = null
                this.tokenFb = (this.tokenFb.toLowerCase()).replace(/\s/gi, "")
            },
            submit: async function (){
                if(this.tokenFb !== this.data.tokenFb){
                    this.busy = true;
                    this.update();
                }
                else
                    this.error = null;
            },
            update: function(){
                axios.put(`/api/token-fb`, {tokenFb: this.tokenFb, empresa}).then( (data) => {
                    this.busy = false;
                    this.data.tokenFb = this.tokenFb;
                    this.stateComponent = true;
                    Swal.fire('Éxito', 'El token ha sido actualizado', 'success').then( () => {
                        this.error = null;
                    })
                }).catch( (error) => {
                    Swal.fire('Error', 'Ha sucedido un error durante la actualización, vuelva a intentar por favor', 'error');
                    this.tokenFb = data.tokenFb;
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
