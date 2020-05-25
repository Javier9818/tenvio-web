<template>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Información de la empresa</h4>
        <div class="d-block d-md-none" v-if="editar === 'true'">
            <button v-if="edit=='editar'" class="btn btn-primary mt-1" v-on:click="changeEdit">{{edit}}</button>
            <button class="btn btn-primary mt-1" v-if="edit=='Guardar cambios'" v-on:click="cancelEdit">Cancelar</button>
        </div>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements d-none d-md-block" v-if="editar === 'true'">
            <ul class="list-inline">
                <li v-if="edit=='editar'"><button class="btn btn-primary" v-on:click="changeEdit">{{edit}}</button></li>
                <li v-if="edit=='Guardar cambios'"><button class="btn btn-primary" v-on:click="cancelEdit">Cancelar</button></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" v-if="edit === 'editar'">
                    <img :src="form.foto ? '/storage/images/perfilEmpresa/'+form.foto : '/img/imagenDefault.png'"
                        alt="No se encontró imagen"
                        width="100%">
                </div>
                <div class="col-md-12" v-else>
                    <picture-input
                    ref="pictureInput"
                    width="1200"
                    height="600"
                    margin="16"
                    accept="image/jpeg,image/png"
                    size="10"
                    button-class="btn"
                    zIndex=1
                    :removable="true"
                    :custom-strings="{
                        upload: '<h1>Bummer!</h1>',
                        drag: 'Arrastra una foto o click <br> para actualizar foto',
                        change:'Cambiar imagen',
                        remove:'Remover imagen',
                        tap:'Pulsa aquí para seleccionar una foto <br> desde tu galería'
                    }"
                    @change="onChange">
                    </picture-input>
                </div>
                <div class="col-md-12" v-if="edit === 'editar'">
                    <div class="row">
                        <div class="col-6 mt-2"> <h5 class="d-inline label">Nombre de la empresa </h5><br><h5 class="d-inline">{{form.nombre}}</h5></div>
                        <div class="col-6 mt-2"> <h5 class="d-inline label">RUC </h5><br><h5 class="d-inline">{{form.ruc}}</h5></div>
                        <div class="col-6 mt-2"> <h5 class="d-inline label">Categoría</h5><br><h5 class="d-inline">{{form.categoriaName}}</h5></div>
                        <div class="col-6 mt-2"> <h5 class="d-inline label">Celular </h5><br><h5 class="d-inline">{{form.celular}}</h5></div>
                        <div class="col-12 mt-2"> <h5 class="label">Descripción del negocio </h5><h5>{{form.descripcion || '-'}}</h5></div>
                        <div class="col-12 mt-2"> <h5 class="d-inline label">Dirección</h5><br><h5 class="d-inline">{{form.direccion}}</h5></div>
                        <div class="col-md-6 mt-2"> <h5 class="d-inline label">Distrito </h5><br><h5 class="d-inline">{{form.distrito}}</h5></div>
                        <div class="col-md-6 mt-2"> <h5 class="d-inline label">Ciudad </h5><br><h5 class="d-inline">{{form.ciudad}}</h5></div>
                    </div>
                </div>
                <div class="col-md-12" v-else>
                    <form  class="row" method="POST">
                        <div class="col-md-12 mt-2">
                            <label for="">Foto de negocio</label><br>
                              <img :src="form.foto ? '/storage/images/perfilEmpresa/'+form.foto : '/img/imagenDefault.png'"
                                alt="No se encontró imagen"
                                width="40%">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="validationCustom01">Nombre de la empresa</label> <!--is-invalid-->
                            <input type="text" class="form-control" placeholder="Ingrese el nombre de la empresa" v-model="form.nombre">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="validationCustom01">RUC</label>
                            <input type="text" class="form-control" placeholder="Ingrese el RUC de la empresa" v-model="form.ruc">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label>Categoría</label>
                            <b-form-select v-model="form.categoria" :options="optionsCategorias" required>
                                <template v-slot:first>
                                    <b-form-select-option :value="null" disabled>-- Porfavor, elige una opción --</b-form-select-option>
                                </template>
                            </b-form-select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="validationCustom01">Descripción del negocio</label>
                            <textarea class="form-control" cols="30" rows="3" v-model="form.descripcion"></textarea>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="validationCustom01">Celular</label>
                            <input type="text" class="form-control" placeholder="Ingrese el celular de la empresa" v-model="form.celular">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="validationCustom01">Dirección</label>
                            <input type="text" class="form-control" placeholder="Ingrese la dirección de la empresa" v-model="form.direccion">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import PictureInput from 'vue-picture-input'
    import Swal from 'sweetalert2'
    export default {
        props:['editar'],
        mounted() {
            console.log('Component mounted.')
            console.log(empresa);
            console.log(ciudades);
            axios.get('/api/categorias').then(({data})=>{ this.optionsCategorias = data.categorias });
            axios.get('/json/departamentos.json').then(({data}) => {this.departamentos = data;});
            axios.get('/json/distritos.json').then(({data}) => {
                 data.forEach(distrito => {
                    if( parseInt(distrito.id, 10) === empresa.distrito){
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
        data () {
            return {
                loadCiudades:false,
                optionsCategorias:[],
                provinciasGlobal:[],
                distritosGlobal:[],
                departamentos:[],
                provincias:[],
                distritos:[],
                ciudades,
                edit:'editar',
                image:'',
                form:{
                    ...empresa,
                    provincia:'',
                    departamento:''
                }

            }
        },
        components: {
            PictureInput
        },
        methods: {
            onChange (image) {
            console.log('New picture selected!')
            if (image) {
                console.log('Picture loaded.')
                this.image = image
                axios.put(`/api/fotoEmpresa/${this.form.id}`, {image:this.image}).then( ({data}) => {
                    console.log(data);
                    this.form.foto = data.foto;
                    Swal.fire('Éxito', 'La foto se ha actualizado', 'success');
                }).catch( error => Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error'));
            } else {
                console.log('FileReader API not supported: use the <form>, Luke!')
            }
            },
            changeEdit(){
                if(this.edit === 'Guardar cambios'){
                    axios.put(`/api/empresa/${this.form.id}`, this.form).then( data => {
                        console.log(data);
                        Swal.fire('Éxito', 'Se han guardado los cambios', 'success');

                    }).catch(error => {
                        Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error');
                    });
                }
                else this.edit = 'Guardar cambios';
            },
            cancelEdit(){
                this.edit = 'editar';
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
        }
    }
</script>
