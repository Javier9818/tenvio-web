@extends('layouts.landing_pages')

@section('title')
    TE ENVIO
@endsection

@section('styles')

@endsection

@section('content')
<!-- navbar area start -->
<nav class="navbar navbar-area navbar-expand-lg nav-absolute white nav-style-01 header-style-09">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="index.html" class="logo">
                    <img src="assets/images/landing_pages/logo-white.png" alt="logo">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appside_main_menu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="appside_main_menu">
            <ul class="navbar-nav">
                <li class="current-menu-item">
                    <a href="/">Inicio</a>
                </li>
                <li><a href="#about">Detalle</a></li>
                <li><a href="#pricing">Precios</a></li>
                <li><a href="#contact">Contáctanos</a></li>
            </ul>
        </div>
        <div class="nav-right-content">
            <ul>
                <li class="button-wrapper">
                    <a href="javascript:void(0)" style="cursor: default;" class="boxed-btn">Regístrate</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- navbar area end -->

<!-- header area start  -->
<header class="header-area header-bg-9 style-09" id="home">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="header-inner">
                    <h1 class="title wow fadeInDown">Tu negocio al alcance de un click</h1>
                    <p>Ofrece tus productos en tu propia página web, y lleva tu negocio al siguiente nivel.</p>
                    <div class="btn-wrapper wow fadeInUp">
                        <a class="boxed-btn-02 reverse-color " href="#">Registrar mi negocio</a>
                        <a class="boxed-btn-02 blank" href="#">¿Cómo funciona?</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="right-img">
                    <div class="img-wrapper">
                        <img src="assets/images/landing_pages/header-right-image.png" alt="header right image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end  -->
<div class="about-app-area padding-top-120" id="about" style="background-image:url(assets/images/landing_pages/bg/about-app-area-bg.png);">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-12">
                <ul class="feature-list style-03">
                    <li class="single-feature-list">
                        <div class="icon icon-bg-1">
                            <i class="flaticon-vector"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">Full Mangement</a></h4>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor </p>
                        </div>
                    </li>
                    <li class="single-feature-list">
                        <div class="icon icon-bg-2">
                            <i class="flaticon-responsive"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">Live Chat</a></h4>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor </p>
                        </div>
                    </li>
                    <li class="single-feature-list">
                        <div class="icon icon-bg-3">
                            <i class="flaticon-layers-2"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">Secure Data</a></h4>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor </p>
                        </div>
                    </li>
                    <li class="single-feature-list">
                        <div class="icon icon-bg-4">
                            <i class="flaticon-picture"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="#">Access Drive</a></h4>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor </p>
                        </div>
                    </li>
                </ul>
            </div> -->
        </div>
        <div class="row love-this-app-area padding-top-120">
            <div class="col-lg-6">
                <div class="img-wrapper">
                    <img src="assets/images/landing_pages/about-app-mobile.png" alt="about mobile apps">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-side-content">
                    <div class="section-title left-aligned">
                        <span class="subtitle">Porque elegirnos?</span>
                        <h2 class="title">Te garantizamos que las compras son 100% efectivas</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="full-width-video-area margin-top-minus-290">
                    <div class="img-full-width-video">
                        <img src="assets/images/landing_pages/full-width-video-area.png" alt="full width video area">
                        <div class="hover">
                            <a href="https://www.youtube.com/watch?v=pwMmqRg-ZjU" class="play-video-btn mfp-iframe"><i class="fa fa-play"></i> Ver Video</a>
                        </div>
                    </div>
              </div>
            </div>
        </div>
        <div class="row icon-box-wrapper-03 padding-top-120 padding-bottom-80">
            <div class="col-lg-6">
                <div class="single-icon-box-03 margin-bottom-40 theme-01">
                    <div class="icon">
                        <i class="fab fa-github"></i>
                    </div>
                    <div class="content">
                        <h4 class="title">Amigable</h4>
                        <p>Un aplicativo facil de usar</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-icon-box-03 margin-bottom-40 theme-02">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="content">
                        <h4 class="title">Panel Administrativo</h4>
                        <p>Controla tus ventas y productos desde un panel personalizado.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-icon-box-03 margin-bottom-40 theme-03">
                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="content">
                        <h4 class="title">Mapa</h4>
                        <p>Interactua con la aplicacion para saber el estado de tu pedido.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-icon-box-03 margin-bottom-40 theme-04">
                    <div class="icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    <div class="content">
                        <h4 class="title">Soporte</h4>
                        <p>Tu nos importas, estamos para ayudarte las 24h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- price plan area start -->
