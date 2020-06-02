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
<section id="page-title" class="page-title page-title-layout7">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <h1  >Tus pedidos</h1>
        </div><!-- /.col-lg-6 -->         
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

  <!-- =========================
              Shopping Cart
      =========================== -->
  <section id="ShoppinCcart" class="shop shopping-cart pb-50">
    <div class="container">      
        <front-pedidos-component></front-pedidos-component>
      <!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.shopping-cart -->
@endsection
