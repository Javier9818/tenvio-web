<template>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foto de portada del negocio</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <foto-portada-empresa :scope="editar" :form="form"></foto-portada-empresa>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información de la empresa</h4>
                        <div class="d-block d-md-none" v-if="editar === 'true'">
                            <button v-if="edit=='editar'" class="btn btn-primary mt-1 btn-sm" @click="edit='Guardar cambios'"> <i class="ft-edit"></i> {{edit}}</button>
                            <button class="btn btn-danger mt-1 btn-sm" v-if="edit=='Guardar cambios'" v-on:click="edit='editar'">Cancelar</button>
                        </div>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements d-none d-md-block" v-if="editar === 'true'">
                            <ul class="list-inline">
                                <li v-if="edit=='editar'"><button class="btn btn-primary btn-sm" v-on:click="edit='Guardar cambios'"><i class="ft-edit"></i>{{edit}}</button></li>
                                <li v-if="edit=='Guardar cambios'"><button class="btn btn-danger btn-sm" v-on:click="edit='editar'">Cancelar</button></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                             <data-empresa :form="form" v-if="edit === 'editar'"></data-empresa>
                             <form-empresa-edit :edit="edit" :form="form" v-else @fineditar="fineditar"></form-empresa-edit>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        props:['editar'],
        mounted() {
        },
        data () {
            return {
                edit:'editar',
                form:{
                    ...empresa,
                    categorias:[],
                    provincia:'',
                    departamento:'',
                    distritoName:''
                }
            }
        },
		methods: {
			fineditar: function(){
				this.edit = 'editar';
			}
		}
    }
</script>
