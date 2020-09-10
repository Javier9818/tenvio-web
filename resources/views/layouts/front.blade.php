<!DOCTYPE html>
<html lang="es">
 
<head>
  <meta charset="UTF-8" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="TE ENVIO - NORTEC">
  <link href="/assets/images/favicon/favicon2.ico"  rel="icon">
  <title>@yield('title')</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Rubik:400,500,700%7cShadows+Into+Light&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://javier9818.github.io/cdn.tenvio/scripts_front/libraries.css" />
  <!-- <link rel="stylesheet" href="assets/css/animate.css" /> -->
  <link rel="stylesheet" href="https://javier9818.github.io/cdn.tenvio/scripts_front/style.css" />
  <link rel="stylesheet" href="https://javier9818.github.io/cdn.tenvio/scripts_front/personalizacion.css"/>
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
  
  {{-- <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
  <!--NOTIFICACIONES PUSHER -->
  <script src="https://javier9818.github.io/cdn.tenvio/scripts_front/push.min.js"></script>
  @yield('styles')
</head>

<body >
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
  <div class="wrapper" id="app">
    <!-- =========================
        Header
    =========================== -->


    @yield('nav')

    @yield('contenido')

    @yield('footer')
   
    <button id="scrollTopBtn"><i class="fa fa-angle-up"></i></button>

    <div class="search-popup">
      <i class="fa fa-times close-search"></i>
      <form class="module__search-form" action="{{ route('list') }}" method="get">
        <input type="text" class="search__input" name="search" placeholder="Escriba algo...">
        <!-- <input type="submit"  class="module__search-btn"> -->
          <!-- <i class="fa fa-search"></i> -->

        <!-- <button class="module__search-btn"><i class="fa fa-search"></i></button> -->
      </form>
    </div><!-- /.search-popup -->

  </div>
  <!-- /.wrapper -->
  <script src="/js/fronted.js"></script>
  <!-- <script src="https://javier9818.github.io/cdn.tenvio/scripts_front/fronted.js" type="text/javascript"></script> -->
  <!-- <script src="/js/app.js" type="text/javascript"></script>                  -->
  <script src="https://javier9818.github.io/cdn.tenvio/scripts_front/jquery-3.3.1.min.js"></script>
  <script src="https://javier9818.github.io/cdn.tenvio/scripts_front/plugins.js"></script>
  <!-- <script src="assets/js/wow.min.js"></script> -->
  <script src="https://javier9818.github.io/cdn.tenvio/scripts_front/main.js"></script>

  @yield('script')
</body>

</html>
