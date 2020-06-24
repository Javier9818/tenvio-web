<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="TE ENVIO - NORTEC">
  <link href="assets/images/favicon/favicon.png" rel="icon">
  <title>@yield('title')</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Rubik:400,500,700%7cShadows+Into+Light&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('assets/css/libraries.css') !!}" />
  <!-- <link rel="stylesheet" href="assets/css/animate.css" /> -->
  <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}" />
  <link rel="stylesheet" href="{!! asset('theme-assets/css/personalizacion.css') !!}" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  {{-- <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css">
  <!--NOTIFICACIONES PUSHER -->
  <script src="{!! asset('notify/push.min.js') !!}"></script>
  @yield('styles')
</head>

<body >
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <div class="wrapper" id="app">
    <!-- =========================
        Header
    =========================== -->


    @yield('nav')

    @yield('contenido')


    <footer id="footer" class="footer footer-layout1 text-center bg-dark">
      <div class="footer-inner">
        <div class="container">
          <div class="footer-top">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 position-static">
                <svg class="footer__divider-shape" xmlns="http://www.w3.org/2000/svg" width="22" height="61"
                  viewBox="0 0 22 61">
                  <path
                    d="M799,769h2v61h-2V769Zm8,24.8a0.969,0.969,0,0,0-1.911,0,3.012,3.012,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.486,4.486,0,0,0,0,6.136,3.088,3.088,0,0,1,0,4.325,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.091,3.091,0,0,1,0-4.328,4.491,4.491,0,0,0,0-6.14,3.08,3.08,0,0,1,0-4.319,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.407,4.407,0,0,0,807,793.8Zm0-20a0.969,0.969,0,0,0-1.911,0,3.014,3.014,0,0,1-.883,2.16,4.486,4.486,0,0,0,0,6.136,3.083,3.083,0,0,1,0,4.32,4.488,4.488,0,0,0,0,6.137,3.087,3.087,0,0,1,0,4.324,4.5,4.5,0,0,0,0,6.142,3.014,3.014,0,0,1,.884,2.163,0.969,0.969,0,0,0,1.911,0,4.414,4.414,0,0,0-1.213-3.07,3.089,3.089,0,0,1,0-4.327,4.491,4.491,0,0,0,0-6.14,3.081,3.081,0,0,1,0-4.32,4.488,4.488,0,0,0,0-6.137,3.081,3.081,0,0,1,0-4.32A4.409,4.409,0,0,0,807,773.8ZM793,793.8a0.969,0.969,0,0,1,1.911,0,3.012,3.012,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.486,4.486,0,0,1,0,6.136,3.088,3.088,0,0,0,0,4.325,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.091,3.091,0,0,0,0-4.328,4.491,4.491,0,0,1,0-6.14,3.08,3.08,0,0,0,0-4.319,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.407,4.407,0,0,1,793,793.8Zm0-20a0.969,0.969,0,0,1,1.911,0,3.014,3.014,0,0,0,.883,2.16,4.486,4.486,0,0,1,0,6.136,3.083,3.083,0,0,0,0,4.32,4.488,4.488,0,0,1,0,6.137,3.087,3.087,0,0,0,0,4.324,4.5,4.5,0,0,1,0,6.142,3.014,3.014,0,0,0-.884,2.163,0.969,0.969,0,0,1-1.911,0,4.414,4.414,0,0,1,1.213-3.07,3.089,3.089,0,0,0,0-4.327,4.491,4.491,0,0,1,0-6.14,3.081,3.081,0,0,0,0-4.32,4.488,4.488,0,0,1,0-6.137,3.081,3.081,0,0,0,0-4.32A4.409,4.409,0,0,1,793,773.8Zm-4,5.2h2v41h-2V779Zm20,0h2v41h-2V779Z"
                    transform="translate(-789 -769)"></path>
                </svg>
              </div><!-- /.col-lg-12 -->
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="contact-box">
                  <h6 class="contact__box-title">Nosotros</h6>
                  <ul class="contact__box-list list-unstyled">
                    <li>TE ENVIO tu mejor aliado, te brindamos las herramientas que necesitas para incrementar tus ventas y gestiones mejor tu negocio.</li>
                  </ul>
                </div><!-- /.contact-box -->
              </div><!-- /.col-lg-4 -->
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="contact-box">
                  <h6 class="contact__box-title">Servicio las 24h</h6>
                  <ul class="contact__box-list list-unstyled">
                    <li>Mon - Fri: 10 AM - 11 PM</li>
                    <li>Sat - Sun: 9 AM - 1 PM</li>
                  </ul>
                </div><!-- /.contact-box -->
              </div><!-- /.col-lg-4 -->
              <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="contact-box">
                  <h6 class="contact__box-title">Contactanos</h6>
                  <ul class="contact__box-list list-unstyled">
                    <li><span>Main Email:</span><a href="mailto:Babette@7oroof.com">Babette@7oroof.com</a></li>
                    <li><span>Phone:</span><a href="tel:020101236547">02 0101236547</a></li>
                  </ul>
                </div><!-- /.contact-box -->
              </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
          </div><!-- /.footer-top -->
          <div class="footer-middle">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 position-static">
                <div class="footer__logo-wrap text-center">
                <img src="{!! asset('assets/images/logo/footer-logo2.png') !!}" alt="logo" class="footer__logo">
                </div>
              </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <p class="mb-20">NORTEC es un grupo tecnológico, cuya actividad principal es el desarrollo y gestión de una plataforma tecnológica mediante la que a través de una página web o aplicación móvil permite a determinados restaurantes de La Libertad publicitar sus productos a través del aplicativo
                </p>

              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
          </div><!-- /.footer-middle -->
        </div><!-- /.container -->
        <div class="footer-bottom">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="footer__copyright mb-30">
                  <span>&copy; Plataforma Virtual creada por </span>
                  <a href="#" class="color-theme">Nortec</a>
                </div>
                <ul class="social__icons social__icons-white justify-content-center">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                </ul><!-- /.social__icons -->
              </div>
            </div><!-- /.row -->
          </div><!-- /.container -->
          <svg class="footer__divider-shape-bottom" xmlns="http://www.w3.org/2000/svg" width="142" height="17"
            viewBox="0 0 142 17">
            <path
              d="M800,600V583c8.782,15.985,46.811,11.315,56,12a35.721,35.721,0,0,1,15,5m-71,0V583c-8.782,15.985-46.811,11.315-56,12a35.717,35.717,0,0,0-15,5"
              transform="translate(-729 -583)"></path>
          </svg>
        </div><!-- /.Footer-bottom -->
      </div><!-- /.Footer-inner -->
    </footer><!-- /.Footer -->
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
  <script src="/js/fronted.js" type="text/javascript"></script>

  <script src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
  <script src="{!! asset('assets/js/plugins.js') !!}"></script>
  <!-- <script src="assets/js/wow.min.js"></script> -->
  <script src="{!! asset('assets/js/main.js') !!}"></script>

  @yield('script')
</body>

</html>
