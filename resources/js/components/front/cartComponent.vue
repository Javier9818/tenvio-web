<template>
   <form class="row" @submit.prevent="generaPedido">
     <loader mostrar="loader" ref="modalcito" texto="Espere un momento por favor"></loader>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div v-for=" empresa in empresas" :key="empresa.id">
          <div class="col-8"> <h4> Empresa: {{empresa.name_empresa}}</h4> </div>

          <div class="form-group col-12">
             <b-form-group label="Selecciona el método de envio" class="label">
                <b-form-radio-group
                    id="radio-group-1"
                    v-model="empresa.tipoEntrega"
                    :options="tipoPedidos"
                    name="radio-options"
                    required
                ></b-form-radio-group>
            </b-form-group>
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
                <tr class="cart__product " v-for="(item, index) of productos" :key="index">
                  <template v-if="empresa.name_empresa === item.name_empresa">
                      <td class="cart__product-item">
                        <div class="cart__product-remove">
                        <i  @click="eliminar(index)" class="cart__item-delete">&times;</i>
                        </div>
                        <div class="cart__product-img">
                            <img :src="'/storage/imgproductos/'+item.foto" alt="product" />
                        </div>
                        <div class="cart__product-title mt-1">
                            <h6>{{item.nombre}}</h6>
                        </div>
                    </td>
                    <td class="cart__product-price">S/. {{item.precio}}</td>
                    <td class="cart__product-quantity">
                        <i class="fa fa-minus decrease-qty text-danger  " style=" cursor: pointer" @click="funAdd('-',index)"></i>
                        <span style=" border: lightgray 0.5px solid" class=" px-2">{{item.cant}}</span>
                        <i class="fa fa-plus increase-qty text-success " style=" cursor: pointer" @click="funAdd('+',index)"></i>
                    </td>
                    <td class="cart__product-total">
                        S/. {{item.precio*item.cant}}
                    </td>
                  </template>
                </tr>
                <tr><td colspan="3"></td><td class=" text-center" style=" font-weight: bolder font-size:1rem">S/. {{empresa.total}}</td></tr>
              </tbody>
            </table>
          </div><!-- /.cart-table -->
      </div>
    </div>
    <div class="form-group col-12">
        <label for="address" class="label">Ingrese la dirección de destino</label>
        <input type="text" id="address" v-model="direccion" class="form-control focused form__control__javier" placeholder="Ingresar dirección" required>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="cart__shiping">
            <p >Ayúdenos a que su órden se entregue lo más rápido posible.<br><b>Por favor indíque su ubicación en el mapa.</b></p>
            <mapa-interactivo ref="mapaComponent" width='100' height='400px'></mapa-interactivo>
        </div><!-- /.cart__shiping -->
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="cart__total-amount">
            <h6>TOTAL:</h6>
            <ul class="list-unstyled mb-0">

            <li><span>Órden Total :</span><span>S/ {{calcularTotal}}</span></li>
            </ul>
            <br>
            <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content  text-right">
                <button class="btn btn-primary" type="submit">Realizar Pedido</button>
            </div>
        </div>
    </div>
      
   </form>
    
</template>

