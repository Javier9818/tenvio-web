<template>

   <div class="row">      
    <div class="col-sm-12 col-md-12 col-lg-12">     
      
        <template v-for="empresa in empresas">
          <div class=" row">
            <div class=" col-8">
              <h4> {{empresa.name_empresa}}</h4> 
            </div>
            <div class=" col-4 text-right">
              <b-form-select v-model="empresa.tipoEntrega" :options="tipoPedidos"></b-form-select>
            </div>
          </div>          
          <div class="cart-table table-responsive" >
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>                 
                <tr class="cart__product " v-for="(item, index) of productos" v-if="empresa.name_empresa==item.name_empresa" :key="index">               
                  <td class="cart__product-item">
                    <div class="cart__product-remove">
                      <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
                    </div>
                    <div class="cart__product-img">
                      <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                    </div>
                    <div class="cart__product-title">
                      <h6>{{item.nombre}}</h6>
                    </div>
                  </td>
                  <td class="cart__product-price">S/. {{item.precio}}</td>
                  <td class="cart__product-quantity">
                    <i class="fa fa-minus decrease-qty text-danger  " style=" cursor: pointer" @click="funAdd('-',index)"></i>
                    <span style=" border: lightgray 0.5px solid" class=" px-2">{{item.cant}}</span>
                    <i class="fa fa-plus increase-qty text-success  " style=" cursor: pointer" @click="funAdd('+',index)"></i>
                  </td>
                  <td class="cart__product-total"> 
                    S/. {{item.precio*item.cant}}
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div><!-- /.cart-table -->
      </template>           
    
    </div><!-- /.col-lg-12 -->
    <div class="col-sm-12 col-md-8 col-lg-8">
      <div class="cart__shiping">
        <h6>A donde llevamos tu pedido ?</h6>
        <form class="row">
          <div class="col-12">
           <mapa-interactivo ref="mapaComponent" width='100' height='400px'></mapa-interactivo>
          </div>
        </form>
      </div><!-- /.cart__shiping -->
    </div><!-- /.col-lg-6 -->
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="cart__total-amount">
        <h6>TOTAL:</h6>
        <ul class="list-unstyled mb-0">
          <li><span>Subtotal :</span><span>S/ {{calcularTotal-calcularTotal*0.18}}</span></li>
          <li><span>IGV :</span><span>S/ {{calcularTotal*0.18}}</span></li>
          <li><span>Órden Total :</span><span>S/ {{calcularTotal}}</span></li>
        </ul>
        <br>
        <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content  text-right">          
          <button class="btn btn-primary" @click="setPedido">Realizar Pedido</button>                                        
        </div>
      </div><!-- /.cart__total-amount -->
    </div><!-- /.col-lg-6 -->    
    <b-modal ref="my-modal" hide-footer title="Generar pedido">
    <div class="d-block "> 

    </div>
    <b-button class="mt-3" variant="outline-danger" block @click="hideModal">Cerrar</b-button>
    
    </b-modal>  
    <!-- <b-form-select v-model="selected" :options="tipoPedidos"></b-form-select> -->
   </div>
   
</template>

