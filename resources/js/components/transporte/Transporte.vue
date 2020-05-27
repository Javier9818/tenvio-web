<template>
    <div>
        <mapa-interactivo height='75vh' width='100%' @geoPosition='geoPosition' ></mapa-interactivo>
        {{location}}
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                location:null
            }
        },
        methods:{
            geoPosition(data){
                this.location = data;
            }
        }
    }
</script>
