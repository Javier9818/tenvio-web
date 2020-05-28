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

                    </div><!-- /.filter-option-sorting -->
                    <div class="filter-option-view">
                      <span>Ver Como:</span>
                      <a id="gridView" class="active" href="#"><i class="fa fa-th-large"></i></a>
                      <a id="listView" href="#"><i class="fa fa-th-list"></i></a>
                    </div><!-- /.filter-option-view -->
                  </div><!-- /.filtering-options -->


            </div><!-- /.col-lg-12 -->
          </div><!-- /.row -->
          <div class="row">
            <!--For-->

            <div class="col-sm-6 col-md-6 col-lg-4" v-for="(item, key) in productos" :key="key">
              <div class="product-item">
                <div class="product__img align-items-center">
                  <img :src="'/storage/imgproductos/'+item.foto" :alt="'/storage/imgproductos/'+item.foto" class=" img-fluid text-center">
                  <div class="product__hover">
                    <div class="product__action">
                      <button type="button" class="btn btn-primary" @click="funSelecciona(item)">
                        Comprar
                      </button>
                      <a href="#" class="btn btn__primary btn__hover2 d-none" >Comprar</a>
                    </div><!-- /.product__action -->
                  </div><!-- /.product__hover-->
                </div><!-- /.product-img -->
                <div class="product__content">
                  <div class="product__cat">
                    <a href="#">{{item.descripcion}}</a>
                  </div>
                  <h4 class="product__title"><a href="#">{{item.nombre}}</a></h4>
                  <span class="product__price">S/. {{item.precio}}</span>
                </div><!-- /.product-content -->
              </div><!-- /.product-item -->
            </div><!-- /.col-lg-4 -->
            <!--For-->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
              <nav class="pagination-area">
                <ul class="pagination justify-content-center">
                  <li><a class="current" href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
              </nav><!-- /.pagination-area -->
            </div><!-- /.col-lg-12 -->
          </div><!-- /.row -->
        </div><!-- /.col-lg-9 -->
        <div class="col-sm-12 col-md-12 col-lg-3">
          <aside class="sidebar sidebar-layou2">
            <div class="widget widget-search">
              <h5 class="widget__title">Buscar</h5>
              <div class="widget__content">
                <form class="widget__form-search">
                  <input type="text" class="form-control" placeholder="escriba nombre del producto">
                  <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-search -->
            <div class="widget widget-categories">
              <h5 class="widget__title">Categorias</h5>
              <div class="widget-content">
                <ul class="list-unstyled mb-0">
                  <li v-for="(item, key) in categorias" :key="key"><a href="#">{{item.text}} <span></span></a></li>
                </ul>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-categories -->
            <div class="widget widget-poducts d-none">
              <h5 class="widget__title">Productos+ Comprados</h5>
              <div class="widget__content">
                <!-- product item #1 -->
                <div class="widget-product-item">
                  <div class="widget__product-img">
                    <a href="#"><img src="assets/images/shop/grid/2.jpg" alt="product"></a>
                  </div><!-- /.product-product-img -->
                  <div class="widget__product-content">
                    <h6 class="widget__product-title"><a href="#">1 Pollo entero </a></h6>
                    <span class="widget__product-price">S/. 45.00</span>
                  </div><!-- /.widget-product-content -->
                </div><!-- /.widget-product-item -->
              </div><!-- /.widget-content -->
            </div><!-- /.widget-poducts -->

          </aside><!-- /.sidebar -->
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <b-modal ref="my-modal" hide-footer :title="producto.nombre">
        <div class="container">
          <div class="row  align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12 align-items-center text-center">
              <div class="row align-items-center">
                <div class="col-12 col-lg-6 col-sm-6 product__single-img text-center">
                  <img :src="'/storage/imgproductos/'+producto.foto" alt="Product" class="zoomin text-center" style="visibility: visible;">
                </div>
                <div class="col-12  col-lg-6 col-sm-6">
                  <h4 class="product__title">{{producto.nombre}}</h4>
                  <span class="product__price">S/. {{producto.precio}}</span>
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
                  <input type="number"   class="qty-input" v-model="producto.cant">
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
        <div class="col-12">
          <b-button class="mt-3" variant="success" block @click="funCarrito('c')">Agregar</b-button>
        </div>
        <div class="col-6">
          <b-button class="mt-2" variant="warning" block @click="funCarrito('x')">Finalizar Pedido</b-button>
        </div>
        <div class="col-6">
          <b-button class="mt-2" variant="primary" block @click="hideModal">Salir</b-button>
        </div>
      </div>
    </b-modal>
  </section>

</template>

<script>
import EventBus from '../../event-bus';
export default {
  props: ['id','nombre'],
  data()
  {
    return{
      categorias:[{ value: 'all', text: 'Todo' }],
      productos:[],
      carrito:[],
      categoria:'all',
      options: { value: 0, text: '' },
      producto:{descripcion:'',foto:'',nombre:'',precio:'',cant:0, id:0, empresa:0, name_empresa:''}
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
    },
    funSelecciona: function (item) {
      this.producto.descripcion=item.descripcion
      this.producto.foto=item.foto
      this.producto.nombre=item.nombre
      this.producto.precio=item.precio
      this.producto.id=item.id
      this.producto.empresa=this.id
      this.producto.name_empresa=this.nombre
      this.producto.cant=0;
      this.showModal();
    },
    funAgregar: function () {
      console.log(this.producto);
    },
    funCarrito: function (key) {

      switch (key) {
        case 'c':
          if(this.producto.cant!=0)
            this.funAddCarrito(this.producto);
          this.hideModal();
          break;
        case 'x':
           location.href="/cart";
          break;
        default:
          break;
      }
    },
    funAddCarrito: function (item) {
      EventBus.$emit('i-got-clicked', this.producto);
    },
    funcAcciona: function () {
      this.funcionProductos(this.categoria);
    },
    funcionCategorias:function () {
      var that = this;
			axios.post('/front/categorias',{id:that.id})
			.then(function (response) {
        console.log(response.data);
        // that.categorias=[];
        response.data.forEach(element => {
          that.categorias.push(element);
        });
			});
    },
    funcionProductos:function (item) {
      var that = this;
			axios.post('/front/productos',{tipo:item, id:that.id})
			.then(function (response) {
        console.log(response.data);
        that.productos = response.data;
			});
    }
  },
  mounted()
  {
    this.funcionCategorias();
    this.funcionProductos('all');
  }
}
</script>

