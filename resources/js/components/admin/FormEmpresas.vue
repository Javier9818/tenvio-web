<template>
<div class="container">
    <div class="modal-body">
        <form v-on:submit.prevent="submit()" id="formEmpresaA">
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label>RUC (opcional)</label> <!--is-invalid-->
                    <input type="text" class="form-control" placeholder="Ingrese el número de su RUC" v-model="form.ruc">
                    <p v-if="!$v.form.ruc.minLength" class="help text-danger">Este campo debe de tener 11 números</p>
                    <p v-else-if="!$v.form.ruc.maxLength" class="help text-danger">Este campo debe de tener 11 números</p>
                    <p v-else-if="!$v.form.ruc.ruc" class="help text-danger">Este campo debe de empezar con 10 o 20 o 15 o 16 o 17 seguido de 9 números</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Nombre del negocio (*)</label>
                    <input type="text" class="form-control" placeholder="Ingrese el nombre de su negocio" required v-model="form.nombre">
                    <p v-if="!$v.form.nombre.maxLength" class="help text-danger">Este campo no puede tener más de 50 caracteres</p>
                    <p v-if="!$v.form.nombre.nombreNegocio" class="help text-danger">Este campo solo puede aceptar un apóstrofe (') como caracter especial</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Teléfono de contácto (opcional)</label>
                    <input type="text" class="form-control" placeholder="Ingrese el teléfono de contácto"  v-model="form.telefono">
                    <p v-if="!$v.form.telefono.numeric" class="help text-danger">Este campo solo acepta números</p>
                    <p v-else-if="!$v.form.telefono.minLength" class="help text-danger">Este campo no puede tener menos de 6 dígitos</p>
                    <p v-else-if="!$v.form.telefono.maxLength" class="help text-danger">Este campo no puede tener más de 9 dígitos</p>
                    <p v-else-if="!$v.form.telefono.numeroTelefonico" class="help text-danger">Este campo no puede iniciar con ceros, a excepción del código de la ciudad seguido de 6 dígitos</p>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Celular de contácto (*)</label>
                    <input type="number" class="form-control" placeholder="Ingrese el celular de contácto" required v-model="form.celular">
                    <p v-if="!$v.form.celular.numeric" class="help text-danger">Este campo solo acepta números</p>
                    <p v-else-if="!$v.form.celular.minLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
                    <p v-else-if="!$v.form.celular.maxLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
                    <p v-else-if="!$v.form.celular.numeroCelular" class="help text-danger">El número ingresado es inválido</p>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Tipo de Negocio (*)</label>
                    <b-form-select v-model="form.tiponegocio" :options="optionsTipoNegocios" text-field="descripcion" value-field="id" @change="handleTipoNegocio" required>
                        <template v-slot:first>
                            <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                        </template>
                    </b-form-select>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Categorias (*)</label>
                    <b-overlay :show="loadCategorias" rounded spinner-small spinner-variant="primary">
                        <multi-select :options="optionsCategorias"
                            :selected-options="form.categorias"
                            option-value="value"
                            option-text="text"
                            placeholder="Seleccionar Categorias"
                            @select="selectCategoria"
                        >
                        </multi-select>
                        <p v-if="$v.form.categorias.$error" class="help text-danger">Debe de seleccionar un elemento</p>
                    </b-overlay>
                </div>

                <div class="col-md-12 mt-2">
                    <label>Dirección (*)</label>
                    <input type="text" class="form-control" placeholder="Ingrese la direccion de su empresa" required v-model="form.direccion">
                    <p v-if="!$v.form.direccion.direccion" class="help text-danger">Este campo no acepta caracteres especiales</p>
                    <p v-else-if="!$v.form.direccion.maxLength" class="help text-danger">Este campo no puede contener más de 150 caracteres</p>
                </div>

                <div class="col-md-6 mt-2">
                    <label>Departamento (*)</label>
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
                    <label>Provincia (*)</label>
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
                    <label>Distrito (*)</label>
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

                <div class="col-md-6 mt-2" v-if="nuevaCiudad === false && promo === undefined">
                    <label>Ciudad (*)</label>
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


               <div class="col-md-6 mt-2" v-if="nuevaCiudad && promo === undefined">
                    <label>Nueva ciudad</label>
                    <input type="text" class="form-control" placeholder="Ingrese el nombre de la ciudad" required v-model="form.ciudadCreate">
                    <a href="javascript:void(0)" v-on:click="() => {nuevaCiudad=false; form.ciudadCreate=null;}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close" v-if="promo === undefined">Cerrar</button>
        <button type="submit" form="formEmpresaA" class="btn btn-primary">{{dataForm ? 'Activar' : 'Registrar'}}</button>
    </div>
</div>
</template>

<script>
    import { MultiSelect } from 'vue-search-select'
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
    import {direccion, nombreNegocio, ruc, numeroTelefonico, numeroCelular} from '../../utils/expresiones-regulares'

    import Swal from 'sweetalert2'
    export default {
        mixins: [validationMixin],
        props:['dataFields', 'dataForm', 'promo'],
        mounted() {
            if(this.dataFields){
                this.departamentos = this.dataFields.departamentos
                this.provinciasGlobal = this.dataFields.provinciasGlobal
                this.distritosGlobal = this.dataFields.distritosGlobal
            }else{
                axios.get('/json/departamentos.json').then(({data}) => { this.departamentos = data;});
                axios.get('/json/provincias.json').then(({data}) => { this.provinciasGlobal = data });
                axios.get('/json/distritos.json').then(({data}) => { this.distritosGlobal = data });
                // axios.get('/api/tipoNegocios').then(({data})=>{ this.optionsTipoNegocios = data.tiponegocios; });
            }

            if(this.dataForm){
                // console.log(this.dataForm)
                this.form =
                {
                    ...this.form,
                    ...this.dataForm,
                    distrito: this.dataForm.ciudad_id,
                    categorias: [],
                    distritoName:'',
                }
                this.inicializa()
                this.inicializaRegiones()
                this.handleDistrito()

            }
        },
        data() {
            return {
                loadCiudades:false,
                loadCategorias:false,
                nuevaCiudad:false,
                provinciasGlobal:[],
                distritosGlobal:[],
                optionsTipoNegocios: tiponegocios,
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
                    minLength: minLength(11),
                    maxLength: maxLength(11),
                    ruc
                },
                nombre: {
                    required,
                    nombreNegocio,
                    maxLength: maxLength(50)
                },
                telefono: {
                    numeroTelefonico,
                    numeric,
                    maxLength:maxLength(9),
                    minLength: minLength(6)
                },
                celular:{
                    numeric,
                    numeroCelular,
                    maxLength:maxLength(9),
                    minLength: minLength(9)
                },
                direccion:{
                    direccion,
                    maxLength:maxLength(150)
                },
                categorias:{
                    required
                }
            }
        },
        methods:{
            close(){
                this.$emit('close');
            },
            inicializa(){
                const arrayCategorias =  this.dataForm.categorias.split(',');
                this.form.categorias = [];
                categorias.forEach((v) => {
                    if(arrayCategorias.includes((v.value).toString()))
                        this.form.categorias.push(v);
                    if(v.tiponegocio === this.dataForm.tiponegocio)
                        this.optionsCategorias.push(v);
                });
            },
            inicializaRegiones(){
                this.distritosGlobal.forEach(distrito => {
                    if( parseInt(distrito.id) === this.form.distrito){
                        this.form.distritoName = distrito.name
                        this.distritosGlobal.forEach( e => {
                            if(parseInt(e.province_id) === parseInt(distrito.province_id)){
                                this.distritos.push(e);
                                this.form.provincia = e.province_id;
                                this.form.departamento = e.department_id;
                            }
                        });
                    }
                });

                this.provinciasGlobal.forEach( province => {
                    if(province.department_id === this.form.departamento)
                        this.provincias.push(province);
                });

            },
            selectCategoria(categorias, lastSelectItem){
                this.form.categorias = categorias;
                // console.log(this.form.categorias);
            },
            handleTipoNegocio(){
                this.loadCategorias = true;
                axios.get(`/api/categorias/${this.form.tiponegocio}`).then(({data})=>{
                    this.loadCategorias = false;
                    this.form.categorias = [];
                    this.optionsCategorias = data.categorias;
                    // console.log(data.categorias);
                });
            },
            submit: async function(){
                this.$v.$touch()
                // console.log(this.$v.$invalid);
                if(!this.$v.$invalid){
                    if(this.dataForm) this.activarEmpresa();
                    else if(this.promo === "true") this.preRegistro();
                    else this.crearEmpresa();
                }
            },
            preRegistro: function(){
                axios.post('/api/pre-registro/empresa', this.form).then(({data})=>{
                    Swal.fire('Éxito', 'El registro se completó satisfactoriamente', 'success').then( data => {
                        this.$emit('complete');
                    });
                }).catch((error) => {
                    Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                });
            },
            crearEmpresa: async function(){
                await axios.post('/api/empresa', this.form).then((data)=>{
                    // console.log(data);
                    Swal.fire('Éxito', 'Se han guardado los cambios', 'success').then( data => {
                        window.location.reload();
                    });
                }).catch((error) => {
                    // console.log(error);
                    Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                });
            },
            activarEmpresa: async function(){
                await axios.post('/api/activate/empresa', this.form).then(({data})=>{
                    let empresa_id = data.empresa
                    Swal.fire('Éxito', 'Se han guardado los cambios', 'success').then( data => {
                        window.location.href=`/admin/empresa/${empresa_id}`;
                    });
                }).catch((error) => {
                    // console.log(error);
                    Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                });
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