<section class="pricing-plan-area" id="pricing">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-title"><!-- section title -->
                <span class="subtitle">Nuestros Planes</span>
                <h3 class="title extra">Conosca nuestros Precios</h3>
                <p>Elija el plan de acuerdo a la necesidad de su empresa, si necesita asesoria, no dude en escribirnos al correo : fdfdf@nortec.com</p>
            </div><!-- //. section title -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="single-price-plan-02 wow zoomIn"><!-- single price plan one -->
                <div class="price-header">
                    <h4 class="name">Plan Económico</h4>
                    <div class="price-wrap">
                        <span class="price">S/. 10</span>
                        <span class="month">/Mes</span>
                    </div>
                </div>
                <div class="price-body">
                    <ul>
                        <li>1 Mes Gratis</li>
                        <li>Soporte 24h</li>
                        <li>300 pedidos mensual</li>
                        <li></li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="boxed-btn">Empezar</a>
                </div>
            </div><!-- //. single price plan one -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="single-price-plan-02 wow zoomIn featured"><!-- single price plan one -->
                <div class="price-header">
                    <h4 class="name">Plan Basico</h4>
                    <div class="price-wrap">
                        <span class="price">S/. 30</span>
                        <span class="month">/Mes</span>
                    </div>
                </div>
                <div class="price-body">
                    <ul>
                        <li>1 Mes Gratis</li>
                        <li>Soporte 24h</li>
                        <li>1500 pedidos mensual</li>
                        <li></li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="boxed-btn">Empezar</a>
                </div>
            </div><!-- //. single price plan one -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="single-price-plan-02 wow zoomIn"><!-- single price plan one -->
                <div class="price-header">
                    <h4 class="name">Plan Empresarial</h4>
                    <div class="price-wrap">
                        <span class="price">S/. 50</span>
                        <span class="month">/Mes</span>
                    </div>
                </div>
                <div class="price-body">
                    <ul>
                        <li>1 Mes Gratis</li>
                        <li>Soporte 24h</li>
                        <li>3000 pedidos mensual</li>
                        <li></li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="boxed-btn">Empezar</a>
                </div>
            </div><!-- //. single price plan one -->
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="single-price-plan-02 wow zoomIn"><!-- single price plan one -->
                <div class="price-header">
                    <h4 class="name">Plan Avanzado</h4>
                    <div class="price-wrap">
                        <span class="price">S/. 80</span>
                        <span class="month">/Mes</span>
                    </div>
                </div>
                <div class="price-body">
                    <ul>
                        <li>1 Mes Gratis</li>
                        <li>Soporte 24h</li>
                        <li>4500 pedidos mensual</li>
                        <li></li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="boxed-btn">Empezar</a>
                </div>
            </div><!-- //. single price plan one -->
        </div>
    </div>
</div>
</section>
<!-- price plan area end -->

<!-- contact form area start  -->
<div class="contact-form-area-02 contact-bg padding-bottom-120 padding-top-120" id="contact">
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="contact-area-wrapper" id="contact"><!-- contact area wrapper -->
                <span class="subtitle">Contacta con nosotros</span>
                <h3 class="title">Ponerse en contacto</h3>
                <p>Envianos tus dudas o sugerencias, estaremos atento a escucharte para seguir mejorando.</p>
                <form action="index.html" id="contact_form_submit" class="contact-form sec-margin">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="uname" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group textarea">
                                <textarea name="message" id="message" class="form-control" cols="30" rows="10" placeholder="Mensaje"></textarea>
                            </div>
                            <button class="submit-btn  btn-rounded gd-bg-1" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>
            </div><!-- //. contact area wrapper -->
        </div>
        <div class="col-lg-6">
            <div class="img-wrapper">
                <img src="assets/images/landing_pages/contact-mobile.png" alt="">
            </div>
        </div>
    </div>
</div>
</div>
<!-- contact form area end -->

{{-- <div class="call-to-action-area">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="call-to-action-inner-style-02">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h3 class="title">Muy pronto, nuestro aplicativo</h3>
                        <div class="btn-wrapper wow fadeInUp">
                            <a href="javascript:void(0)" style="cursor: default;"class="boxed-btn-02 reverse-color"><i class="flaticon-apple-1"></i> App Store</a>
                            <a href="javascript:void(0)" style="cursor: default;" class="boxed-btn-02 blank"><i class="flaticon-android-logo"></i> Play Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}
@endsection

@section('clasesfooter')
    style-02 bg-blue
@endsection



