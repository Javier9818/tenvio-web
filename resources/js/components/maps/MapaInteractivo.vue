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
            'minZoom',
            'center',
            'geoUpdate'
        ],
        mounted() {
            this.initMap();
        },
        data(){
            return{
                map: null,
                marker: null,
                polyline: null,
                marker_layers:[],
                circle: null
            }
        },
        watch:{
            layers: function(newValue, oldValue) {
              this.cleanLayers()
              this.initLayers()
            },
            center: function(center, oldValue){
                if(this.marker !== null) this.marker.removeFrom(this.map); 
                var LatLng = L.latLng(center.lat, center.lng);
                this.map.setView(LatLng, 15);
                this.createMarker(LatLng, 'Mi ubicación', center.city, null, false, false);
            },
            geoUpdate: function(){
                this.layers = [];
                if(this.marker !== null) {
                     this.marker.removeFrom(this.map); 
                     this.circle.removeFrom(this.map);
                }
                this.map.locate({
                    setView: true,
                    maxZoom: 17
                });

            }
        },
        methods:{
            initMap() {
                this.map = L.map('map', {
                    center: this.layer ? [this.layer.latitud, this.layer.longitud] : null,
                    zoom: 17,
                    minZoom:this.minZoom || null
                });

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                 attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                 id: 'mapbox/streets-v11',
                 accessToken: 'pk.eyJ1IjoiamF2aWVyOTgiLCJhIjoiY2tjOHJvNDlhMWVlejJ5bXI5anNqNDd5eiJ9.fRqLhVZmbzJMi9MF-cbMKg',
                 tileSize: 512,
                 zoomOffset: -1,
                }).addTo(this.map);

                if(!this.geoDisabled){
                    this.map.locate({
                        setView: true,
                        maxZoom: 17,
                        zoom: 17,
                        watch: this.geoWatch === true ? true: false
                    });
                    this.map.on('locationfound', (e) => {
                        this.createMarker(e.latlng, 'Esta es mi ubicación', '<i class="fas fa-child fa-2x"></i> Esta es mi ubicación', false, true, true);
                        // var radius = e.accuracy;
                        this.circle = L.circle(e.latlng, 50)
                        this.circle.addTo(this.map);
                    });
                }else
                    if(this.layer)this.initLayer();


                if(!this.clickDisabled)
                    this.map.on('click', (e) => {
                        this.marker.removeFrom(this.map);
                        this.createMarker(e.latlng, 'Esta es mi ubicación', '<i class="fas fa-child fa-2x"></i> Esta es mi ubicación', false, true, true);
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
                    marker.getPopup().options['maxWidth'] = 8000
                    // console.log(marker.getPopup());
                    marker.bindTooltip(layer.direccion || 'Default').openTooltip();

                   
                    let urlIcon = layer.icon || null;
                    if(urlIcon){
                        var icon =  L.icon({ iconUrl: urlIcon, iconSize: [35, 50],iconAnchor: [17, 50], popupAnchor: [2, -50] })
                        marker.setIcon(icon);
                    }

                    marker.addTo(this.map);
                    this.marker_layers.push(marker);
                });
            },
            cleanLayers(){
                this.marker_layers.forEach( (layer) => { layer.removeFrom(this.map); });
                this.marker_layers = [];
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
