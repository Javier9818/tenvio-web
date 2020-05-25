<template>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Información de la empresa</h4>
        <div class="d-block d-md-none" v-if="editar === 'true'">
            <button v-if="edit=='editar'" class="btn btn-primary mt-1" v-on:click="edit='Guardar cambios'">{{edit}}</button>
            <button class="btn btn-primary mt-1" v-if="edit=='Guardar cambios'" v-on:click="edit='editar'">Cancelar</button>
        </div>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements d-none d-md-block" v-if="editar === 'true'">
            <ul class="list-inline">
                <li v-if="edit=='editar'"><button class="btn btn-primary" v-on:click="edit='Guardar cambios'">{{edit}}</button></li>
                <li v-if="edit=='Guardar cambios'"><button class="btn btn-primary" v-on:click="edit='editar'">Cancelar</button></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <foto-portada-empresa :edit="edit" :form="form"></foto-portada-empresa>
                </div>
                <div class="col-md-12" v-if="edit === 'editar'">
                   <data-empresa :form="form"></data-empresa>
                </div>
                <div class="col-md-12" v-else>
                    <form-empresa-edit :edit="edit" :form="form"></form-empresa-edit>
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
            console.log('Component mounted.')
        },
        data () {
            return {
                edit:'editar',
                form:{
                    ...empresa,
                    provincia:'',
                    departamento:'',
                    distritoName:''
                }
            }
        }
    }
</script>
