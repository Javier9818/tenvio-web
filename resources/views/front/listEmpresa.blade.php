@extends('layouts.front')

@section('title')
    Lista de Restaurants
@endsection

@section('nav')
   @include('front.nav')
@endsection

@section('contenido')
<!-- <section id="page-title" class="page-title page-title-layout6 text-center bg-overlay bg-overlay-2 bg-parallax">
  <div class="bg-img"><img src="https://images.hdqwalls.com/wallpapers/delivery-boy-4k-6z.jpg" alt="background"></div>
  <svg class="pagetitle__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61"
    viewBox="0 0 22 61">
    <path
      d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
      transform="translate(-789 -769)"></path>
  </svg>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <span class="pagetitle__subheading"> text </span>
        <h1 class="pagetitle__heading">xyz</h1>
        <nav aria-label="breadcrumb" >
          <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item active">Trujillo Peru</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section> -->


<section id="blogGrid" class="blog blog-grid pb-60">
@if($empresas!==null)
<div class="bg-img"><img src="{!! asset('assets/images/backgrounds/wave2.svg') !!}"  alt="slide img"></div>
@endif
  

    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
          <div class="heading text-center mb-50">
          @if($empresas!==null)
          <span class="heading__subtitle">Restaurantes, Reposteria, Bodegas y más</span>
          <h2 class="heading__title text-white">Resultados de {{$search}}</h2>
            <div class="heading__icon">
                <img style="width:40px" src="{!! asset('assets/images/logo/heading_icon.svg') !!}">

            </div>
          @endif
           
            

          </div><!-- /.heading -->

        </div><!-- /.col-lg-6 -->
        <div class="col-sm-12 col-md-12 col-lg-12   text-center">
         @if($empresas===null)
            <!-- <div class="alert alert-primary text-center" role="alert">
              <h3  >No encontrado, click <a href="/" style=" border-bottom: solid blue 0.2px">aquí</a> para regresar a inicio </h3>
            </div> -->
            <img src="{!! asset('assets/images/backgrounds/result_no_encontrado.png') !!}" alt="" class=" img-fluid text-center">
          @else 
          <div class="row ">
          <!-- Post Item #1 -->
          
            @foreach ($empresas as $empresa)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
              <div class="card  " style=" background-color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                border: 2px solid #ddd;
                border-radius: 10px;
                transition: .5s;
                box-shadow: 0 0 25px 5px rgba(0,0,0,.2);">
                <div class="card-body">
                  <div class="post-item">
                    <div class="post__img">
                      <a href="#">
                      <img src="/storage/images/perfilEmpresa/{{$empresa->foto}}" width="450px" height="250px" alt="post image">
                      </a>
                    </div><!-- /.post__img -->
                    <div class="post__content">
                      <div class="post__meta">
                        <div class="post__meta-cat">
                          <a href="#">{{$empresa->tipo_negocio}}</a>
                        </div><!-- /.post-meta-cat -->
                      </div><!-- /.post-meta -->
                    </div>
                  </div>
                  <h3 class="card-title text-capitalize">{{strtolower($empresa->nombre)}}</h3>
                  <p class="card-text" style="color:black">{{$empresa->descripcion}}</p>
                  <a href="{{url('/empresa/'.str_replace(' ','-',$empresa->nombre_unico))}}" class="btn btn-primary   d-block " style=" font-size:large" onclick="clickComponent('empresa/{{$empresa->nombre_unico}}')">Visitar</a>
                </div>
              </div>
            </div>

            @endforeach
          
          </div><!-- /.row -->
          @endif
        </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.blog Grid -->
@endsection
