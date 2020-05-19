<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Cargo</th>
                    <th>Celular</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="empleado in empleados" :key="empleado.id">
                    <th scope="row">{{empleado.nombres}} {{empleado.appaterno}}</th>
                    <td>Gerente</td>
                    <td>{{empleado.celular}}</td>
                    <td>
                        <a :href="'/intranet/empleado/edit/'+empleado.id" class="mr-2" title="Editar"><i class="ft-edit success"></i></a>
                        <a href="" title="Eliminar"><i class="ft-delete red"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <a type="button" class="btn btn-icon btn-primary" href="/intranet/nuevo-empleado">Nuevo empleado</a>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get(`/api/empleados/${empresa}`).then(({data})=>{ this.empleados = data.empleados; });
        },
        data() {
      return {
        empleados:[]
        }
    }
    }
</script>
