@extends('layouts.front')

@section('menu')
 <!-- =========================
        Header
    =========================== -->
    <header id="header" class="header header-transparent header-layout1">
      <nav class="navbar navbar-expand-lg sticky-navbar">
        <div class="container">
          <a class="navbar-brand" href="index.html">
            <img src="assets/images/logo/logo-light.png" class="logo-light" alt="logo">
            <img src="assets/images/logo/logo-dark.png" class="logo-dark" alt="logo">
          </a>
          <button class="navbar-toggler" type="button">
            <span class="menu-lines"><span></span></span>
          </button>
          <div class="collapse navbar-collapse" id="mainNavigation">
            <ul class="navbar-nav ml-auto">
              <li class="nav__item with-dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link active">Menu 1</a>
                <ul class="dropdown-menu">
                  <li class="nav__item"><a href="index.html" class="nav__item-link">Opcion 01</a></li>
                  <!-- /.nav-item -->
                  <li class="nav__item"><a href="home-gourmet.html" class="nav__item-link">Opcion 02</a></li>
                  <!-- /.nav-item -->
                </ul><!-- /.dropdown-menu -->
              </li><!-- /.nav-item -->

              <li class="nav__item with-dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Menu 2</a>
                <ul class="dropdown-menu">
                  <li class="nav__item"><a href="blog-carousel.html" class="nav__item-link">Opcion 01</a></li>
                  <li class="nav__item dropdown-submenu">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">Opcion 02</a>
                    <ul class="dropdown-menu">
                      <li class="nav__item">
                        <a href="blog-grid-sidebar.html" class="nav__item-link">Sub Opcion 02.01</a>
                      </li><!-- /.nav-item -->
                      <li class="nav__item">
                        <a href="blog-grid.html" class="nav__item-link">Sub Opcion 02.02</a>
                      </li><!-- /.nav-item -->
                    </ul><!-- /.dropdown-menu -->
                  </li><!-- /.nav-item -->
                </ul><!-- /.dropdown-menu -->
              </li><!-- /.nav-item -->

              <li class="nav__item"><a href="shop.html" class="nav__item-link">Menu 03</a></li>
              <!-- /.nav-item -->
            </ul><!-- /.navbar-nav -->
          </div><!-- /.navbar-collapse -->
          <div class="navbar-actions-wrap">
            <div class="navbar-actions d-flex align-items-center">
              <a href="#" class="navbar__action-btn search-popup-trigger"><i class="fa fa-search"></i></a>
              <a href="reservation.html"
                class="navbar__action-btn navbar__action-btn-reserve btn btn__primary">Reservation</a>
              <ul class="social__icons">
                <li><a href="#"><i class="fa fa-tripadvisor"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              </ul><!-- /.social__icons -->
            </div><!-- /.navbar-actions -->
          </div><!-- /.navbar-actions-wrap -->
        </div><!-- /.container -->
      </nav><!-- /.navabr -->
    </header><!-- /.Header -->
@endsection
