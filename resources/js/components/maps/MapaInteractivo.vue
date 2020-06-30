<template>
    <div class="mapaInteractivo">
        <div id="map" :style="'height:'+height+'; width:' + width" ></div>
    </div>
</template>

<script>
    export default {
        props:[
            'height',
            'width',
            'layer',
            'layers',
            'geoDisabled', //true or false
            'clickDisabled', //true or false
            'geoWatch', // true or false
            'clickDisabled' //true or false
        ],
        mounted() {
            this.initMap();
            // console.log(this.layers);
        },
        data(){
            return{
                map: null,
                tileLayer: null,
                marker: L.marker([0,0]),
                polyline: null
            }
        },
        methods:{
            initMap() {
                this.map = L.map('map', {
                    center: this.layer ? [this.layer.latitud, this.layer.longitud] : null,
                    zoom: 17
                });

                this.tileLayer =L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(this.map);

                if(!this.geoDisabled){
                    this.map.locate({
                        setView: true,
                        maxZoom: 17,
                        watch: this.geoWatch === true ? true: false
                    });
                    this.map.on('locationfound', (e) => {this.createMarker(e.latlng, 'Está es mi ubicación');});
                }
                
                if(!this.clickDisabled)
                    this.map.on('click', (e) => { this.marker.removeFrom(this.map); this.createMarker(e.latlng, 'Está es mi ubicación');});
                
                if(this.layer)this.initLayer();
               
                if(this.layers)this.initLayers();
            },
            createMarker: function(LatLng, popup, iconUrl){
                var deliveryIcon = iconUrl ? L.icon({ iconUrl, iconSize: [50, 50],iconAnchor: [50, 50],  popupAnchor: [-20, -50] }): null;
                this.marker = L.marker(LatLng, {draggable:'true', title: 'Mi ubicación'}).on('dragend', (event) => {
                    var marker = event.target;
                    var position = marker.getLatLng();
                    marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
                    marker.bindPopup(popup).openPopup();
                    this.map.panTo(new L.LatLng(position.lat, position.lng))
                    this.$emit('geoPosition', position);
                    if((this.layers).length === 1) this.dibujaLinea(this.layers[0]); //Dibujar linea para layers[0]
                });
                if(iconUrl) this.marker.setIcon(deliveryIcon);
                this.marker.addTo(this.map);
                this.marker.bindPopup(popup).openPopup();
                this.$emit('geoPosition', this.marker.getLatLng());

                if((this.layers).length === 1) this.dibujaLinea(this.layers[0]); //Dibujar linea para layers[0]
            },
            initLayer() {
                var layer = this.layer;
                this.createMarker(new L.LatLng(layer.latitud, layer.longitud), layer.title);
                // var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.direccion}).
                //     bindPopup(`
                //     <h3>Pedido Cod.${layer.id}</h3>
                //     <b>${layer.direccion}</b>
                //     <p><b>Cliente: </b>${layer.cliente}</p>
                //     <p><b>Celular: <a href="https://api.whatsapp.com/send?phone=51${layer.celular}&text=" target="_blank">${layer.celular}</a></b></p>
                //     `).openPopup();
                //     marker.bindTooltip(layer.direccion);
                //     marker.addTo(this.map);
                //================================================
                // var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.title ? layer.title:null})
                // if(layer.popup){
                //     marker.bindPopup(layer.popup).openPopup();
                // }
                // if(layer.tooltip){
                //     marker.bindTooltip(layer.tooltip);
                // }
                // this.marker = marker;
                // marker.addTo(this.map);
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
            dibujaLinea(layer){
                if(this.polyline !== null) this.polyline.removeFrom(this.map);
                var u = this.marker.getLatLng();
                var latlngs = [
                    [u.lat, u.lng],
                    [layer.latitud, layer.longitud]
                ];
                this.polyline = L.polyline(latlngs, {color: 'red'});
                this.polyline.addTo(this.map);
                // zoom the map to the polyline
                this.map.fitBounds(this.polyline.getBounds());
            }
        }


    }
</script>

<style scoped>
.mapaInteractivo{
    height: 100%;
}
</style>
