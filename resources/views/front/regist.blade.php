<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
        <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/assets_client/css/styles.css" rel="stylesheet" />
        @yield('styles')
    </head>
    <body id="page-top">

        <div id="app_vue">
            @yield('nav')
            @yield('content')
             <!-- Copyright Section-->
            <section class="copyright py-4 text-center text-white">
                <div class="container"><small>Copyright © Nortec © 2020 - Escuela de Ingeniería de Sistemas - UNT</small></div>
            </section>
            <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
            <div class="scroll-to-top d-lg-none position-fixed">
                <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
            </div>

            @yield('modals')
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="/assets_client/mail/jqBootstrapValidation.js"></script>
        <script src="/assets_client/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="/assets_client/js/scripts.js"></script>


        @yield('scripts')
    </body>
</html>
