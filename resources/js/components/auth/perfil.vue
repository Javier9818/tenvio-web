<template>
     <form v-on:submit.prevent="submit()">
        <div class="row">
            <div class="col-md-6 mt-2">
                <label>Usuario</label>
                <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario, ejemplo:primerNombre123 " required v-model="form.username" :class="{ 'is-invalid': errorUsername }">
                <span class="danger" v-if="errorUsername">Este usuario ya existe, intente con otro diferente</span>
                <p v-if="!$v.form.username.alphaNum" class="help text-danger">Este campo es alfanumérico, además no acepta caracteres especiales</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Email</label>
                <input type="email" class="form-control" placeholder="Ingrese su email" required v-model="form.email" :class="{ 'is-invalid': errorEmail }">
                <span class="danger" v-if="errorEmail">Este email ya existe, intente con otro diferente</span>
                <p v-if="!$v.form.email.maxLength" class="help text-danger">Este campo no puede contener más de 100 caracteres</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Apellido Paterno</label> <!--is-invalid-->
                <input type="text" class="form-control" placeholder="Ingrese apellidos paternos" required v-model="form.appaterno">
                <p v-if="!$v.form.appaterno.palabra" class="help text-danger">Este campo es alfabético, además no acepta caracteres especiales, ni espacios</p>
                <p v-else-if="!$v.form.appaterno.maxLength" class="help text-danger">Este campo no puede contener más de 50 caracteres</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Apellido Materno</label>
                <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.apmaterno">
                <p v-if="!$v.form.apmaterno.palabra" class="help text-danger">Este campo es alfabético, además no acepta caracteres especiales, ni espacios</p>
                <p v-else-if="!$v.form.apmaterno.maxLength" class="help text-danger">Este campo no puede contener más de 50 caracteres</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Nombres</label>
                <input type="text" class="form-control" placeholder="Ingrese nombres" required v-model="form.nombres">
                <p v-if="!$v.form.nombres.oracion" class="help text-danger">Este campo es alfabético, además no acepta caracteres especiales</p>
                <p v-else-if="!$v.form.nombres.maxLength" class="help text-danger">Este campo no puede contener más de 50 caracteres</p>
            </div>
            <div class="col-md-6 mt-2">
                <label>Celular</label>
                <input type="number" class="form-control" placeholder="Ingrese su número de celular" required v-model="form.celular">
                <p v-if="!$v.form.celular.numeric" class="help text-danger">Este campo solo acepta números</p>
                <p v-else-if="!$v.form.celular.minLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
                <p v-else-if="!$v.form.celular.maxLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
                <p v-else-if="!$v.form.celular.numeroCelular" class="help text-danger">El número ingresado es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Dni</label>
                <input type="text" class="form-control" placeholder="Ingrese su número de DNI" required v-model="form.dni">
                <p v-if="!$v.form.dni.dni" class="help text-danger">Este campo debe de tener 8 dígitos</p>
            </div>
            <div class="col-md-6 mt-2">
                <label >Dirección</label>
                <input type="text" class="form-control" placeholder="Ingrese su dirección" required v-model="form.direccion">
                <p v-if="!$v.form.direccion.direccion" class="help text-danger">Este campo no acepta caracteres especiales</p>
                <p v-else-if="!$v.form.direccion.maxLength" class="help text-danger">Este campo no puede contener más de 150 caracteres</p>
            </div>
            </div>
        <button type="submit" class="btn btn-icon btn-primary mt-2 btn-sm">Guardar cambios</button>
    </form>
</template>

<script>
import Swal from 'sweetalert2'
import {validationMixin} from 'vuelidate'
import {required, numeric, minValue, maxValue, maxLength, minLength, alphaNum, helpers} from 'vuelidate/lib/validators'
import {oracion, palabra, direccion, numeroCelular, dni} from '../../utils/expresiones-regulares'
    export default {
        mixins: [validationMixin],
        mounted() {
            console.log('Component mounted.')
            console.log(user)
            this.form = { ...user };
        },
        data () {
            return {
                errorUsername:null,
                errorEmail:null,
                form:{
                    nombres:'',
                    appaterno:'',
                    apmaterno:'',
                    username:'',
                    celular:'',
                    dni:'',
                    email:'',
                    direccion:''
                }
            }
        },
         validations:{
            form:{
                nombres:{
                    oracion,
                    maxLength: maxLength(50)
                },
                appaterno:{
                    palabra,
                    maxLength: maxLength(50)
                },
                apmaterno:{
                    palabra,
                    maxLength: maxLength(50)
                },
                celular:{
                    numeric,
                    numeroCelular,
                    maxLength:maxLength(12),
                    minLength: minLength(6)
                },
                dni:{
                    dni
                },
                email:{
                    maxLength:maxLength(100)
                },
                username:{
                    alphaNum,
                    maxLength:maxLength(50),
                },
                direccion:{
                    direccion,
                    maxLength:maxLength(150)
                }
            }
        },
        methods:{
            validateUsername: async function(){
                this.$v.$touch()
                console.log(this.$v.form.username.$error)
                const {data} = await axios.get(`/api/username/${this.form.username}`);
                if(data.message){
                    this.errorUsername = true;
                    return false;
                }else return true;
            },
            validateEmail: async function(){
               const {data} = await axios.get(`/api/email/${this.form.email}`);
                if(data.message){
                    this.errorEmail = true;
                    return false;
                }else return true;
            },
            clean(){
                    this.errorEmail = null;
                    this.errorUsername = null;
                    this. form = {
                        nombres:'',
                        appaterno:'',
                        apmaterno:'',
                        celular:'',
                        dni:'',
                        email:'',
                        username:'',
                        direccion:''
                    }
            },
            update: async function(){
                this.errorUsername = null;
                this.errorEmail = null;
                await axios.put(`/api/user`,{...this.form}).then(({data}) => {
                    Swal.fire('Éxito', 'Se han guardado los cambios', 'success');

                }).catch( error => {
                    Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                });
            },
            submit: async function(){
                this.$v.$touch()
                console.log(this.$v.$invalid);
                let validateEmail = true;
                let validateUsername = true;
                this.errorUsername = null;
                this.errorEmail = null;
                if(this.form.username != user.username) validateUsername = await this.validateUsername();
                if(this.form.email != user.email) validateEmail = await this.validateEmail();
                if(!this.$v.$invalid && validateUsername && validateEmail) this.update();
            }
        }

    }
</script>
