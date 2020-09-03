<template>
    <form  class="row" v-on:submit.prevent="update()" id="forEmpresa">
        <div class="col-md-12 mt-2">
            <label for="">Foto de negocio</label><br>
            <img :src="form.foto ? '/storage/images/perfilEmpresa/'+form.foto : '/img/imagenDefault.png'"
            alt="No se encontró imagen"
            width="40%">
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationCustom01">Nombre de la empresa</label> <!--is-invalid-->
            <input type="text" class="form-control" placeholder="Ingrese el nombre de la empresa" v-model="form.nombre">
            <p v-if="!$v.form.nombre.maxLength" class="help text-danger">Este campo no puede tener más de 50 caracteres</p>
            <p v-if="!$v.form.nombre.nombreNegocio" class="help text-danger">Este campo solo puede aceptar un apóstrofe (') como caracter especial</p>
        </div>
        <div class="col-md-6 mt-2">
            <label for="validationCustom01">RUC</label>
            <input type="text" class="form-control" placeholder="Ingrese el RUC de la empresa" v-model="form.ruc">
            <p v-if="!$v.form.ruc.minLength" class="help text-danger">Este campo debe de tener 11 números</p>
            <p v-else-if="!$v.form.ruc.maxLength" class="help text-danger">Este campo debe de tener 11 números</p>
            <p v-else-if="!$v.form.ruc.ruc" class="help text-danger">Este campo debe de empezar con 10 o 20 o 15 o 16 o 17 seguido de 9 números</p>
            
        </div>
        <div class="col-md-6 mt-2">
             <label>Tipo de Negocio*</label>
            <b-form-select v-model="form.tiponegocio" :options="optionsTipoNegocios" text-field="descripcion" value-field="id" @change="handleTipoNegocio" required>
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                </template>
            </b-form-select>
        </div>
        <div class="col-md-12 mt-2">
            <label>Categorias</label>
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
                <!-- <b-form-select v-model="form.categorias" :options="optionsCategorias" text-field="descripcion" value-field="id" required>
                    <template v-slot:first>
                        <b-form-select-option :value="[]" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                    </template>
                </b-form-select> -->
            </b-overlay>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationCustom01">Descripción del negocio</label>
            <textarea class="form-control" cols="30" rows="3" v-model="form.descripcion"></textarea>
            <p v-if="!$v.form.descripcion.text" class="help text-danger">Este campo no acepta caracteres especiales</p>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationCustom01">Celular</label>
            <input type="text" class="form-control" placeholder="Ingrese el celular de la empresa" v-model="form.celular">
            <p v-if="!$v.form.celular.numeric" class="help text-danger">Este campo solo acepta números</p>
            <p v-else-if="!$v.form.celular.minLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
            <p v-else-if="!$v.form.celular.maxLength" class="help text-danger">Este campo no puede tener menos de 9 dígitos</p>
            <p v-else-if="!$v.form.celular.numeroCelular" class="help text-danger">El número ingresado es inválido</p>

        </div>
        <div class="col-md-12 mt-2">
            <label for="validationCustom01">Dirección</label>
            <input type="text" class="form-control" placeholder="Ingrese la dirección de la empresa" v-model="form.direccion">
            <p v-if="!$v.form.direccion.direccion" class="help text-danger">Este campo no acepta caracteres especiales</p>
            <p v-else-if="!$v.form.direccion.maxLength" class="help text-danger">Este campo no puede contener más de 150 caracteres</p>
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
                v-on:change="handleDistrito()"
                required
            >
                <template v-slot:first>
                    <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                </template>
            </b-form-select>
        </div>

            <div class="col-md-6 mt-2">
            <label>Ciudad</label>
            <b-overlay :show="loadCiudades" rounded spinner-small spinner-variant="primary">
                <b-form-select
                    v-model="form.ciudad_id"
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
        </div>
        <div class="col-md-12 mt-2 text-center">
			<loader :mostrar="mostrarLoader" texto="Actualizando..."></loader>
            <button type="submit" class="btn btn-primary btn-sm"> <i class="ft-save"></i> {{edit}}</button>
        </div>
    </form>
</template>

<script>
    import { MultiSelect } from 'vue-search-select'
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
    import {direccion, nombreNegocio, ruc, numeroTelefonico, numeroCelular, text} from '../../utils/expresiones-regulares'
    import Swal from 'sweetalert2'
    export default {
        props:['edit', 'form'],
        mixins: [validationMixin],
        mounted() {
            this.inicializa();
            axios.get('/json/departamentos.json').then(({data}) => {this.departamentos = data;});
            axios.get('/json/distritos.json').then(({data}) => {
                 data.forEach(distrito => {
                    if( distrito.id === empresa.distrito){
                        this.form.distritoName = distrito.name
                        data.forEach( e => {
                           if(e.province_id === distrito.province_id){
                               this.distritos.push(e);
                               this.form.provincia = e.province_id;
                               this.form.departamento = e.department_id;
                           }
                        });
                        axios.get('/json/provincias.json').then(({data}) => {
                            this.provinciasGlobal = data;
                            data.forEach( province => {
                                if(province.department_id === this.form.departamento)
                                    this.provincias.push(province);
                            });
                        });
                    }
                 });
                 this.distritosGlobal = data
            });
        },
        data(){
            return{
                loadCiudades:false,
                loadCategorias:false,
                optionsCategorias:categorias,
                optionsTipoNegocios:tiponegocios,
                provinciasGlobal:[],
                distritosGlobal:[],
                departamentos:[],
                provincias:[],
                distritos:[],
                ciudades,
				mostrarLoader:false
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
                descripcion:{
                    text,
                    maxLength:maxLength(200)
                },
                categorias:{
                    required
                }
            }
        },
         methods: {
            inicializa(){
                const arrayCategorias =  empresa.categorias.split(',');
                this.form.categorias = [];
                categorias.forEach((v) => {
                    if(arrayCategorias.includes((v.value).toString()))
                    this.form.categorias.push(v);
                });
            },
             selectCategoria(categorias, lastSelectItem){
                this.form.categorias = categorias;
            },
            handleTipoNegocio(){
                this.loadCategorias = true;
                axios.get(`/api/categorias/${this.form.tiponegocio}`).then(({data})=>{
                    this.loadCategorias = false;
                    this.form.categorias = [];
                    this.optionsCategorias = data.categorias;

                });
            },
            update(){
                this.$v.$touch()

                if(!this.$v.$invalid){
					this.mostrarLoader = true;
					var that = this;
                    axios.put(`/api/empresa/${this.form.id}`, this.form).then( data => {
                        Swal.fire('Éxito', 'Se han guardado los cambios', 'success');
						this.$emit('fineditar');
                    })
					.catch(error => {
                        Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                    })
					.finally(()=>{
						that.mostrarLoader = false;
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
                this.form.ciudad_id = null;
                this.ciudades = [];
                this.loadCiudades = true;
                await axios.get(`/api/ciudades/${this.form.distrito}`).then(({data})=>{
                    this.ciudades = data.ciudades;
                    this.loadCiudades = false;
                });
            },

        },
        components: {
			MultiSelect
		}
    }
</script>
