@extends('layouts.front')

@section('title')
    Nombre Restaurant
@endsection
@section('nav')
    @include('front.nav')
@endsection
@section('contenido')
<section id="page-title" class="page-title page-title-layout6 text-center bg-overlay bg-overlay-2 bg-parallax">
    <div class="bg-img"><img src="https://i.pinimg.com/originals/12/b1/45/12b145b9a4aad221ead5b87f38d76d03.jpg" alt="background"></div>
    <svg class="pagetitle__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61"
      viewBox="0 0 22 61">
      <path
        d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
        transform="translate(-789 -769)"></path>
    </svg>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <span class="pagetitle__subheading">Restaurant</span>
          <h1 class="pagetitle__heading">Doña Queka</h1>
          <nav aria-label="breadcrumb" >
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item active">Trujillo Peru</li>
            </ol>
          </nav>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

  <!-- ========================
     shop Products
  =========================== -->
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
                    <div class="select-box">
                      <select>
                        <option selected value="1">Parrillas</option>
                        <option value="2">Pollos a la brasa</option>
                      </select>
                    </div><!-- /.select-box -->
                  </div><!-- /.sort-box -->
                  <div class="sort-box d-none">
                    <span>Show:</span>
                    <div class="select-box">
                      <select>
                        <option selected="" value="10">10 items / page</option>
                        <option value="25">25 items / page</option>
                        <option value="50">50 items / page</option>
                        <option value="100">100 items / page</option>
                      </select>
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
            @for ($i = 0; $i < 3; $i++)
                <!-- Product item #1 -->
                <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="product-item">
                    <div class="product__img">
                    <img src="assets/images/shop/grid/1.jpg" alt="Product">
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
                        <a href="#">Light</a>
                        <a href="#">Mexican</a>
                        <a href="#">Organic</a>
                    </div>
                    <h4 class="product__title"><a href="#">1/4 Pollo a la brasa</a></h4>
                    <span class="product__price">S/. 25</span>
                    </div><!-- /.product-content -->
                </div><!-- /.product-item -->
                </div><!-- /.col-lg-4 -->
            @endfor

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
                    @for ($i = 0; $i < 2; $i++)
                       <li><a href="#">Categoria {{$i}} <span></span></a></li>
                    @endfor

                </ul>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-categories -->
            <div class="widget widget-poducts">
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
            <div class="widget widget-filter d-none">
              <h5 class="widget__title">Pricing Filter</h5>
              <div class="widget__content">
                <div id="rangeSlider"></div>
                <div class="price-output">
                  <label for="rangeSliderResult">Price: </label>
                  <input type="text" id="rangeSliderResult" readonly>
                  <a class="btn btn__primary btn__link" href="#">Filter Now</a>
                </div>
              </div><!-- /.widget-content -->
            </div><!-- /.widget-filter -->
          </aside><!-- /.sidebar -->
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.shop Products -->






  <div class="modal fade" id="categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="container">

            <div class="row justify-content-center align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-12 justify-content-center">
                <div class="product__single-img text-center w-50">
                  <img src="assets/images/shop/full/1.jpg" class="zoomin" alt="product" style="visibility: visible;">
                </div><!-- /.product-img -->
              </div><!-- /.col-lg-6 -->
              <div class="col-sm-12 col-md-12 col-lg-12 justify-content-center">
                <h4 class="product__title">1/4 Pollo a la brasa</h4>
                <span class="product__price">S/. 18.00</span>
                <hr class="hr-dashed mt-30 mb-30">
                <nav class="nav nav-tabs justify-content-center">
                  <a class="nav__link">Description</a>
                   {{--  <a class="nav__link" data-toggle="tab" href="#Details">Additional Information</a>
                   <a class="nav__link" data-toggle="tab" href="#Reviews">Reviews (0)</a> --}}
                 </nav>
                <div class="product__desc">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et voluptatum magni illum quos dolorem nam nisi animi amet eos quas natus, ea aliquam sequi, similique commodi iure, quo veritatis consequatur.</p>
                </div><!-- /.product-desc -->
                <form class="product__form-wrap mb-30">
                  <div class="product__quantity d-flex">
                    <div class="quantity__input-wrap mr-20">
                      <i class="decrease-qty fas fa-minus-circle"></i>
                      <input type="number" value="1" class="qty-input">
                      <i class="increase-qty fas fa-plus-circle"></i>
                    </div>
                    <button class="btn btn__primary">Agregar</button>
                  </div><!-- /.product-quantity -->
                </form>

              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

          </div><!-- /.container -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Seguir Comprando</button>
          <button type="button" class="btn btn-primary">Finalizar Pedido</button>
        </div>
      </div>
    </div>
  </div>
@endsection
