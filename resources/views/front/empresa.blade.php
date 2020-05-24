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
          <h1 class="pagetitle__heading">{{$data[0]->nombre}}</h1>
          <nav aria-label="breadcrumb" >
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item active">{{$data[0]->distrito}} - {{$data[0]->ciudad}}</li>
            </ol>
          </nav>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title --> 
  <!-- ========================
     shop Products
  =========================== -->
  <div id="app">
    <front-menu-component id="{{$data[0]->id}}"></front-menu-component>
  </div>
  
  <!-- /.shop Products -->
 
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
