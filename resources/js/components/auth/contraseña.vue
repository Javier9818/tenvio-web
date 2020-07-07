<template>
    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
          <div style="font-size:1em;" class="seguridad"><i class="ft-lock"></i> Seguridad de la cuenta</div>
          <a v-if="editar===null" href="javascript:void(0)" v-on:click="editar=true" class="ml-1">Cambiar contraseña</a>
          <a v-if="editar" href="javascript:void(0)" v-on:click="editar=null" class="ml-1">Cancelar</a>
      </div>
      <form v-on:submit.prevent="submit()" v-if="editar">
          <div class="row">
            <div class="col-12 mt-2">
                <label>Contraseña actual</label>
                <input type="password" class="form-control" placeholder="Contraseña actual" required v-model="form.claveActual">
                <p v-if="$v.form.claveActual.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-12 mt-2">
                <label >Contraseña nueva</label>
                <input type="password" class="form-control" placeholder="Contraseña nueva" required v-model="form.claveNueva" v-on:keyup="valida()">
                <p v-if="$v.form.claveNueva.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-12 mt-2">
                <label >Vuelve a escribir la contraseña nueva</label> <!--is-invalid-->
                <input type="password" class="form-control" placeholder="Vuelve a escribir la contraseña nueva" required v-model="form.claveRepetida" v-on:keyup="valida()"  :class="{ 'is-invalid': (form.errorClave), 'is-valid': (form.errorClave === false) }">
                <p v-if="$v.form.claveRepetida.$error" class="help text-danger">Este campo es inválido</p>
                <div class="valid-tooltip">
                    La contraseñas coinciden
                </div>
                <div class="invalid-tooltip">
                    Las contraseñas no coinciden
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-icon btn-primary mt-4">Cambiar contraseña</button>
      </form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import {validationMixin} from 'vuelidate'
import {required, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
const alphaNum = helpers.regex('custom', /^[a-zA-ZÀ-ÿ0-9]*$/)
    export default {
        mixins: [validationMixin],
        mounted() {
            console.log('Component mounted.')

        },
         data () {
            return {
                editar:null,
                form:{
                    claveActual:'',
                    claveNueva:'',
                    claveRepetida:'',
                    errorClave:null,
                    id: user.id
                }
            }
        },
        validations:{
            form:{
                claveActual:{
                    required,
                    alphaNum,
                    maxLength:maxLength(50)
                },
                 claveNueva:{
                    required,
                    alphaNum,
                    maxLength:maxLength(50)
                },
                 claveRepetida:{
                    required,
                    alphaNum,
                    maxLength:maxLength(50)
                }
            }
        },
        methods:{
            valida(){
                if(this.form.claveNueva === this.form.claveRepetida) this.form.errorClave = false;
                else this.form.errorClave = true;
            },
            submit: async function(){
                this.$v.$touch()
                console.log(this.$v.$invalid);
                if(!this.form.errorClave && !this.$v.$invalid){
                    axios.put('/api/pass',this.form).then(({data}) => {
                        if(data.error)
                            Swal.fire('Error', 'Ha sucedido un error, asegúrese de haber ingresado la contraseña correcta', 'error');
                        if(data.message){
                            Swal.fire('Éxito', 'Su contraseña ha sido actualizada', 'success').then( data => {
                                this.editar=null;
                                this.form = {
                                    claveActual:'',
                                    claveNueva:'',
                                    claveRepetida:'',
                                    errorClave:null,
                                    id: user.id
                                }
                            });
                        }

                    });
                }
            }
        }
    }
</script>
