@extends('layouts.front')

@section('title')
    Detalle de pago
@endsection

@section('nav')
   @include('front.nav')
@endsection

@section('contenido')
<section id="ShoppinCcart" class="shop shopping-cart pb-50">
  <div class="container">      
    <detail-pago data="{{$id}}"></detail-pago>
    <!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.shopping-cart -->
 
@endsection

 