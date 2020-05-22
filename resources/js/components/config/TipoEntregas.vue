<template>
    <div>
        <b-form-checkbox
            id="checkbox-1"
            v-model="delivery"
            name="checkbox-1"
            value="accepted"
            unchecked-value="not_accepted"
            :state="deliveryChange"
            >
            Entrega via delivery
        </b-form-checkbox>
        <br>
        <b-form-checkbox
            id="checkbox-2"
            v-model="local"
            name="checkbox-2"
            value="accepted"
            unchecked-value="not_accepted"
            v-on:changue="recepcionChange()"
            >
            Entrega con recepción en local
        </b-form-checkbox>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                delivery:'accepted',
                local:'accepted',
                checked:true,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        computed:{
            deliveryChange(){
                alert('hola');
            },
            recepcionChange(){
                alert('holarecepcion');
            }
        }
    }
</script>
