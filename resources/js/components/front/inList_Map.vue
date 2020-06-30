<template>
    <div>
    <div class="row d-flex justify-content-center align-items-center" style="position: fixed;z-index:9999;top:120px;right:35%">
        <div class="col-sm-6">
            <b-form-input v-model="search" style="box-shadow:0 3px 14px rgba(0,0,0,0.4)" placeholder="¿Donde Estas?"></b-form-input>
        </div>
        <div class="col-sm-6">

            <button type="button" class="btn btn-primary btn-block" style="box-shadow:0 3px 14px rgba(0,0,0,0.4)" data-toggle="modal" data-target="#modalPoll-1">Filtros</button>

            <!-- Modal: modalPoll -->
            <div class="modal fadeInRight right" id="modalPoll-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-full-height modal-right modal-notify modal-info m-0" role="document">
                <div class="modal-content m-0">
                    <!--Header-->
                    <div class="modal-header">
                    <p class="heading lead">Filtros
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                    <div class="text-center">

                    </div>

                    <hr>

                    <!-- Radio -->
                    <p class="text-center">
                        <strong>Filtros</strong>
                    </p>


                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                    <a type="button" class="btn btn-primary waves-effect waves-light">OK
                        <i class="fa fa-paper-plane ml-1"></i>
                    </a>
                    <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
                    </div>
                </div>
                </div>
            </div>
            <!-- Modal: modalPoll -->

        </div>
    </div>
        <mapa-interactivo ref="mapaComponent" width='100' height='100vh' :watch='true'></mapa-interactivo>
    </div>
</template>
<script>
export default {

}
</script>