<script>  
import EventBus from '../../event-bus';
export default {      
    data(){
        return {
            productos: [],
            total: 0,
            producto:{descripcion:'',foto:'',nombre:'',precio:'',cant:0, id:0, empresa:0},
            temp_productos:[],
            empresas:[],     
            tipoPedidos:[],
            selected:'',
            marker:L.marker([0,0]),
            ubicacion:[]       
        }
    },
    methods:{
      funAdd: function (key,index) {
        
         this.producto=this.productos[index];         
        switch (key) {
          case '+':
            this.producto.cant++;
            break;
          case '-':
            if(this.producto.cant==0)
              break;
            this.producto.cant--;
            break;
          default:
            break;
        }
         this.productos[index]=this.producto;
        let cockie=this.productos;
        this.$cookies.set('carrito',JSON.stringify(cockie))
        ;
        EventBus.$emit('ActualizaEnCart', true);          
      },
      eliminar: function(index){
          this.productos.splice(index,1);
          let cockie=this.productos;
          this.$cookies.set('carrito',JSON.stringify(cockie));           
            EventBus.$emit('elimiarEnCart', true);      
          this.empresas=this.distinct(this.productos);      
      },
      recarga: function () {
        let cockie=JSON.parse(this.$cookies.get('carrito'));
        this.productos = (cockie==null)? []:cockie; 
        //this.temp(this.productos);
        this.empresas=this.distinct(this.productos);
        this.temp_productos=this.productos;
      },
      temp: function () {
        var that = this;
          Vue.swal.fire({
            icon: 'question',
            title: '¿Desea enviar?',
            showCancelButton: true,
            text: 'Aviso'
          }).then((result) => {
            if (!result.value)
              return;
            axios.post('/front/GeneraPedido',{empresas:that.empresas, productos:that.productos})
            .then(function (response) {
              if(response.data)
                Swal.fire('Éxito', 'Se ha generado su pedido', 'success');        
              else
                Swal.fire('ERROR', 'Ha ocurrido un error', 'error'); 
            });

          });

        
      },
      tiposEntrega: function () {
        var that = this;
        axios.post('/front/TipoPedido')
        .then(function (response) {
          that.tipoPedidos= response.data;
        });
      },
      distinct: function (array) {
        return Array.from(new Set(array.map(s=>s.empresa)))
        .map(
          empresa => {
            return{
              empresa: empresa,
              name_empresa: array.find(s=> s.empresa===empresa).name_empresa,
              checked:true,
              tipoEntrega:0,
              lat:0, 
              lng:0
            }
          }
        );
      },
      showModal() {
        this.$refs['my-modal'].show()
      },
      hideModal() {
        this.$refs['my-modal'].hide()
      },
      setPedido:function (params) {
      this.marker=this.$refs.mapaComponent.marker;
      console.log("Longitud: "+this.marker.getLatLng().lng);
      console.log("Latitud: "+this.marker.getLatLng().lat);
      this.empresas.forEach(element => {
        element.lat=this.marker.getLatLng().lat,
        element.lng=this.marker.getLatLng().lng
      });
      this.ubicacion.push(       
        {
          lat:this.marker.getLatLng().lat, 
          lng:this.marker.getLatLng().lng
        }
      );
      // this.showModal();
      var that = this;
      Vue.swal.fire({
				icon: 'question',
				title: '¿Desea generar el pedido?',
				showCancelButton: true,
				text: 'Aviso'
			}).then((result) => {
        if (!result.value)
					return;
        axios.post('/front/GeneraPedido', { 
          empresas: that.empresas, 
          productos: that.productos,
          // ubicacion: that.ubicacion
				})
				.then(function (response) {
				//	console.log(response.data);
					let messsage='';
					let icon= '';
					let	title= '';
					switch (response.data) {
						case 1:
							messsage='Su pedido se ha generado, por favor click aquí para realizar su seguimiento.';
							icon= 'success';
							title= 'Éxito';
							break;
						case 2:						 
							messsage='Error, por favor recargue la página.';
							icon= 'error';
							title= 'ERROR';
							break;
						default:
							break;
					}
						Vue.swal.fire({
						icon: icon,
						title: title,
						text: messsage
						}).then(() => {
               //redireccionar a seguimiento
               
               //borrar cockie de productos
                this.$cookies.set('carrito',null);

						});

				})
				.catch(function (response){
					Vue.swal.fire({
						icon: 'error',
						title: 'ERROR',
						text: 'Sucedió un problema, intente nuevamente en los próximos minutos'
					}).then(() => {
						 	location.reload();
						});
				});
      });   
      }
    },
    computed:{      
      calcularTotal(){        
        this.total = 0;
        var item;
        this.productos.forEach(element => {
              this.total = this.total + (element.precio*element.cant);
        });  
        return this.total;
      }
    },
    mounted() {
        this.recarga();

        console.log('ModalCarrito - Mounted')
    },
    created: function () {
        EventBus.$on('EliminarenModal', function(boolean)  {           
          if(boolean)
           this.recarga(); 
        }.bind(this));
    }
}
</script>

<style>

</style>