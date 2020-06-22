<template>
    <div class="mapaInteractivo">
        <div id="map" :style="'height:'+height+'; width:' + width" ></div>
    </div>
</template>

<script>
    import CardMap from './CardMapComponent';
    export default {
        props:['height', 'width', 'layer', 'layers'],
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
        components:{
            CardMap
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
                if(this.layer)this.initLayer();
                if(this.layers)this.initLayers();
            },
            createMarker: function(LatLng){
                var deliveryIcon = L.icon({
                    iconUrl: '/img/deliv.png',
                    // shadowUrl: 'leaf-shadow.png',

                    iconSize:     [50, 50], // size of the icon
                    // shadowSize:   [50, 64], // size of the shadow
                    iconAnchor:   [50, 50], // point of the icon which will correspond to marker's location
                    // shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor:  [-20, -50] // point from which the popup should open relative to the iconAnchor
                });


                this.marker = L.marker(LatLng, {draggable:'true', title: 'Mi ubicación'}).on('dragend', (event) => {
                    var marker = event.target;
                    var position = marker.getLatLng();
                    marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
                    marker.bindPopup("Esta es mi ubicación").openPopup();
                    this.map.panTo(new L.LatLng(position.lat, position.lng))
                    this.$emit('geoPosition', position);
                });
                if(this.layer || this.layers) this.marker.setIcon(deliveryIcon);
                this.marker.addTo(this.map);
                this.marker.bindPopup("Esta es mi ubicación").openPopup();
                this.$emit('geoPosition', this.marker.getLatLng());
                // console.log("Longitud: "+this.marker.getLatLng().lng);
                // console.log("Latitud: "+this.marker.getLatLng().lat);
            },
            initLayer() {
                var layer = this.layer;
                var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.direccion}).
                    bindPopup(`
                    <h3>Pedido Cod.${layer.id}</h3>
                    <b>${layer.direccion}</b>
                    <p><b>Cliente: </b>${layer.cliente}</p>
                    <p><b>Celular: <a href="https://api.whatsapp.com/send?phone=51${layer.celular}&text=" target="_blank">${layer.celular}</a></b></p>
                    `).openPopup();
                    marker.bindTooltip(layer.direccion);
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
            },
            initLayers() {
                this.layers.forEach((layer) => {
                    console.log(layer);
                    var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.direccion}).
                    bindPopup(`
                    <h3>Pedido Cod.${layer.id}</h3>
                    <b>${layer.direccion}</b>
                    <p><b>Cliente: </b>${layer.cliente}</p>
                    <p><b>Celular: <a href="https://api.whatsapp.com/send?phone=51${layer.celular}&text=" target="_blank">${layer.celular}</a></b></p>
                    `);
                    marker.bindTooltip(layer.direccion).openTooltip();
                    marker.addTo(this.map);
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
