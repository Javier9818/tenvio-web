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
            'dragableDisabled' ,//true or false
            'minZoom'
        ],
        mounted() {
            this.initMap();
        },
        data(){
            return{
                map: null,
                marker: L.marker([0,0]),
                polyline: null
            }
        },
        watch:{
            layers: function(newValue, oldValue) {
              this.initLayers()
            }
        },
        methods:{
            initMap() {
                this.map = L.map('map', {
                    center: this.layer ? [this.layer.latitud, this.layer.longitud] : null,
                    zoom: 17,
                    minZoom:this.minZoom || null
                });

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(this.map);

                if(!this.geoDisabled){
                    this.map.locate({
                        setView: true,
                        maxZoom: 17,
                        watch: this.geoWatch === true ? true: false
                    });
                    this.map.on('locationfound', (e) => {
                        this.createMarker(e.latlng, 'Esta es mi ubicación', 'Esta es mi ubicación', false, true, true);
                    });
                }else
                    if(this.layer)this.initLayer();
                
                
                if(!this.clickDisabled)
                    this.map.on('click', (e) => { 
                        this.marker.removeFrom(this.map); 
                        this.createMarker(e.latlng, 'Esta es mi ubicación', 'Esta es mi ubicación', false, true, true);
                });
                
                if(this.layers)this.initLayers();
            },
            createMarker: function(LatLng, title, popup, iconUrl, draggable, first){
                var markerX = L.marker(LatLng, {draggable: !this.dragableDisabled, title})
                var deliveryIcon = iconUrl ? L.icon({ iconUrl, iconSize: [50, 50],iconAnchor: [50, 50], popupAnchor: [-20, -50] }): null;
                if(iconUrl) markerX.setIcon(deliveryIcon);
                markerX.addTo(this.map);
                markerX.bindPopup(popup).openPopup();
                if(first) this.$emit('geoPosition', markerX.getLatLng());
                if(first && ((this.layers || []).length === 1)) this.dibujaLinea(markerX, this.layers[0]); //Dibujar linea para layers[0]

                if(draggable && !this.dragableDisabled) 
                    markerX.on('dragend', (event) => {
                        var marker = event.target;
                        var position = marker.getLatLng();
                        marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
                        marker.bindPopup(popup).openPopup();
                        this.map.panTo(new L.LatLng(position.lat, position.lng))
                        if(first) this.$emit('geoPosition', position);
                        if(first && ((this.layers || []).length === 1)) this.dibujaLinea(marker, this.layers[0]); //Dibujar linea para layers[0]
                    });
                
                if(first) this.marker = markerX
            },
            initLayer() {
                var layer = this.layer;
                this.createMarker(new L.LatLng(layer.latitud, layer.longitud),layer.title, layer.title, false, true, true);
            },
            initLayers() {
                this.layers.forEach((layer) => {
                    var marker = new L.marker(new L.LatLng(layer.latitud, layer.longitud), {title: layer.direccion || 'Default'}).
                    bindPopup(layer.popup);
                    marker.bindTooltip(layer.direccion || 'Default').openTooltip();
                    marker.addTo(this.map);
                });
            },
            dibujaLinea(marker, layer){
                if(this.polyline !== null) this.polyline.removeFrom(this.map);
                var u = marker.getLatLng();
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
