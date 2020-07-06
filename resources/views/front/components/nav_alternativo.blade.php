<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Tenvio - Negocios cercanos</title>
    <style>
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
        top: 90px;
        position: fixed;
        z-index: 1000;
        width: 100vw;
      }
      .btn-filter{
        background: #f79723;
        color: white;
      }

      .btn-filter:hover{
        transform: scale(1.1);
        color: white;
      }

      .navbar{
        background: #f79723;
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
</head>
<body>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<div id="app" class="">
  <nav class="navbar navbar-ligth bg-ligth">
    <img class="navbar-brand" src="/assets/images/logo/logo-white.png" alt="logo" width="100px">
    <!-- <a class="navbar-brand">Navbar</a> -->
  </nav>
  
  <search-bussiness-near tiponegocios="{{$tiponegocios}}" categorias="{{$categorias}}"></search-bussiness-near>

</div>

<script src="/js/fronted.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>