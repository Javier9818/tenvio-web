
<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="/theme-assets/images/ico/apple-icon-120.png">
    <link href="assets/images/favicon/favicon2.png"  rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/colors/palette-gradient.css">
  </head>
  <body>

    <section id="wrapper" class="login-register login-sidebar flexbox-container d-flex" style="background-image:url(assets/images/backgrounds/recovery2.png);background-size: cover; height: 100vh">
        <div class="login-box col-12 d-flex align-items-center justify-content-center"> <!--class="login-box card shadow-none" -->
            <div class="card-body m-0 p-0" style="height: 90vh">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 m-0 p-0">
                    <div class="card-header border-0 bg-transparent">
                        <div class="text-center mb-1">
                                <img src="assets/images/logo/logo2.png" alt="AQUI VA EL LOGO" style="width: 50%;">

                        </div>
                        <div class="font-large-1  text-center">
                            Recuperación de Contraseña
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control round" id="newpassword" name="newpassword" placeholder="Nueva Contraseña" required="" aria-invalid="false" autocomplete="off">
                                    <div class="form-control-position">
                                        <i class="ft-lock"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control round" id="newpassword" name="newpassword" placeholder="Repita Contraseña" required="" aria-invalid="false" autocomplete="off">
                                    <div class="form-control-position">
                                        <i class="ft-lock"></i>
                                    </div>
                                </fieldset>
                                {{-- <div class="form-group row">
                                    <div class="col-md-6 col-12 text-center text-sm-left">

                                    </div>
                                    <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Olvidaste tu contraseña?</a></div>
                                </div> --}}
                                <div class="form-group text-center">
                                    <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Guardar</button>
                                </div>

                            </form>
                        </div>


                        <p class="card-subtitle text-muted text-right font-small-3 mx-2 mb-1"><span>No tienes una cuenta? <a href="/registro" class="card-link">Registrate</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </body>
</html>


