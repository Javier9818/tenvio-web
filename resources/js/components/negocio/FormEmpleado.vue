<template>
    <form v-on:submit.prevent="submit()">
        <div class="row">
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Apellido Paterno</label> <!--is-invalid-->
                    <input type="text" class="form-control" placeholder="Ingrese apellidos paternos" required v-model="form.appaterno">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.apmaterno">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Nombres</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombres" required v-model="form.nombres">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Usuario</label>
                    <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario, ejemplo:primerNombre123 " required v-model="form.username" :class="{ 'is-invalid': errorUsername }">
                    <span class="danger" v-if="errorUsername">Este usuario ya existe, intente con otro diferente</span>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Celular</label>
                    <input type="number" class="form-control" placeholder="Ingrese su número de celular" required v-model="form.celular">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Dni</label>
                    <input type="number" class="form-control" placeholder="Ingrese su número de DNI" required v-model="form.dni">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Email</label>
                <input type="email" class="form-control" placeholder="Ingrese su email" required v-model="form.email" :class="{ 'is-invalid': errorEmail }">
                <span class="danger" v-if="errorEmail">Este email ya existe, intente con otro diferente</span>
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Dirección</label>
                    <input type="text" class="form-control" placeholder="Ingrese su dirección" required v-model="form.direccion">
            </div>
             <div class="col-md-6 mt-2">
                    <label>Cargo</label>
                    <b-form-select
                        v-model="form.cargo"
                        :options="optionsCargos"
                        value-field="value"
                        text-field="text"
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
    export default {
        props:['edit'],
        mounted() {
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
                if(!this.edit){
                    this.errorUsername = null;
                    this.errorEmail = null;
                    let validateEmail = await this.validateEmail();
                    let validateUsername = await this.validateUsername();
                    if( validateEmail && validateUsername ){
                        await axios.post(`/api/empleado`,{...this.form, empresa}).then(({data}) => {
                            this.clean();
                            Swal.fire('Éxito', 'Se han guardado los cambios', 'success');
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
                    if(validateUsername && validateEmail) this.update();
                }
            },
        }
    }
</script>
