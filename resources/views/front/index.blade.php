@extends('layouts.front')

@section('title')
    TeEnvio - Negocios locales a un click de distancia
@endsection

@section('nav')
    @include('front.nav')
@endsection

@section('styles')
<link rel="shortcut icon" href="/assets/landing_index/images/favicon.png" type="image/png">
    
<!--====== Default CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/default.css">
<!--====== Animate CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/animate.css">
    
<!--====== lineicons CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/lineicons.css">
<link rel="stylesheet" href="/assets/landing_index/css/style.css">
@endsection

@section('contenido')

<div id="home" class="header-hero bg_cover d-lg-flex align-items-center">      
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
    <div class="shape shape-5"></div>
    <div class="shape shape-6"></div>
    
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <div class="col-lg-6 col-md-10">
                <div class="header-hero-content">
                    <h3 class="header-title wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.2s">Negocios locales a <span> un click </span> de <span>Distancia!</span></h3>
                    <p class="text wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.6s">Busca tu restaurant o negocio favorito, o utiliza nuestra moderna plataforma de geolocalización para encontrar el producto que deseas, fácil, rápido y seguro.</p>
                    <div class="row justify-content-around mt-2">
                        <a href="javascript:void(0)" rel="nofollow" class="main-btn wow fadeInLeftBig search-popup-trigger col-9 col-md-4" data-wow-duration="1.3s" data-wow-delay="0.8s"><i class="lni lni-search-alt"></i>  Buscar negocio</a>
                        <a href="/negocios-cercanos" rel="nofollow" class="main-btn secondary-btn wow fadeInLeftBig col-9 col-md-6" data-wow-duration="1.3s" data-wow-delay="0.8s"><i class="lni lni-map-marker"></i> Buscar negocios cercanos</a>
                    </div>
                </div> <!-- header hero content -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-10">
                <div class="header-image">
                    <img src="/assets/landing_index/images/header-app-tenvio.png" alt="app" class="image wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="0.5s">
                    <!-- <div class="image-shape wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="0.8s">
                        <img src="/assets/landing_index/images/image-shape.svg" alt="shape">
                    </div> -->
                </div> <!-- header image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="header-shape-1"></div> <!-- header shape -->
    <div class="header-shape-2">
        <img src="/assets/landing_index/images/header-shape-2.svg" alt="shape">
    </div> <!-- header shape -->
</div> <!-- header hero -->

<!--====== SERVICES PART START ======-->
<section id="why" class="services-area pt-110 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title text-center pb-25">
                    <h3 class="title">Lo que necesitas no, a tu alcance</h3>
                    <p class="text">Estamos asociados con una gran variedad de negocios cercanos a tu localidad, con el objetivo de que encuentres en nuestro sitio lo que estás buscando.</p>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <front-categories-component></front-categories-component>
        
    </div> <!-- container -->
</section>
<!--====== SERVICES PART ENDS ======-->

<!--====== ABOUT PART START ======-->
<section id="about" class="about-area pt-70 pb-120">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-image mt-50 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.5s">
                    <div class="about-shape"></div>
                    <img class="app" src="/assets/landing_index/images/about-app-tenvio.png" alt="app">
                </div> <!-- about image -->
            </div>
            <div class="col-lg-6">
                <div class="about-content mt-50 wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <h3 class="title">Sistema de pedidos en tiempo real</h3>
                        <p class="text">Revisa las actualizaciones de estado de tu pedido, desde tu teléfono móvil o pc, de una manera fácil y sencilla.</p>
                    </div> <!-- section title -->
                    <!-- <a href="https://rebrand.ly/appland-ud" rel="nofollow" class="main-btn">Get Full Version</a> -->
                </div> <!-- about content -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== ABOUT PART ENDS ======-->

<!-- <section id="slider" class="slider slider-layout1">
    <div class="container slide-item align-v-h text-center">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="slide__content ">
                   
                    <h2 class="slide__title  text-dark">Negocios locales a <span class="title__spam">un click</span> de <span class="title__spam">Distancia!</span></h2>
                    <div class="containLine"> <div class="line-low bg1 n600" style="visibility: visible;"></div> </div>
                        <p class="slide__desc"></p>
                    <form action="{{ route('list') }}" method="get"> 
                             
                        <div class="  align-content-center ">                            
                            <input type="text"  name="search" class="form-control text-center mb-1" placeholder="Busca tu negocio favorito">
                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary text-center ">Click aquí</button>
                            </div>
                        </div>
                        <h4>ó</h4>
                    <a href="{{route('negocios_cercanos')}}" class="btn btn__primary  "><i class="fa fa-map-marker-alt fa-2x" aria-hidden="true"></i>Buscar restaurantes o negocios cercanos</a>
                    </form>
                </div>
            </div>

            {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                <img src="/img/pedir.png"  alt="slide img">
            </div> --}}

        </div>
    </div>
    {{-- <div class="bg-img"><img src="/img/pedir5.png"></div> --}}
    {{-- <svg class="slider__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61" viewBox="0 0 22 61">
        <path
            d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
            transform="translate(-789 -769)"></path>
    </svg> --}}
</section> -->
<!-- <section id="blogGrid" class="blog blog-grid  ">
<h3 class=" text-center">Lo que necesitas, a tu alcance</h3>
<front-categories-component></front-categories-component>
</section> -->
@endsection

@section('footer')
  @include('front.components.footer')
@endsection

@section('script')

@endsection
