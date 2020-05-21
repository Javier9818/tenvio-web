<template>
     <form v-on:submit.prevent="submit()">
        <div class="row">
            <div class="col-md-6 mt-2">
                <label>Usuario</label>
                <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario, ejemplo:primerNombre123 " required v-model="form.username" :class="{ 'is-invalid': errorUsername }">
                <span class="danger" v-if="errorUsername">Este usuario ya existe, intente con otro diferente</span>
            </div>
            <div class="col-md-6 mt-2">
                <label >Email</label>
                <input type="email" class="form-control" placeholder="Ingrese su email" required v-model="form.email" :class="{ 'is-invalid': errorEmail }">
                <span class="danger" v-if="errorEmail">Este email ya existe, intente con otro diferente</span>
            </div>
            <div class="col-md-6 mt-2">
                <label >Apellido Paterno</label> <!--is-invalid-->
                <input type="text" class="form-control" placeholder="Ingrese apellidos paternos" required v-model="form.appaterno">
            </div>
            <div class="col-md-6 mt-2">
                <label >Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.apmaterno">
            </div>
            <div class="col-md-6 mt-2">
                <label >Nombres</label>
                <input type="text" class="form-control" placeholder="Ingrese nombres" required v-model="form.nombres">
            </div>
            <div class="col-md-6 mt-2">
                <label>Celular</label>
                <input type="number" class="form-control" placeholder="Ingrese su número de celular" required v-model="form.celular">
            </div>
            <div class="col-md-6 mt-2">
                <label >Dni</label>
                <input type="number" class="form-control" placeholder="Ingrese su número de DNI" required v-model="form.dni">
            </div>
            <div class="col-md-6 mt-2">
                <label >Dirección</label>
                <input type="text" class="form-control" placeholder="Ingrese su dirección" required v-model="form.direccion">
            </div>
            </div>
        <button type="submit" class="btn btn-icon btn-primary mt-2">Guardar cambios</button>
    </form>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
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
                let validateEmail = true;
                let validateUsername = true;
                this.errorUsername = null;
                this.errorEmail = null;
                if(this.form.username != user.username) validateUsername = await this.validateUsername();
                if(this.form.email != user.email) validateEmail = await this.validateEmail();
                if(validateUsername && validateEmail)  this.update();
            }
        }

    }
</script>
