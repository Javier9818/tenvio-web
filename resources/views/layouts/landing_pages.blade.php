<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="TE ENVIO - NORTEC">
    <link href="assets/images/favicon/favicon2.ico"  rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noarchive">
    <title> @yield('title')</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="/assets/css/landing_pages/bootstrap.min.css">
    <!-- icofont -->
    <link rel="stylesheet" href="/assets/css/landing_pages/fontawesome.5.7.2.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="/assets/css/landing_pages/flaticon.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="/assets/css/landing_pages/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/assets/css/landing_pages/owl.carousel.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="/assets/css/landing_pages/magnific-popup.css">
    <!-- stylesheet -->
    <link rel="stylesheet" href="/assets/css/landing_pages/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="/assets/css/landing_pages/responsive.css">

    <!--Iconos-->
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/landing_pages/all.css"> --}}

    @yield('styles')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

<!-- footer area start -->
<footer class="footer-area @yield('clasesfooter')">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about_widget">
                        <a href="index.html" class="footer-logo"><img src="/assets/images/landing_pages/logo-white.png" alt=""></a>
                        <p>Crea, Innova ;) </p>
                        <ul class="social-icon">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget nav_menus_widget">
                        <h4 class="widget-title">Servicios</h4>
                        <ul>
                            <li><a href="https://tenvioperu.com/"><i class="fas fa-chevron-right"></i> Te Envio</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget nav_menus_widget">
                        <h4 class="widget-title">Necesitas Ayuda?</h4>
                        <ul>
                            {{-- <li><a href="#"><i class="fas fa-chevron-right"></i> Faqs</a></li> --}}
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Privacidad</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Políticas</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Soporte</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Términos y condiciones</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget nav_menus_widget">
                        <h4 class="widget-title">Contácto</h4>
                        <ul>
                            {{-- <li><a href="#"><i class="fas fa-chevron-right"></i> Wsp</a></li> --}}
                            <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i> Twiter</a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i> Instagran</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area"><!-- copyright area -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-inner"><!-- copyright inner wrapper -->
                        <div class="left-content-area"><!-- left content area -->
                            &copy; Copyrights 2020 NorTec Todos los derechos reservados.
                        </div><!-- //. left content aera -->
                        <div class="right-content-area"><!-- right content area -->
                            Diseñado por <strong><em>NorTec</em></strong>
                        </div><!-- //. right content area -->
                    </div><!-- //.copyright inner wrapper -->
                </div>
            </div>
        </div>
    </div><!-- //. copyright area -->
</footer>
<!-- footer area end -->

<!-- preloader area start -->
<div class="preloader-wrapper" id="preloader">
    <div class="preloader" >
        <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
        </div>
    </div>
</div>

  <!-- preloader area end -->

  <!-- back to top area start -->
  <div class="back-to-top">
        <i class="fas fa-angle-up"></i>
  </div>
  <!-- back to top area end -->


    <!-- jquery -->
    <script src="/assets/js/landing_pages/jquery.js"></script>
    <!-- popper -->
    <script src="/assets/js/landing_pages/popper.min.js"></script>
    <!-- bootstrap -->
    <script src="/assets/js/landing_pages/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="/assets/js/landing_pages/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="/assets/js/landing_pages/jquery.magnific-popup.js"></script>
    <!-- contact js-->
    <script src="/assets/js/landing_pages/contact.js"></script>
    <!-- wow js-->
    <script src="/assets/js/landing_pages/wow.min.js"></script>
    <!-- way points js-->
    <script src="/assets/js/landing_pages/waypoints.min.js"></script>
    <!-- counterup js-->
    <script src="/assets/js/landing_pages/jquery.counterup.min.js"></script>
    <!-- main -->
    <script src="/assets/js/landing_pages/main.js"></script>

    <script src="/js/fronted.js" type="text/javascript"></script>

    @yield('script')
</body>

</html>
