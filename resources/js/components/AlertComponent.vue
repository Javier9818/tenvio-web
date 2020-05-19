<template>
    <div class="">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alert" id="sweetAlert" style="display:none;"></button>
        <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h1 class="text-center">Operación exitosa!</h1>
                    </div>
                </div>
                <div class="button">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['message'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
