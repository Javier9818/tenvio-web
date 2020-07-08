<template>
  <section id="shop3Products" class="shop shop-grid shop-grid-3col pb-90">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-9">

          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                  <div class="filtering-options">
                    <div class="filter-option-sorting">
                      <div class="sort-box">
                        <span>Ordenar por:</span>
                        <!-- <b-form-select v-model="categoria" :options="categorias"></b-form-select>                 -->

                        <div class="select-box">
                          <b-form-select v-model="categoria" :options="categorias" class=" d-block" @change="funcAcciona"></b-form-select>
                        </div><!-- /.select-box -->
                      </div><!-- /.sort-box -->
                    </div>
                  </div>


            </div><!-- /.col-lg-12 -->
          </div>

          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 list-view" v-for="(item, key) in productos" :key="key">

              <div class="product__item container-fluid">
                  <div class="row justify-content-center align-items-center">
                      <div class="col-md-5">
                        <img :src="'/storage/imgproductos/'+item.foto" alt="Imágen de producto" class=" img-fluid text-center">
                      </div>
                      <div class="col-md-7 pt-2">
                        <p class="title__product">{{item.nombre}}</p>
                        <hr>
                        <p class="description__product">{{item.descripcion}}</p>
                        <div class="row">
                          <p class="price__product col-5 col-md-12">S/.{{item.precio}}</p>
                          <button type="button" class="btn btn__product" @click="funSelecciona(item)">
                            Comprar
                          </button>
                        </div>
                      </div>
                  </div>
              </div>

            </div>
          </div>

          <div class="row">        
            <div class="col-sm-12 col-md-12 col-lg-3 text-center align-items-center">
            </div>    
            <div class="col-sm-12 col-md-12 col-lg-6 text-center align-items-center">
              <nav class="pagination-area  ">
                <b-pagination size="lg" 
                  v-model="currentPage"
                  :total-rows="rows"
                  :per-page="perPage"
                   @change="funCambia"
                ></b-pagination>
                 
              </nav><!-- /.pagination-area -->
            </div><!-- /.col-lg-12 -->
            <div class="col-sm-12 col-md-12 col-lg-3 text-center align-items-center">
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-3">
          <aside class="sidebar sidebar-layou2">
            <div class="widget widget-search">
              <h5 class="widget__title">Buscar</h5>
              <div class="widget__content">
                <form class="widget__form-search">
                  <input type="text" v-model="buscar" class="form-control" placeholder="escriba nombre del producto">
                  <button class="btn" type="button" @click="funBusqueda"><i class="fa fa-search"></i></button>
                </form>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-search -->
            <div class="widget widget-categories">
              <h5 class="widget__title">Categorias</h5>
              <div class="widget-content">
                <ul class="list-unstyled mb-0">
                  <li v-for="(item, key) in categorias" :key="key"><a style=" cursor:pointer"  @click="funcionProductos(item.value)"> {{item.text}} <span></span></a></li>
                </ul>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-categories -->
           
          </aside><!-- /.sidebar -->
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <b-modal ref="my-modal" hide-footer title="Detalle Producto"  centered  content-class="shadow" style="background-color:#0000009e," >
        <div class="container">
          <div class="row  align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12 align-items-center text-center">
              <div class="row align-items-center">
                <div class="col-12 col-lg-6 col-sm-6 product__single-img text-center">
                  <img :src="'/storage/imgproductos/'+producto.foto" alt="Product" class="zoomin text-center" style="visibility: visible">
                </div>
                <div class="col-12  col-lg-6 col-sm-6">
                  <h4 class="product__title my-2" style="font-size: 1.5em">{{producto.nombre}}</h4>
                  <span class="product__price" style="font-size: 2em">S/. {{producto.precio}}</span>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 align-items-center">
               <hr class="hr-dashed mt-30 mb-30">
              <div class="row align-items-center">
                <div class=" col-12  col-lg-12 col-sm-12">
                  <nav class="nav nav-tabs justify-content-center">
                    <a class="nav__link">Descripción</a>
                    </nav>
                  <div class="product__desc">
                    <p>{{producto.descripcion}}</p>
                  </div>
                </div>
                <div class=" col-12  col-lg-12 col-sm-12 text-center align-items-center">
                  <button class="decrease-qty fas fa-minus-circle text-danger fa-2x" @click="funAdd('-')"></button>
                  <input type="number" readonly  class="qty-input" v-model="producto.cant">
                  <button class="increase-qty fas fa-plus-circle text-success fa-2x" @click="funAdd('+')"></button>
                </div>
                <!-- <div class=" col-12  col-lg-6 col-sm-6 text-center">
                  <button class="btn btn__primary" @click="funAgregar">Agregar</button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      <div class="row">
          <div class="col-6">
          <b-button class="mt-2" variant="primary" block @click="hideModal">Salir</b-button>
        </div>
        <div class="col-6">
          <b-button class="mt-2" variant="success" block @click="funCarrito('c')">Agregar</b-button>
        </div>
        <!-- <div class="col-6">
          <b-button class="mt-2" variant="warning" block @click="funCarrito('x')">Finalizar Pedido</b-button>
        </div> -->
      
      </div>
    </b-modal>
  </section>

</template>

<script>
import EventBus from '../../event-bus'
export default {
  props: ['id','nombre'],
  data()
  {
    return{
      rows: 0,
      perPage: 1,
      currentPage: 0,
      categorias:[{ value: 'all', text: 'Todo' }],
      productos:[],
      carrito:[],
      categoria:'all',
      options: { value: 0, text: '' },
      producto:{descripcion:'',foto:'',nombre:'',precio:'',cant:1, id:0, empresa:0, name_empresa:''},
      bool:false,
      buscar:''
    }
  },
  methods:{
    showModal() {
      this.$refs['my-modal'].show()
    },
    hideModal() {
      this.$refs['my-modal'].hide()
    },
    funAdd: function (key) {
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
    },
    funBusqueda: function (params) {
      this.funcionProductos('all',this.currentPage)
    },
    funCambia: function () {
      setTimeout(() => { 
      this.funcionProductos('all',this.currentPage)
      }, 250)
     
    },
    funSelecciona: function (item) {
      this.producto.descripcion=item.descripcion
      this.producto.foto=item.foto
      this.producto.nombre=item.nombre
      this.producto.precio=item.precio
      this.producto.id=item.id
      this.producto.empresa=this.id
      this.producto.name_empresa=this.nombre
      this.producto.cant=1
      this.showModal()
    },
    
    funCarrito: function (key) {

      switch (key) {
        case 'c':
          if(this.producto.cant>0)
            this.funAddCarrito(this.producto)
          this.hideModal()
          break
        case 'x':
           location.href="/micarrito"
          break
        default:
          break
      }
    },     
    funAddCarrito: function (item) {
      EventBus.$emit('i-got-clicked', item)
    },
    funcAcciona: function () {
      this.funcionProductos(this.categoria,1)
    },
    funcionCategorias:function () {
      var that = this
			axios.post('/front/categorias',{id:that.id})
			.then(function (response) { 
        response.data.forEach(element => {
          that.categorias.push(element)
        })
			})
    },
    funcionProductos:function (item, index) {
      var that = this
			axios.post('/front/productos',{tipo:item, id:that.id, page:index, search:that.buscar})
			.then(function (response) {
        
        that.productos = response.data.data
         
        if(that.bool==false)
        {     
          that.bool=true     
          that.rows= response.data.last_page
        
        }
      
			})
    }
  },
  mounted()
  {
    this.funcionCategorias()
    this.funcionProductos('all',1)
  }
}
</script>

