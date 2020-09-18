<template>
     <div class="row">
        <div class="col-12 mt-2"> <h5 class="d-inline label cod">Código de la empresa: </h5><h5 class="d-inline cod_des">{{form.id}}</h5></div>
        <div class="col-6 mt-2"> <h5 class="d-inline label">Nombre de la empresa </h5><br><h5 class="d-inline">{{form.nombre}}</h5></div>
        <div class="col-6 mt-2"> <h5 class="d-inline label">RUC </h5><br><h5 class="d-inline">{{form.ruc}}</h5></div>
        <div class="col-6 mt-2"> <h5 class="d-inline label">Tipo de Negocio</h5><br><h5 class="d-inline">{{form.tiponegociodes}}</h5></div>
        <div class="col-6 mt-2"> <h5 class="d-inline label">Celular </h5><br><h5 class="d-inline">{{form.celular}}</h5></div>
        <div class="col-12 mt-2"> <h5 class="label">Descripción del negocio </h5><h5>{{form.descripcion || '-'}}</h5></div>
        <div class="col-12 mt-2"> <h5 class="d-inline label">Dirección</h5><br><h5 class="d-inline">{{form.direccion}}</h5></div>
        <div class="col-md-6 mt-2"> <h5 class="d-inline label">Distrito </h5><br><h5 class="d-inline">{{form.distritoName}}</h5></div>
        <div class="col-md-6 mt-2"> <h5 class="d-inline label">Ciudad </h5><br><h5 class="d-inline">{{form.ciudad}}</h5></div>
        <div class="col-md-12 mt-2"> <h5 class="d-inline label">Página web del negocio </h5><br><a :href="rutita+'/empresa/'+form.nombre_unico" class="enlace" target="_blank">{{rutita}}/empresa/{{form.nombre_unico}}</a></div>

     </div>
</template>

<script>
    export default {
        props:['form'],
		data(){
            return{
				rutita: ''
			}
		},
        mounted() {
			this.rutita = window.location.origin;
        }
    }
</script>

<style scoped>
    .enlace{
        font-size:1.3em !important;
    }

    .cod{
        color: rgb(238, 15, 15) !important;
    }
    .cod_des{
        font-size: 1.5em;
        font-weight: bold;
    }

</style>
