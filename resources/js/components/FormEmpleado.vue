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
                    <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario" required v-model="form.username" :class="{ 'is-invalid': errorUsername }">
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
                    <input type="email" class="form-control" placeholder="Ingrese su email" required v-model="form.email">
            </div>
            <div class="col-md-6 mt-2">
                <label for="validationCustom01">Dirección</label>
                    <input type="text" class="form-control" placeholder="Ingrese su dirección" required v-model="form.direccion">
            </div>
            <div class="col-md-12 mt-2">
                <label for="roles">Permisos</label>
                <b-form-checkbox-group v-model="form.roles" id="roles" :options="options">
                </b-form-checkbox-group>
            </div>
        </div>
        <button type="submit" class="btn btn-icon btn-primary mt-2">Registrar</button>
    </form>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/roles').then(({data})=>{ this.options = data.roles });
        },
        data() {
            return {
                options: [],
                errorUsername:null,
               form:{
                   nombres:'',
                   appaterno:'',
                   apmaterno:'',
                   celular:'',
                   dni:'',
                   email:'',
                   username:'',
                   direccion:'',
                   empresa:1,
                   roles:[]
               }
            }
        },
        methods:{
            submit: async function(){
                const {data} = await axios.get(`/api/username/${this.form.username}`);
                if(data.message)
                    this.errorUsername = true;
                else{
                    await axios.post(`/api/empleado`,this.form).then(({data}) => {
                        alert('registro exitoso');
                    });
                }
            }
        }
    }
</script>
