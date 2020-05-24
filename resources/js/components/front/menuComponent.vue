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
                  <img :src="'/img/productos/'+item.foto" alt="Product" class=" img-fluid text-center">
                  <div class="product__hover">
                    <div class="product__action">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoria">
                        Comprar
                      </button>
                      <a href="#" class="btn btn__primary btn__hover2 d-none">Comprar</a>
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
            <!-- <div class="widget widget-filter d-none">
              <h5 class="widget__title">Pricing Filter</h5>
              <div class="widget__content">
                <div id="rangeSlider"></div>
                <div class="price-output">
                  <label for="rangeSliderResult">Price: </label>
                  <input type="text" id="rangeSliderResult" readonly>
                  <a class="btn btn__primary btn__link" href="#">Filter Now</a>
                </div>
              </div>
            </div> -->
          </aside><!-- /.sidebar -->
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
</template>

<script>
export default {
  props: ['id'],
  data()
  {
    return{
      categorias:[],
      productos:[],
      categoria:'',
      options: { value: 0, text: '' },
           
    }
  },
  methods:{
    funcAcciona: function () {
      console.log(this.categoria);
      this.funcionProductos(this.categoria);
    },
    funcionCategorias:function () {
      var that = this;
			axios.post('/front/categorias',{id:that.id})
			.then(function (response) {
        console.log(response.data);
         that.categorias=[];
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

