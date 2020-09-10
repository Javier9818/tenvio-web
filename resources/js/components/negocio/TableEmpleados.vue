<template>
    <div>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12" v-for="empleado in empleados" :key="empleado.user_id">
                <div class="card pull-up ecom-card-1 bg-white">
                    <div class="card-content ecom-card2 height-180">
                        <h5 class="text-muted primary position-absolute p-1">{{empleado.nombres}}</h5>
                        <div>
                            <i class="ft-user primary font-large-1 float-right p-1"></i>
                        </div>
                        <div class="progress-stats-container ct-golden-section height-75 position-relative pt-3  ">
                            <div class="container mt-1">
                                <div class="row mt-1">
                                    <div class="col-3"><b>Apellidos:</b></div>
                                    <div class="col-9">{{`${empleado.appaterno} ${empleado.apmaterno}`}}</div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-3"><b>Celular:</b></div>
                                    <div class="col-9">{{empleado.celular}}</div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-3"><b>Cargo:</b></div>
                                    <div class="col-9">{{empleado.descripcion}}</div>
                                </div>
                                <div class="row justify-content-end">
                                    <a :href="'/intranet/empleado/edit/'+empleado.user_id" class="btn btn-primary btn-sm mr-1">Editar</a>
                                    <button class="btn btn-danger btn-sm mr-1">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="contenedor">
            <button class="botonF1" data-toggle="modal" data-target="#empresa" @click="nuevoEmpleado" title="Nuevo empleado">
                <span>+</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get(`/api/empleados/${empresa}`).then(({data})=>{ this.empleados = data.empleados;});
        },
        data() {
        return {
            empleados:[]
            }
        },
        methods:{
            nuevoEmpleado(){
                location.href = '/intranet/nuevo-empleado';
            }
        }
    }
</script>
