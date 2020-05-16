<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/colors/palette-gradient.css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <style>
        .button{
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
    }
    </style>
    @yield('styles')
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
  </head>
  {{-- vertical-layout vertical-menu 2-columns fixed-navbar pace-done menu-collapsed --}}
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <!-- fixed-top-->
    @yield('nav')

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    @yield('sideNav')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
            @yield('header')
            <div class="content-body" id="app"><!-- Bar charts section start -->
                @yield('content')
            </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2020  &copy; Copyright <a class="text-bold-800 grey darken-2" href="/">Delivery</a></span>

      </div>
    </footer>

    @yield('scripts')
    <script src="/js/app.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    {{-- <script src="/theme-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script> --}}
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    {{-- <script src="/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script> --}}
    {{-- <script src="/theme-assets/js/core/app-lite.js" type="text/javascript"></script> --}}
    <script src="/theme-assets/js/core/app.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/app-menu.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/compact-menu.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/customizer.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/prism.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/switch.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/switchery.min.js.descargar" type="text/javascript"></script>
    <script src="/theme-assets/js/core/jquery.sharrre.js.descargar" type="text/javascript"></script>
    {{-- <script src="/theme-assets/js/core/vendors.min.js.descargar" type="text/javascript"></script> --}}



    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="/theme-assets/js/scripts/charts/chartjs/bar/column.js" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/charts/chartjs/bar/bar.js" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/charts/chartjs/pie-doughnut/pie-simple.js" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/charts/chartjs/pie-doughnut/doughnut-simple.js" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