<script>
import EventBus from '../../event-bus'
import Swal from 'sweetalert2'
export default {
    props:['user'],
    data(){
        return {
            productos: [],
            total: 0,
            producto:{descripcion:'',foto:'',nombre:'',precio:'',cant:0, id:0, empresa:0},
            temp_productos:[],
            empresas:[],
            tipoPedidos:[],
            tipoPedidosTemp:[],
            selected:'',
            marker:L.marker([0,0]),
            ubicacion:[],
            direccion:'',
            client:{
              username:'',
              password:''
            },
            load:false
        }
    },
    methods:{
      funAdd: function (key,index) {

         this.producto=this.productos[index]
         this.generaTotal(this.producto.empresa,this.productos)
        switch (key) {
          case '+':
            this.producto.cant++
            break
          case '-':

            if(this.producto.cant==1)
              break
            this.producto.cant--
            break
          default:
            break
        }

        this.empresas.forEach(element => {
          if(element.empresa=this.producto.empresa)
          {
            element.total=this.generaTotal(this.producto.empresa,this.productos)
          }
        })
         this.productos[index]=this.producto
        let cockie=this.productos
        this.$cookies.set('carrito',JSON.stringify(cockie))
        
        EventBus.$emit('ActualizaEnCart', true)
      },
      eliminar: function(index){
          this.productos.splice(index,1)
          let cockie=this.productos
          this.$cookies.set('carrito',JSON.stringify(cockie))
            EventBus.$emit('elimiarEnCart', true)
          this.empresas=this.distinct(this.productos)
      },
      recarga: function () {
        let cockie=JSON.parse(this.$cookies.get('carrito'))
        this.productos = (cockie==null)? []:cockie
        this.empresas=this.distinct(this.productos)
        this.temp_productos=this.productos
        this.tiposEntrega()

      },
      temp: function ( ) {
        var that = this
          Vue.swal.fire({
            icon: 'question',
            title: '¿Desea enviar?',
            showCancelButton: true,
            text: 'Aviso'
          }).then((result) => {
            if (!result.value)
              return
            axios.post('/front/GeneraPedido',{empresas:that.empresas, productos:that.productos})
            .then(function (response) {
              if(response.data)
                Swal.fire('Éxito', 'Se ha generado su pedido', 'success')
              else
                Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
            })

          })


      },
      tiposEntregaData: function (id) {

         setTimeout(() => {
          this.tipoPedidos.forEach(element => {
          if (element.id==id) {
            this.tipoPedidosTemp.push(element)
          }
          })

          return  this.tipoPedidosTemp
         }, 1500)

      },
      tiposEntrega: function () {
        var that = this
        axios.post('/front/TipoPedido',{empresas:this.empresas})
        .then(function (response) {
           that.tipoPedidos= response.data
        })

      },
      toFixed: function (params) {
        return params.toFixed(2)
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
              lng:0,
              direccion:' ',
              total:this.generaTotal(empresa, array)
            }
          }
        )
      },
      generaTotal: function (empresa,array) {
        let total=0
        array.forEach(element => {
          if(element.empresa==empresa)
          {
            total+=element.precio*element.cant
          }
        })

        return total
      },
      generaPedido: function () {
         this.marker=this.$refs.mapaComponent.marker
         //if(!document.getElementById('radio-group-1').checked)
          //return

        if(this.$refs.mapaComponent.marker.getLatLng().lng === 0 && this.$refs.mapaComponent.marker.getLatLng().lat === 0){
            Swal.fire({
            icon: 'error',
            title: 'ERROR',
            showCancelButton: true,
            text: 'Debe de aceptar el acceso a su ubicación para continuar con el pedido'
            })
        }
        else{
            
            this.empresas.forEach(element => {
                element.lat=this.marker.getLatLng().lat,
                element.lng=this.marker.getLatLng().lng,
                element.direccion= (this.direccion=="")?' ':this.direccion
            })


            var that = this
            Swal.fire({
            icon: 'question',
            title: '¿Desea generar el pedido?',
            showCancelButton: true,
            text: 'Aviso'
            }).then((result) => {
              
            if (!result.value)
                return
            that.$refs.modalcito.showModal()             
            axios.post('/front/GeneraPedido', {
                empresas: that.empresas,
                productos: that.productos,
            }).then(function (response) {
                that.$refs.modalcito.hideModal() 
                Swal.fire({
                  text:'Su pedido se ha registrado satisfactoriamente, en unos minutos la empresa se contactará contigo.',
                  icon: 'success',
                  title: 'Éxito',
                }).then(() => {
                  that.$cookies.set('carrito',JSON.stringify([]))
                  location.href="/"
                })

                }).catch(function (response){
                  that.$refs.modalcito.hideModal() 
                    Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Sucedió un problema, intente nuevamente en los próximos minutos'
                    }).then(() => {location.reload()})
                })
            })
        }
      }
    },
    computed:{
      calcularTotal(){

        this.total = 0
        var item
        this.productos.forEach(element => {
              this.total = this.total + (element.precio*element.cant)
        })
        return this.total
      }
    },
    mounted() {
        this.recarga()
        this.load=true
    },
    created: function () {
        EventBus.$on('EliminarenModal', function(boolean)  {
          if(boolean)
           this.recarga()
        }.bind(this))
    }
}
</script>

<style>
    .label{
        font-size: 1em !important;
        color: rgb(122, 122, 122);
    }

    th{
        font-size: 1em !important;
    }

    td{
        font-size: 1em !important;
        color: rgb(122, 122, 122) !important;
    }

