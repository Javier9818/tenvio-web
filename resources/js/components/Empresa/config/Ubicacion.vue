<template>
    <div>
        <div class="row justify-content-around mb-1" v-if="empresa.latitud === null">
            <h4 class="card-title red col-12 col-md-8"><i class="ft-alert-triangle"></i> Ubicación de negocio no registrada</h4>
            <div class="col-6 col-md-2">
                <b-overlay :show="busy" spinner-variant="primary">
                    <button class="btn btn-primary btn-sm" @click="saveGeoPos">Guardar ubicación actual</button>
                </b-overlay>
            </div>
        </div>
        <div class="row justify-content-start mb-1" v-else>
            <div class="col-6 col-md-3" >
                <b-overlay :show="busy" spinner-variant="primary">
                    <button class="btn btn-primary btn-sm" @click="saveGeoPos">Guardar ubicación seleccionada</button>
                </b-overlay>
            </div>
        </div>
        <mapa-interactivo
            height='500px'
            width='100%'
            @geoPosition="geoCords"
            v-if="empresa.latitud === null"
        >
        </mapa-interactivo>
        <mapa-interactivo
            height='500px'
            width='100%'
            :layer='layer'
            :geoWatch='false'
            :geoDisabled='true'
            @geoPosition="geoCords"
            v-else
        >
        </mapa-interactivo>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        mounted() {

            console.log(empresa);
        },
        data() {
            return {
                empresa,
                layer:{
                    latitud: empresa.latitud ? empresa.latitud : '',
                    longitud: empresa.longitud ? empresa.longitud : '',
                    title: 'Ubicación de negocio',
                    popup: 'Ubicación del negocio'
                },
                busy: false,
                latLng:{}
            }
        },
        methods:{
            geoCords(cords){
                this.latLng = cords;
            },
            saveGeoPos: async function(){
                this.busy = true;
                axios.post(`/api/geo-position/${empresa.id}`, {...this.latLng}).then( (data) => {
                    Swal.fire('Exito', 'Su ubicación ha sido registrada.', 'success').then( data => {
                        window.location.reload();
                    });
                }).catch( error => {
                    Swal.fire('Error', 'Ha sucedido un error', 'error');
                }).finally( data => {this.busy = false;});
            }

        }
    }
</script>
