<template>
<div class="container">
    <div class="modal-body">
         <form v-on:submit.prevent="submit()" id="formEmpresa">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label>RUC</label> <!--is-invalid-->
                    <input type="number" class="form-control" placeholder="Ingrese apellidos paternos" v-model="form.ruc">
                    <p v-if="$v.form.ruc.$error" class="help text-danger">Este campo es inválido</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Nombre*</label>
                    <input type="text" class="form-control" placeholder="Ingrese apellidos maternos" required v-model="form.nombre">
                    <p v-if="$v.form.nombre.$error" class="help text-danger">Este campo es inválido</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Teléfono</label>
                    <input type="number" class="form-control" placeholder="Ingrese nombres"  v-model="form.telefono">
                    <p v-if="$v.form.telefono.$error" class="help text-danger">Este campo es inválido</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Celular*</label>
                    <input type="number" class="form-control" placeholder="Ingrese su número de celular" required v-model="form.celular">
                    <p v-if="$v.form.celular.$error" class="help text-danger">Este campo es inválido</p>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Tipo de Negocio*</label>
                    <b-form-select v-model="form.tiponegocio" :options="optionsTipoNegocios" text-field="descripcion" value-field="id" @change="handleTipoNegocio" required>
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>categorias</label>
                    <b-overlay :show="loadCategorias" rounded spinner-small spinner-variant="primary">
                        <multi-select :options="optionsCategorias"
                            :selected-options="form.categorias"
                            option-value="value"
                            option-text="text"
                            placeholder="Seleccionar Categorias"
                            @select="selectCategoria"
                        >
                        </multi-select>
                        <!-- <b-form-select v-model="form.categorias" :options="optionsCategorias" text-field="descripcion" value-field="id" required>
                            <template v-slot:first>
                                <b-form-select-option :value="[]" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                            </template>
                        </b-form-select> -->
                    </b-overlay>
                </div>

                <div class="col-md-12 mt-2">
                    <label>Dirección*</label>
                    <input type="text" class="form-control" placeholder="Ingrese la direccion de su empresa" required v-model="form.direccion">
                    <p v-if="$v.form.direccion.$error" class="help text-danger">Este campo es inválido</p>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Departamento*</label>
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
                    <label>Provincia*</label>
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
                    <label>Distrito*</label>
                    <b-form-select
                        v-model="form.distrito"
                        :options="distritos"
                        value-field="id"
                        text-field="name"
                        v-on:change="handleDistrito()"
                        required
                    >
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                    <div class="col-md-6 mt-2" v-if="nuevaCiudad === false">
                        <label>Ciudad*</label>
                        <b-overlay :show="loadCiudades" rounded spinner-small spinner-variant="primary">
                            <b-form-select
                                v-model="form.ciudad"
                                :options="ciudades"
                                value-field="id"
                                text-field="nombre"
                                required=""
                            >
                                <template v-slot:first>
                                    <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-overlay>
                        <a href="javascript:void(0)" v-on:click="() => {nuevaCiudad=true; form.ciudad=null;}">¿No encontraste la ciudad? Crear ciudad</a>
                    </div>


               <div class="col-md-6 mt-2" v-if="nuevaCiudad">
                    <label>Nueva ciudad</label>
                    <input type="text" class="form-control" placeholder="Ingrese el nombre de la ciudad" required v-model="form.ciudadCreate">
                    <a href="javascript:void(0)" v-on:click="() => {nuevaCiudad=false; form.ciudadCreate=null;}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Cerrar</button>
        <button type="submit" form="formEmpresa" class="btn btn-primary">Registrar</button>
    </div>
</div>
</template>

<script>
    import { MultiSelect } from 'vue-search-select'
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
    const text = helpers.regex('alpha', /^[a-zA-Z0-9&À-ÿ#.\u00f1\u00d1\s]*$/)

    import Swal from 'sweetalert2'
    export default {
        mixins: [validationMixin],
        mounted() {
            axios.get('/json/departamentos.json').then(({data}) => { this.departamentos = data;});
            axios.get('/json/provincias.json').then(({data}) => { this.provinciasGlobal = data });
            axios.get('/json/distritos.json').then(({data}) => { this.distritosGlobal = data });
            axios.get('/api/tipoNegocios').then(({data})=>{ this.optionsTipoNegocios = data.tiponegocios; });
        },
        data() {
            return {
                loadCiudades:false,
                loadCategorias:false,
                nuevaCiudad:false,
                provinciasGlobal:[],
                distritosGlobal:[],
                optionsTipoNegocios: [],
                optionsCategorias:[],
                departamentos:[],
                provincias:[],
                distritos:[],
                ciudades:[],
                form:{
                    categorias: [],
                    tiponegocio: null,
                    ruc:'',
                    nombre:'',
                    telefono:'',
                    celular:'',
                    direccion:'',
                    ciudad:null,
                    ciudadCreate:null,
                    distrito:null,
                    provincia:null,
                    departamento:null
                }
            }
        },
         validations: {
            form: {
                ruc: {
                    maxLength: maxLength(11)
                },
                nombre: {
                    required,
                    text,
                    maxLength: maxLength(50)
                },
                telefono: {
                    numeric,
                    maxLength:maxLength(12),
                    minLength: minLength(6)
                },
                celular:{
                    required,
                    numeric,
                    maxLength:maxLength(12),
                    minLength: minLength(6)
                },
                direccion:{
                    required,
                    text,
                    maxLength:maxLength(150)
                }
            }
        },
        methods:{
            selectCategoria(categorias, lastSelectItem){
                this.form.categorias = categorias;
                console.log(this.form.categorias);
            },
            handleTipoNegocio(){
                this.loadCategorias = true;
                axios.get(`/api/categorias/${this.form.tiponegocio}`).then(({data})=>{
                    this.loadCategorias = false;
                    this.form.categorias = [];
                    this.optionsCategorias = data.categorias;
                    console.log(data.categorias);
                });
            },
            submit: async function(){
                this.$v.$touch()
                console.log(this.$v.$invalid);
                if(!this.$v.$invalid){
                    await axios.post('/api/empresa', this.form).then((data)=>{
                        console.log(data);
                        Swal.fire('Éxito', 'Se han guardado los cambios', 'success').then( data => {
                            window.location.reload();
                        });
                    }).catch((error) => {
                        console.log(error);
                        Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                    });
                }


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
            },
            handleDistrito: async function(){
                this.form.ciudad = null;
                this.ciudades = [];
                this.loadCiudades = true;
                await axios.get(`/api/ciudades/${this.form.distrito}`).then(({data})=>{
                    this.ciudades = data.ciudades;
                    this.loadCiudades = false;
                });
            },
            validaCiudad(){
                return (this.form.ciudad === null && this.form.ciudadCreate === null) ? false : true;
            }
        },
        components: {
			MultiSelect
		}
    }
</script>
