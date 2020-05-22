<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="/theme-assets/images/backgrounds/10.png">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="/intranet">
            {{-- <img class="brand-logo" alt="Chameleon admin logo" src="/theme-assets/images/logo/logo.png"/> --}}
            <h3 class="brand-text">Te envio</h3></a></li>
        <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
      </ul>
    </div>
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="{{ $isTab('1') ? 'active' : 'nav-item' }}"><a href="/intranet"><i class="ft-home"></i><span class="menu-title" data-i18n="">Inicio</span></a>
        </li>

        <li class="has-sub nav-item {{ $isTab('2') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-users"></i><span class="menu-title" data-i18n="">Personal</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('2', '1') ? 'active' : '' }}"><a class="menu-item" href="/intranet/empleados">Empleados</a></li>
            </ul>
        </li>

        <li class="has-sub nav-item {{ $isTab('3') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-trending-up"></i><span class="menu-title" data-i18n="">Contabilidad</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('3', '1') ? 'active' : '' }}"><a class="menu-item" href="/intranet/ventas">Ventas</a></li>
                <li class="{{ $isSelected('3', '2') ? 'active' : '' }}"><a class="menu-item" href="/intranet/pagos">Pagos</a></li>
            </ul>
        </li>

        <li class="has-sub nav-item {{ $isTab('4') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="la la-comments"></i><span class="menu-title" data-i18n="">Gestión de pedidos</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('4', '1') ? 'active' : '' }}"><a class="menu-item" href="/intranet/pedidos">Atención de pedidos</a></li>
                <li class="{{ $isSelected('4', '2') ? 'active' : '' }}"><a class="menu-item" href="/intranet/pedidos-cocina">Entrega en local</a></li>
                <li class="{{ $isSelected('4', '3') ? 'active' : '' }}"><a class="menu-item" href="/intranet/asignar-delivery">Asignar delivery</a></li>
                <li class="{{ $isSelected('4', '4') ? 'active' : '' }}"><a class="menu-item" href="/intranet/asignar-delivery">Estado de pedidos</a></li>
            </ul>
        </li>
        {{-- <i class="ft-pie-chart"></i> --}}
        <li class="has-sub nav-item {{ $isTab('5') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Mis productos</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('5', '1') ? 'active' : '' }}"><a class="menu-item" href="/intranet/categorias">Categorías</a></li>
                <li class="{{ $isSelected('5', '2') ? 'active' : '' }}"><a class="menu-item" href="/intranet/productos">Productos</a></li>
            </ul>
        </li>


        <li class="{{ $isTab('6') ? 'active' : 'nav-item' }}"><a href="/intranet/transporte"><i class="la la-motorcycle"></i><span class="menu-title" data-i18n="">Transporte</span></a>
        </li>


        <li class="nav-item {{ $isTab('7') ? 'open' : '' }}"><a href="/intranet/configuraciones"><i class="la la-cog"></i><span class="menu-title" data-i18n="">Configuraciones</span></a>
        </li>

      </ul>
    </div>
    <div class="navigation-background"></div>
  </div>
