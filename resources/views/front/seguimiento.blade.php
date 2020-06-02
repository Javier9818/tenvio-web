@extends('layouts.front')

@section('title')
    Compra
@endsection

@section('nav')
   @include('front.nav')
@endsection



@section('contenido')
 
<section id="page-title" class="page-title page-title-layout6 text-center bg-overlay bg-overlay-2 bg-parallax  "  >
  <div class="bg-img"><img src="https://images.hdqwalls.com/wallpapers/delivery-boy-4k-6z.jpg" alt="background" ></div>
  
     
  </svg> 
</section>
  
<section id="ShoppinCcart" class="shop shopping-cart pb-50">
  <div class="container">      
      <front-seguimiento-component data="{{$data->id}}"></front-seguimiento-component>
    <!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.shopping-cart -->
@endsection
