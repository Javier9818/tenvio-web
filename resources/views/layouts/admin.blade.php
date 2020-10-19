<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="TE ENVIO - NORTEC">
    <link href="assets/images/favicon/favicon2.ico"  rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="TenvioPeru, plataforma de administración digital de negocios.">
    <meta name="keywords" content="teenvio, tenvioperu, delivery, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="nortec">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="/theme-assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" href="/theme-assets/css/plugins/forms/switch.css">
    <link rel="apple-touch-icon" href="/theme-assets/css/plugins/forms/checkboxes-radios.css">
    <link rel="shortcut icon" type="image/x-icon" href="/theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/vendors.css">
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/app-lite.css">
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/personalizacion.css">
    
    <!-- BEGIN LEAFLET CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
    <!-- BEGIN LEAFLET JS-->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <!-- BEGIN PUSH JS-->
    <script src="{!! asset('notify/push.min.js') !!}"></script>

  <style>
      .contenedor{
          width:90px;
          height:240px;
          display:scroll;
          position:fixed;
          bottom:10px;
          right:10px;
      }

      .contenedor2{
          width:90px;
          height:240px;
          display:scroll;
          position:fixed;
          bottom:80px;
          right:10px;
          cursor:pointer !important;
      }
      .botonF1{
          cursor:pointer;
          width:60px;
          height:60px;
          border-radius:100%;
          background:#F44336;
          right:0;
          bottom:0;
          position:absolute;
          margin-right:16px;
          margin-bottom:16px;
          border:none;
          outline:none;
          color:#FFF;
          font-size:36px;
          box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
          transition:.3s;
      }
  </style>

    @yield('styles')
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
    <div id="app">
        @include('admin.components.nav')
        @yield('nav')
        @yield('sideNav')
        <div class="app-content content" >
          <div class="content-wrapper">
              <div class="content-wrapper-before"></div>
              @yield('header')
              <div class="content-body">
                    @yield('content')
              </div>
          </div>
        </div>
       
    </div>
    
    
    <script>
        let company = @json(Session::get('empresa'));
    </script>


    @yield('scripts')
    <script src="/js/app.js" type="text/javascript"></script>

    <!-- BEGIN VENDOR JS-->
    <script src="/theme-assets/js/core/vendors.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/switchery.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>

    <script src="/theme-assets/js/core/app.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/app-menu.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/compact-menu.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/customizer.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/prism.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/jquery.sharrre.js.descargar" type="text/javascript"></script>
    
    <script>
        function entregaPedido(id){
            if(confirm('¿Está seguro de entregar el pedido?')){
                axios.post('/api/entregaPedido', {idpedido: id}).then((data) => {
                    alert('El pedido se entregó con éxito')
                    location.reload();
                }).catch(()=>{alert('Ha ocurrido un error')});
            }
        }
    </script>

  </body>
</html>
