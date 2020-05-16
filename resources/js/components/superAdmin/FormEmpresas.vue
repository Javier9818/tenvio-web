<template>
<div>
    <div class="modal-body">
         <form v-on:submit.prevent="submit()" id="formEmpresa">
            <div class="row">
                <sweet-alert></sweet-alert>
                <div class="col-md-6 mt-2">
                    <label>RUC</label> <!--is-invalid-->
                        <input type="number" class="form-control" placeholder="Ingrese apellidos paternos" v-model="form.ruc">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Nombre</label>
                        <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.nombre">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Teléfono</label>
                        <input type="number" class="form-control" placeholder="Ingrese nombres"  v-model="form.telefono">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Celular</label>
                        <input type="number" class="form-control" placeholder="Ingrese un nombre de usuario" required v-model="form.celular">
                </div>

                <div class="col-md-12 mt-2">
                    <label>Categoría</label>
                    <b-form-select v-model="form.categoria" :options="optionsCategorias" required>
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-12 mt-2">
                    <label>Dirección</label>
                    <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario" required v-model="form.direccion">
                </div>

                <div class="col-md-6 mt-2">
                    <label>Departamento</label>
                    <b-form-select
                        v-model="form.departamento"
                        :options="departamentos"
                        value-field="id"
                        text-field="name"
                        v-on:change="handleDepartamento()"
                        required
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Provincia</label>
                    <b-form-select
                        v-model="form.provincia"
                        :options="provincias"
                        value-field="id"
                        text-field="name"
                        v-on:change="handleProvincia()"
                        required
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Distrito</label>
                    <b-form-select
                        v-model="form.distrito"
                        :options="distritos"
                        value-field="id"
                        text-field="name"
                        required
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Ciudad</label>
                    <input type="text" class="form-control" placeholder="Ingrese un nombre de usuario" required v-model="form.ciudad">
                </div>



            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" form="formEmpresa" class="btn btn-primary">Registrar</button>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
           axios.get('/json/departamentos.json').then(({data}) => {
                this.departamentos = data;
            });
            axios.get('/json/provincias.json').then(({data}) => { this.provinciasGlobal = data });
            axios.get('/json/distritos.json').then(({data}) => { this.distritosGlobal = data });
            axios.get('/api/categorias').then(({data})=>{ this.optionsCategorias = data.categorias });
        },
        data() {
            return {
                provinciasGlobal:[],
                distritosGlobal:[],
                optionsCategorias: [],
                departamentos:[],
                provincias:[],
                distritos:[],
                form:{
                    categoria: null,
                    ruc:'',
                    nombre:'',
                    telefono:'',
                    celular:'',
                    direccion:'',
                    ciudad:'',
                    distrito:null,
                    provincia:null,
                    departamento:null
                }
            }
        },
        methods:{
            submit: async function(){
                alert('hola');
            },
            handleDepartamento: async function(){
                this.form.provincia = null;
                this.provincias = [];
                this.form.distrito = null;
                this.distritos = [];
                this.provinciasGlobal.map((provincia) => {
                   if(provincia.department_id === this.form.departamento) this.provincias.push(provincia);
                })
            },
            handleProvincia: async function(){
                this.form.distrito = null;
                this.distritos = [];
                this.distritosGlobal.map((distrito) => {
                   if(distrito.province_id === this.form.provincia) this.distritos.push(distrito);
                })
            }
        }
    }
</script>
