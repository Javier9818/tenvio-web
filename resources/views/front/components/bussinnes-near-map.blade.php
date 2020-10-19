@extends('layouts.front')
@section('title')
    TeEnvio - Negocios cercanos
@endsection

@section('nav')
    @include('front.nav')
@endsection

@section('styles')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAeTM7b0MYnEP8-Ax6GmvD6jV3xgpMac60"></script>
<link rel="shortcut icon" href="/assets/landing_index/images/favicon.png" type="image/png">
    
<!--====== Default CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/default.css">
<!--====== Animate CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/animate.css">
    
<!--====== lineicons CSS ======-->
<link rel="stylesheet" href="/assets/landing_index/css/lineicons.css">
<link rel="stylesheet" href="/assets/landing_index/css/style.css">
<style>
    h4{
      color: white !important;
      font-weight: 0 !important;
    }
    .modal-title{
      color: grey !important;
    }
    .link__back{
      color: white !important;
    }
      .contenedor {
        width: 90px;
        height: 240px;
        position: absolute;
        right: 0px;
        bottom: 0px;
      }

      .botonF2 {
        z-index:1000;
        cursor: pointer;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        background: #f79723;
        right: 0;
        bottom: 80px;
        position: absolute;
        margin-right: 16px;
        margin-bottom: 16px;
        border: none;
        outline: none;
        color: #FFF;
        font-size: 36px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: 0.3s;
      }

      .botonF1 {
        z-index:1000;
        cursor: pointer;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        background: #F44336;
        right: 0;
        bottom: 0;
        position: absolute;
        margin-right: 16px;
        margin-bottom: 16px;
        border: none;
        outline: none;
        color: #FFF;
        font-size: 36px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: 0.3s;
      }
      .filter-text{
        color: grey;
      }
      /* PERSONALIZACIÓN DEL POPUP*/
      .leaflet-popup-content-wrapper, .leaflet-popup-tip{
        background: #242742;
        color: white;
      }
      .leaflet-container a.leaflet-popup-close-button {
        color: white !important;
        font-size: 1.8em !important;
        margin-top: 2px !important;
        margin-right: 10px !important;
      }

      .title-popup{
        text-align:center;
      }
      .content-popup{
        font-size: .7em !important;
      }
      .subtitle-popup{
        font-weight: bold;
      }
      .hr-popup{
        color:white;
        background:white;
      }
      .link-popup{
        color: #f5e41b !important;
      }
      .link-whatsapp{
        color: #25D366 !important;
      }
      .link-phone{
        color: #007bff !important;
      }
      /* !PERSONALIZACIÓN DEL POPUP*/

      .row-search{
        top: 130px;
        position: fixed;
        z-index: 500;
        width: 100vw;
      }
      .btn-filter{
        background: #feb21c;
        color: white;
      }

      .btn-filter:hover{
        transform: scale(1.1);
        color: white;
      }

      .header{
        position: initial;
      }

      .navbar{
        z-index: 1000;
        -webkit-box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        -moz-box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        padding: 0px 1.3rem;
      }

      input, .btn{
        -webkit-box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        -moz-box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        box-shadow: 0px 6px 12px 2px rgba(140,140,140,1);
        font-size:1.2em !important;
      }

      
      .modal.left .modal-dialog,
      .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
                transform: translate3d(0%, 0, 0);
      }

      .modal.left .modal-content,
      .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
      }
      
      .modal.left .modal-body,
      .modal.right .modal-body {
        padding: 15px 15px 80px;
      }

      /*Left*/
        .modal.left.fade .modal-dialog{
          animation-duration: .3s;
          animation-name: slidein;
        }
        
        .modal.left.fade.in .modal-dialog{
          left: 0;
        }

        @keyframes slidein {
        from {
          left: -320px;
          -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
          -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
          -o-transition: opacity 0.3s linear, left 0.3s ease-out;
          transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        to {
        left: 0;
        }
      }

      .modal-content{
        border-radius: 0 !important;
      }
</style>
@endsection

@section('contenido')
<search-bussiness-near tiponegocios="{{$tiponegocios}}" categorias="{{$categorias}}"></search-bussiness-near>
@endsection
