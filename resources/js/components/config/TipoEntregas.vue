<template>
    <div>
        <div class="form-group" v-for="tipo in tipos" :key="tipo.id">
            <input type="checkbox" v-model="tipo.estado" v-on:change="handleTipo(tipo.id)">
            {{tipo.nombre}}
        </div>
        <span v-if="alert === 0" style="color:red;"> Sus clientes no podrán realizar pedidos, se recomienda dejar un campo activado</span>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                alert:0,
                tipos:[]
            }
        },
        mounted() {
            console.log('Component mounted.')
            axios.get(`/api/tipo-entregas/${empresa}`).then( ({data}) => {
                this.tipos = data.tipos;
                this.valida(data.tipos);
            });
        },
        methods:{
            valida(array){
                let value = 0;
                array.forEach(tipo => {
                    value = value + tipo.estado;
                });
                this.alert = value;
            },
            handleTipo(tipo){
                axios.put('/api/tipo-entregas', {...this.tipos[tipo-1], empresa}).then( ({data}) => {
                    Swal.fire('Éxito', 'El dato ha sido actualizado', 'success');
                    this.valida(this.tipos);
                }).catch( error => {
                    Swal.fire('Error', 'Ha sucedido un error', 'error');
                });
            }
        }
    }
</script>
