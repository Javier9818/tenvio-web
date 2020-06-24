@extends('layouts.front')

@section('title')
    TeEnvio - Negocios locales a un click de distancia
@endsection

@section('nav')
    @include('front.nav')
@endsection

@section('contenido')
<section id="slider" class="slider slider-layout1">
    <div class="container slide-item align-v-h text-center">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="slide__content">
                    <!-- <span class="slide__subtitle d-none">Text</span> -->
                    <h2 class="slide__title  text-dark">Negocios locales a <span class="title__spam">un click</span> de <span class="title__spam">Distancia!</span></h2>
                    <div class="containLine"> <div class="line-low bg1 n600" style="visibility: visible;"></div> </div>
                    <p class="slide__desc"></p>
                    <form action="{{ route('list') }}" method="get">
                    <input type="text"  name="search" class="input__search" placeholder="Busca tu ciudad o restaurant favorito">
                    <button type="submit" class="btn btn__primary my-5"><i class="fa fa-map-marker-alt fa-2x" aria-hidden="true"></i>Buscar restaurantes o negocios cercanos</button>
                    </form>
                </div><!-- /.slide-content -->
            </div><!-- /.col-lg-12 -->

            {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                <img src="/img/pedir.png"  alt="slide img">
            </div> --}}

        </div><!-- /.row -->
    </div><!-- /.container -->
    {{-- <div class="bg-img"><img src="/img/pedir5.png"></div> --}}
    {{-- <svg class="slider__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61" viewBox="0 0 22 61">
        <path
            d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
            transform="translate(-789 -769)"></path>
    </svg> --}}
</section><!-- /.slider -->
<section id="blogGrid" class="blog blog-grid pb-60">
  <div class="container">


    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="menu-wrapper">
            <nav class="nav nav-tabs justify-content-center">
              <a class="nav__link active" data-toggle="tab" href="#tab1">Todo</a>
              <a class="nav__link" data-toggle="tab" href="#tab2">Restaurantes</a>
              <a class="nav__link" data-toggle="tab" href="#tab3">Reposteria</a>
              <a class="nav__link" data-toggle="tab" href="#tab4">Bodegas</a>
              <a class="nav__link" data-toggle="tab" href="#tab5">Tienda de Ropa</a>
              <a class="nav__link" data-toggle="tab" href="#tab6">Tienda de Electrónica</a>
              <a class="nav__link" data-toggle="tab" href="#tab7">Tienda de Accesorios</a>
              <a class="nav__link" data-toggle="tab" href="#tab8">Libreria</a>
            </nav>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tab1">
                <div class="row">
                    @foreach ($data as $categoria)
                    <div class="col-md-4 d-flex justify-content-around" style="cursor: pointer" onclick="redirect('{{$categoria->categoria}}')">
                            <div class="card d-flex align-items-center p-5 my-3" style="width: 18rem; width: 250px;
                                height: 250px;
                                background-color: #fff;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                flex-direction: column;
                                border: 2px solid #ddd;
                                border-radius: 10px;
                                transition: .5s;
                                box-shadow: 0 0 25px 5px rgba(0,0,0,.2)">
                                {{-- <img src="..." class="card-img-top" alt="..."> --}}

                                <h5 class="card-title" style="background: linear-gradient(#fe4b7d, #ff8a4d);
                                    background-clip: border-box;
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;"><i class="fas fa-utensils fa-2x"></i></h5>
                                <p class="card-text text-center" style="font-family: 'Nunito', sans-serif;
                                font-size: 24px;

                                font-size: 1.2em;
                                color: #656064;
                                font-weight: bold;">{{ucfirst($categoria->categoria)}}</p>
                                 {{-- <a href="/list/" class="btn btn-primary "  >Ver</a> --}}

                            </div>
                        </div>
                    @endforeach

                </div><!-- /.row  -->
              </div><!-- /.tab  -->
              <div class="tab-pane fade" id="tab2">
                <div class="row">
                  texto 02
                </div><!-- /.row  -->
              </div><!-- /.tab  -->
              <div class="tab-pane fade" id="tab3">
                <div class="row">
                  texto 03
                </div><!-- /.row  -->
              </div><!-- /.tab  -->
              <div class="tab-pane fade" id="tab4">
                <div class="row">
                  texto 04
                </div><!-- /.row  -->
              </div><!-- /.tab  -->
            </div><!-- /.tab-content  -->
          </div><!-- /.menu-wrapper  -->
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->


    <div class="row d-none">
    @foreach ($data as $categoria)
    <div class="col-md-4 d-flex justify-content-around" style="cursor: pointer" onclick="redirect('{{$categoria->categoria}}')">
            <div class="card d-flex align-items-center p-5 my-3" style="width: 18rem; width: 250px;
                height: 250px;
                background-color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                border: 2px solid #ddd;
                border-radius: 10px;
                transition: .5s;
                box-shadow: 0 0 25px 5px rgba(0,0,0,.2)">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}

                <h5 class="card-title" style="background: linear-gradient(#fe4b7d, #ff8a4d);
                    background-clip: border-box;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;"><i class="fas fa-utensils fa-2x"></i></h5>
                <p class="card-text text-center" style="font-family: 'Nunito', sans-serif;
                font-size: 24px;

                font-size: 1.2em;
                color: #656064;
                font-weight: bold;">{{ucfirst($categoria->categoria)}}</p>
                 {{-- <a href="/list/" class="btn btn-primary "  >Ver</a> --}}

            </div>
        </div>
    @endforeach
    </div>


  </div><!-- /.container -->
</section><!-- /.blog Grid -->
@endsection

@section('script')

@endsection
