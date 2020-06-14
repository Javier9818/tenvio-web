<template>
    <div class="mapaInteractivo">
        <div id="map" :style="'height:'+height+'; width:' + width" ></div>
    </div>
</template>

<script>
    export default {
        props:['height', 'width', 'layers'],
        mounted() {
            this.initMap();
            console.log(this.layers);
        },
        data(){
            return{
                map: null,
                tileLayer: null,
                marker: L.marker([0,0])
            }
        },
        methods:{
            initMap() {
                this.map = L.map('map');
                this.tileLayer =L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(this.map);
                this.map.locate({setView: true, maxZoom: 17});
                this.map.on('locationfound', (e) => {this.createMarker(e.latlng);});
                this.map.on('click', (e) => { this.marker.removeFrom(this.map); this.createMarker(e.latlng);});
                this.initLayers();
            },
            createMarker: function(LatLng){
                this.marker = L.marker(LatLng, {draggable:'true', title: 'Mi ubicación'}).on('dragend', (event) => {
                    var marker = event.target;
                    var position = marker.getLatLng();
                    marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
                    marker.bindPopup("Esta es mi ubicación").openPopup();
                    this.map.panTo(new L.LatLng(position.lat, position.lng))
                    this.$emit('geoPosition', position);
                });
                this.marker.addTo(this.map);
                this.marker.bindPopup("Esta es mi ubicación").openPopup();
                this.$emit('geoPosition', this.marker.getLatLng());
                // console.log("Longitud: "+this.marker.getLatLng().lng);
                // console.log("Latitud: "+this.marker.getLatLng().lat);
            },
            initLayers() {
                this.layers.forEach((layer) => {
                    console.log(new L.LatLng(layer.latitud, layer.longitud));
                    var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.direccion}).
                    bindPopup(`<b>${layer.direccion}</b>
                    <p><b>Cliente: </b>${layer.cliente}</p>
                    <p><b>Celular: <a href="https://api.whatsapp.com/send?phone=51${layer.celular}&text=" target="_blank">${layer.celular}</a></b></p>
                    <div class='row'>
                        <button class='btn btn-primary btn-sm d-inline mr-1' onclick="juega()">Entregar</button>
                        <button class='btn btn-danger btn-sm d-inline'>Cancelar</button>
                    </div>`);
                    marker.bindTooltip(layer.direccion).openTooltip();
                    marker.addTo(this.map);

                    // const markerFeatures = layer.features.filter(feature => feature.type === 'marker');
                    // const polygonFeatures = layer.features.filter(feature => feature.type === 'polygon');

                    // markerFeatures.forEach((feature) => {
                    // feature.leafletObject = L.marker(new L.LatLng(position.lat, position.lng))
                    //     .bindPopup(feature.name);
                    // });

                    // polygonFeatures.forEach((feature) => {
                    // feature.leafletObject = L.polygon(feature.coords)
                    //     .bindPopup(feature.name);
                    // });
                });
            },
            layerChanged(layerId, active) {
                const layer = this.layers.find(layer => layer.id === layerId);
                layer.features.forEach((feature) => {
                    if (active) feature.leafletObject.addTo(this.map);
                    else feature.leafletObject.removeFrom(this.map);
                });
            },
        }
    }
</script>

<style scoped>
.mapaInteractivo{
    height: 100%;
}
</style>
