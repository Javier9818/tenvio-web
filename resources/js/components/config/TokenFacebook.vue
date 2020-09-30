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
                    <input type="text" class="form-control" placeholder="Ingrese token de fb" v-model="tokenFb" required
                    :class="{ 'is-invalid': (error), 'is-valid': (error === false) }" v-else >
                </div>

                <div class="col-md-12">
                    <b>
                        ID Facebook 
                        <a href="javascript:void(0)" v-on:click="() => {stateComponentID=!stateComponentID}" class="mt-1" title="Editar" v-if="stateComponentID"> <i class="ft-edit"></i></a>
                        <a href="javascript:void(0)" v-on:click="() => {stateComponentID=!stateComponentID; idFb = data.idFb}" class="mt-1" title="Editar" v-else><i class="ft-x"></i> Cancelar</a>
                    </b>
                    <p v-if="stateComponentID">{{idFb || 'No se encontró id registrado'}}</p>
                    <input type="text" class="form-control" placeholder="Ingrese id de fb" v-model="idFb" required
                    :class="{ 'is-invalid': (error), 'is-valid': (error === false) }" v-else >
                </div>
           </div>
           <button type="submit" class="btn btn-sm btn-primary my-1 float-right" v-if="tokenFb!== data.tokenFb || idFb!== data.idFb">Guardar cambios</button>

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
                this.idFb = data.idFb;
                this.data = data;
            });
        },
        data() {
            return {
                stateComponent:true,
                stateComponentID:true,
                tokenFb:null,
                idFb:null,
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
                if(this.tokenFb !== this.data.tokenFb || this.idFb !== this.data.idFb){
                    this.busy = true;
                    this.update();
                }
                else
                    this.error = null;
            },
            update: function(){
                axios.put(`/api/token-fb`, {tokenFb: this.tokenFb, idFb: this.idFb, empresa}).then( (data) => {
                    this.busy = false;
                    this.data.tokenFb = this.tokenFb;
                    this.data.idFb = this.idFb;
                    this.stateComponent = true;
                    this.stateComponentID = true;
                    Swal.fire('Éxito', 'El token y ID ha sido actualizado', 'success').then( () => {
                        this.error = null;
                    })
                }).catch( (error) => {
                    Swal.fire('Error', 'Ha sucedido un error durante la actualización, vuelva a intentar por favor', 'error');
                    this.tokenFb = data.tokenFb;
                    this.idFb = data.idFb;
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
