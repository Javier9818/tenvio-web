<template>
    <form v-on:submit.prevent="submit()">
        <div class="row">
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Apellido Paterno</label> <!--is-invalid-->
                <input type="text" class="form-control" placeholder="Ingrese apellidos paternos" required v-model="form.appaterno">
                <p v-if="$v.form.appaterno.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Apellido Materno</label>
                <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.apmaterno">
                <p v-if="$v.form.apmaterno.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Nombres</label>
                <input type="text" class="form-control" placeholder="Ingrese nombres" required v-model="form.nombres">
                <p v-if="$v.form.nombres.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Usuario</label>
                <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario, ejemplo:primerNombre123 " required v-model="form.username" :class="{ 'is-invalid': errorUsername }">
                <span class="danger" v-if="errorUsername">Este usuario ya existe, intente con otro diferente</span>
                <p v-if="$v.form.username.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Celular</label>
                <input type="number" class="form-control" placeholder="Ingrese su número de celular" required v-model="form.celular">
                <p v-if="$v.form.celular.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Dni</label>
                <input type="number" class="form-control" placeholder="Ingrese su número de DNI" required v-model="form.dni">
                <p v-if="$v.form.dni.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Email</label>
                <input type="email" class="form-control" placeholder="Ingrese su email" required v-model="form.email" :class="{ 'is-invalid': errorEmail }" v-on:keyup="errorEmail=false">
                <span class="danger" v-if="errorEmail">Este email ya existe, intente con otro diferente</span>
                <p v-if="$v.form.email.$error" class="help text-danger">Este campo es inválido</p>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Dirección</label>
                <input type="text" class="form-control" placeholder="Ingrese su dirección" required v-model="form.direccion">
                <p v-if="$v.form.direccion.$error" class="help text-danger">Este campo es inválido</p>
            </div>
             <div class="col-md-6 mt-2">
                    <label>Cargo</label>
                    <b-form-select
                        v-model="form.cargo"
                        :options="optionsCargos"
                        value-field="value"
                        text-field="text"
                        v-on:change="cargoChange()"
                        required
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
            </div>
            <div class="col-md-6 mt-2">
                <label for="roles">Permisos</label>
                <b-form-checkbox-group v-model="form.roles" id="roles" :options="options">
                </b-form-checkbox-group>
            </div>
            </div>
        <button type="submit" class="btn btn-icon btn-primary mt-2" v-if="edit">Guardar cambios</button>
        <button type="submit" class="btn btn-icon btn-primary mt-2" v-else>Registrar</button>
    </form>
</template>

<script>
    import Swal from 'sweetalert2'
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue, maxLength, minLength, alphaNum, helpers} from 'vuelidate/lib/validators'
    const text = helpers.regex('custom', /^[a-zA-Z0-9À-ÿ#.\u00f1\u00d1\s]*$/)
    const alpha = helpers.regex('custom', /^[a-zA-ZÀ-ÿ]*$/)
    export default {
        props:['edit'],
        mixins: [validationMixin],
        mounted() {
            console.log(this.edit);
            axios.get('/api/roles').then(({data})=>{ this.options = data.roles });
            axios.get('/api/cargos').then(({data})=>{ this.optionsCargos = data.cargos });
            if(this.edit){ this.form = { ...empleado, roles }; console.log(empleado);};
        },
        data() {
            return {
                show: true,
                options: [],
                optionsCargos:[],
                errorUsername:null,
                errorEmail:null,
                form:{
                    nombres:'',
                    appaterno:'',
                    apmaterno:'',
                    celular:'',
                    dni:'',
                    email:'',
                    username:'',
                    direccion:'',
                    cargo:null,
                    roles:[]
                }
            }
        },
        validations:{
            form:{
                nombres:{
                    required,
                    text,
                    maxLength: maxLength(50)
                },
                appaterno:{
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                apmaterno:{
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                celular:{
                    numeric,
                    maxLength:maxLength(12),
                    minLength: minLength(6)
                },
                dni:{
                    required,
                    maxLength:maxLength(8),
                    minLength: minLength(8)
                },
                email:{
                    required,
                    maxLength:maxLength(100)
                },
                username:{
                    required,
                    alphaNum,
                    maxLength:maxLength(50),
                },
                direccion:{
                    required,
                    text,
                    maxLength:maxLength(150)
                }
            }
        },
        methods:{
            validateUsername: async function(){
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
                        direccion:'',
                        roles:[]
                    }
            },
            update: async function(){
                this.errorUsername = null;
                this.errorEmail = null;
                await axios.put(`/api/empleado`,{...this.form}).then(({data}) => {
                    Swal.fire('Éxito', 'Se han guardado los cambios', 'success');

                }).catch( error => {
                    Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                });
            },
            submit: async function(){
                this.$v.$touch()
                console.log(this.$v.$invalid);
                if(!this.edit){
                    this.errorUsername = null;
                    this.errorEmail = null;
                    let validateEmail = await this.validateEmail();
                    let validateUsername = await this.validateUsername();
                    if( validateEmail && validateUsername && !this.$v.$invalid){
                        await axios.post(`/api/empleado`,{...this.form, empresa}).then(({data}) => {
                            Swal.fire('Éxito', 'Se han guardado los cambios', 'success').then( () => {
                                location.href='/intranet/empleados'
                            });

                        }).catch( error => {
                            Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                        });
                    }
                }else{
                    let validateEmail = true;
                    let validateUsername = true;
                    this.errorUsername = null;
                    this.errorEmail = null;
                    if(this.form.username != empleado.username) validateUsername = await this.validateUsername();
                    if(this.form.email != empleado.email) validateEmail = await this.validateEmail();
                    if(validateUsername && validateEmail && !this.$v.$invalid) this.update();
                }
            },
            cargoChange(){
                console.log(this.form.cargo);
               switch (this.form.cargo) {
                   case 1:
                       this.form.roles = [1, 2, 3, 4, 5, 6];
                       break;
                    case 2:
                       this.form.roles = [1, 2, 3, 4, 5];
                       break;
                    case 3:
                       this.form.roles = [2];
                       break;
                    case 4:
                       this.form.roles = [3,4];
                       break;
                     case 5:
                       this.form.roles = [5];
                       break;

                   default:
                       break;
               }
            }
        }
    }
</script>
