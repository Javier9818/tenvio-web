@extends('layouts.front')

@section('title')
    Index WebDelivery
@endsection

@section('nav')
    @include('front.nav')
@endsection

@section('contenido')
<section id="slider" class="slider slider-layout1">
    <div class="carousel owl-carousel carousel-arrows" data-slide="1" data-slide-md="1" data-slide-sm="1"
      data-autoplay="true" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="3000"
      data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
      <div class="slide-item align-v-h text-center bg-overlay">
        <div class="bg-img"><img src="http://7oroof.com/demos/babette/assets/images/backgrounds/8.jpg" alt="slide img"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="slide__content">
                <span class="slide__subtitle d-none">Text</span>
                <h2 class="slide__title text-uppercase">Busca la ciudad o nombre del restaurant</h2>
                <p class="slide__desc"><input type="text"></p>
                <a href="#" class="btn btn__white btn__bordered my-1">Buscar restaurantes cercanos a mi posición</a>
              </div><!-- /.slide-content -->
            </div><!-- /.col-lg-12 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.slide-item -->
      <div class="slide-item align-v-h text-center bg-overlay bg-overlay-2">
          <div class="bg-img"><img src="http://7oroof.com/demos/babette/assets/images/backgrounds/2.jpg" alt="slide img"></div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="slide__content">
                  <span class="slide__subtitle d-none">Fresh Ingredient, Tasty Meals</span>
                  <h2 class="slide__title text-uppercase">todo en un solo lugar </h2>
                  <p class="slide__desc">Somos una plataforma virtual, brindando servicio delivery</p>
                  {{-- <a href="reservation.html" class="btn btn__primary mx-2 my-1">Boton 01</a>
                  <a href="menu-classic.html" class="btn btn__white mx-2 my-1">Boton 02</a> --}}
                </div><!-- /.slide-content -->
              </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
    </div><!-- /.carousel -->
    <svg class="slider__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61" viewBox="0 0 22 61">
      <path
        d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
        transform="translate(-789 -769)"></path>
    </svg>
  </section><!-- /.slider -->s
@endsection
