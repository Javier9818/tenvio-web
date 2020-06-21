
<header id="header" class="header   header-layout1">
    <nav class="navbar navbar-expand-lg sticky-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">
        <img src="{!! asset('assets/images/logo/logo.png') !!}" class="logo-light" alt="logo">
          <img src="{!! asset('assets/images/logo/logo.png') !!}" class="logo-dark" alt="logo">
        </a>
        <button class="navbar-toggler" type="button">
        <span class="menu-lines"><span></span></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav__item with-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link active">{{Auth::user()->username}}</a>
                    <ul class="dropdown-menu">
                        @can('gestionar-panel-empresa')
                            @can('gestionar-panel-general')
                                <li class="nav__item"><a href="/admin/empresas" class="nav__item-link">Panel de administración</a></li>
                                <li class="nav__item"><a href="/profile/my" class="nav__item-link">Perfil</a></li>
                                @else
                                <li class="nav__item"><a href="/intranet" class="nav__item-link">Panel de administración</a></li>
                                <li class="nav__item"><a href="/profile/my" class="nav__item-link">Perfil</a></li>
                            @endcan
                        @endcan
                        <li class="nav__item"><a href="{{ route('logout') }}" class="nav__item-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Cerrar Sesion</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>

                </li>
            @else
                <li class="nav__item"><a href="/login" class="nav__item-link">Iniciar Sesion</a></li>
                <li class="nav__item"><a href="/registro" class="nav__item-link">Registrarse</a></li>
            @endauth
        </ul>
        </div>
        <div class="navbar-actions-wrap">
        <div class="navbar-actions d-flex align-items-center">
            <a href="#" class="navbar__action-btn search-popup-trigger"><i class="fa fa-search"></i></a>
            <modal-carrito></modal-carrito>
            <modal-pedidos user={{Auth::id()}}></modal-pedidos>
        </div>
        </div>
    </div>
    </nav>
</header>

