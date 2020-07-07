<template>
    <div>
        <div class="row justify-content-center row-search">
            <input ref="autocomplete"  class="form-control offset-2 offset-md-0 col-9 col-md-9" type="search" placeholder="Buscar lugar" aria-label="Search">
            <button class="btn btn-filter ml-2 col-3 col-md-1 d-none d-md-block" type="button" data-toggle="modal" data-target="#myModal"> <i class="fas fa-sliders-h"></i> Filtros</button>
        </div>

        <mapa-interactivo 
            width='100' 
            height='90vh'
            :clickDisabled='true'
            :dragableDisabled='true'
            :minZoom='15'
            @geoPosition ='loadNearBussiness'
            :layers='companies'
            :center='geoCoords'
            :geoUpdate ='geoUpdate'
        ></mapa-interactivo>
        
        <div class="contenedor">
            <button class="botonF2 d-block d-md-none" data-toggle="modal" data-target="#myModal" title="Filtros">
                <i class="fas fa-sliders-h"></i>
            </button>
            <button class="botonF1" @click="geoUpdate = !geoUpdate" title="Mi ubicación">
                <i class="fas fa-map-marked-alt"></i>
            </button>
        </div>

        <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Filtrar búsqueda</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <form action="">
                            <!-- <h5>Tipo de Negocio</h5> -->
                            <b-form-group label="Tipo de Negocio">
                                <b-form-radio  
                                    v-for="option in tiponegocios_items" 
                                    v-model="tiponegocios_selected" 
                                    name="tipo_negocio"
                                    :key="option.id"
                                    :value="option.id"
                                    >
                                     {{ `${option.descripcion} ...... (${countTipoNegocios(option.id)})`}}
                                </b-form-radio>
                            </b-form-group>

                             <b-form-group label="SubCategorias">
                                <b-form-checkbox
                                    v-for="option in categorias_items"
                                    v-model="categorias_selected"
                                    :key="option.id"
                                    :value="option.id"
                                    name="flavour-3a"
                                >
                                    {{ `${option.descripcion} ...... (${repetidos_categorias[option.id]})`}}
                                </b-form-checkbox>
                            </b-form-group>
                        </form>
                    </div>

                    <!-- <div class="modal-footer">
                        <div class="row justify-content-center align-items-center mt-4" v-if="message_state">
                            <img src="/assets/images/check.png" alt="Image" width="25%">
                           
                        </div>
                    </div> -->

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'tiponegocios',
            'categorias'
        ],
        mounted() {
            this.autocomplete = new google.maps.places.Autocomplete(
                (this.$refs.autocomplete),
                {
                    types: ['geocode']
                }
            );
            this.autocomplete.setComponentRestrictions(
            {'country': ['pe']});

            this.autocomplete.addListener('place_changed', () => {
                let place = this.autocomplete.getPlace();
                let ac = place.address_components;
                let lat = place.geometry.location.lat();
                let lng = place.geometry.location.lng();
                let city = ac[0]["short_name"];

                this.loadNearBussiness({lat, lng});
                this.geoCoords = {lat, lng, city};
                //console.log(`The user picked ${city} with the coordinates ${lat}, ${lng}`);
            });
        },
        data(){
            return{
                categorias_items: [],
                categorias_items_extend:[],
                repetidos_categorias:{},
                categorias_selected:[],

                tiponegocios_items: [],
                tiponegocios_selected:[],

                tiponegocios_local: JSON.parse(this.tiponegocios),
                categorias_local: JSON.parse(this.categorias),
                companies: [],
                companies_global:[],
                companies_temp:[],
                categorias_unique: [],
                categorias_extend:[],
                message_state:false,

                geoCoords:null,
                geoUpdate:false
            }
        },
        methods:{
            // messageSuccess: function(){
            //     this.message_state = true;
            //     setTimeout(() => { this.message_state = false;},2000);
            // },
            icon: function(e){
                const array = e.tipos_negocio.split(',');
                let icon = null;
                switch (array[0]) {
                    case '1':
                        icon = '/assets/images/icons/m_restaurant.ico';
                        break;
                    case '2':
                        icon = '/assets/images/icons/m_reposteria.ico';
                        break;
                    case '3':
                        icon = '/assets/images/icons/m_bodega.ico';
                        break;
                    case '4':
                        icon = '/assets/images/icons/m_tiendaropa.ico';
                        break;
                    case '5':
                        icon = '/assets/images/icons/m_tiendaElec.ico';
                        break;
                     case '6':
                        // icon = '/assets/images/icons/m_tiendaAccesorios';
                        break;
                    case '7':
                        icon = '/assets/images/icons/m_libreria.ico';
                        break;
                    default:
                        icon = null;
                        break;
                }

                return icon;
            },
            loadNearBussiness: async function({lat, lng}){
                let array_empresas = [];
                await axios.get(`/api/bussiness-near/${lat}/${lng}`).then( ({data}) => {
                    // console.log(data.empresas);
                    data.empresas.forEach(e => {
                        array_empresas.push({
                            ...e,
                            icon: this.icon(e),
                            popup:`<h4 class="title-popup"><i class="fas fa-store mr-2"></i>${e.nombre}<h4>
                            <hr class="hr-popup">
                            <div class="content-popup">
                                <div class="row mx-1">
                                    <div class="subtitle-popup">Dirección: </div>${e.direccion}
                                </div>
                                <div class="row mx-1 mt-2">
                                    <div class="subtitle-popup">Celular: </div> ${e.celular}
                                </div>
                                <div class="row mx-1 mt-2">
                                    <div class="subtitle-popup">Sitio web - delivery: </div>
                                    <a href="/empresa/${e.nombre_unico}" class="link-popup" target="_blank">${'www.tenvioperu.com/empresa/'+e.nombre_unico}</a>
                                </div>
                                <hr class="hr-popup">
                                <div class="row mx-1 justify-content-around">
                                    <a href="https://api.whatsapp.com/send?phone=51${e.celular}&text=" target="_blank" title="Enviar mensaje" class="link-whatsapp"><i class="fab fa-whatsapp fa-2x col-2"></i></a>
                                    <a href="tel:+${e.celular}" title="Llamar" class="link-phone"><i class="fas fa-phone fa-2x col-2"></i></a>
                                </div>
                            </div>`
                        });
                    });
                    this.companies = array_empresas;
                    this.companies_global = array_empresas.slice();
                });

                this.filterDataApi();
            },
            filterDataApi: function(){
                var cadena_categorias = '';
                this.companies.forEach( e => {
                    cadena_categorias += `${e.categorias},`
                })
                this.categorias_extend = cadena_categorias.split(',');
                this.categorias_unique = [ ...new Set(this.categorias_extend)]
                
                var repetidos = {};
                this.categorias_extend.forEach(function(numero){
                    repetidos[parseInt(numero)] = (repetidos[numero] || 0) + 1;
                });

                this.repetidos_categorias = repetidos; //Objeto { 1:5 } 1 se repiten 5

                this.builFilters()
            },
            builFilters: function(){
                this.categorias_items = []
                let categorias_items_extend = [] , tiponegocios_items = []
                this.categorias_local.forEach( e => {
                    if(this.categorias_unique.includes(e.id + '')) 
                        categorias_items_extend.push(e);
                });

                this.categorias_items_extend = categorias_items_extend;

                this.tiponegocios_local.forEach( e => {
                    if(categorias_items_extend.find( c => c.tipo_negocio_id === e.id )){
                        tiponegocios_items.push(e);
                    }     
                });
                this.tiponegocios_items = tiponegocios_items;
            },
            countTipoNegocios: function(id){
                var count = 0;
                this.companies_global.forEach( e => {
                    const array = e.tipos_negocio.split(',');
                    if(parseInt(array[0]) === id) count += 1;
                })

                return count;
            }
        },
        watch:{
            tiponegocios_selected: function(newValue, oldValue) {
                var layers = []
                this.categorias_selected = []
                this.companies_global.forEach( e => {
                    const array = e.tipos_negocio.split(',');
                    if(parseInt(array[0]) === newValue) layers.push(e);
                })
                this.companies = layers;
                // this.messageSuccess();

                this.companies_temp = layers;
                var categories = []
                this.categorias_items_extend.forEach( e => {
                   if(e.tipo_negocio_id === newValue) categories.push(e);
                });
                this.categorias_items = categories;
            },
            categorias_selected: function(categories_selected, oldValue){
               if(categories_selected.length > 0){
                    var layers = []
                    this.companies_global.forEach( e => {
                        const array = e.categorias.split(',');
                        var BreakException = {};
                        try {
                            categories_selected.forEach( v => {
                                if(array.includes(v+'')) {layers.push(e); throw BreakException;}
                            });
                        } catch (e) {}
                    });
                    this.companies = layers;
               }else{
                   this.companies = this.companies_temp;
               }
            }
        },
    }
</script>
