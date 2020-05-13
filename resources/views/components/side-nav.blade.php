<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="/theme-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="/theme-assets/images/logo/logo.png"/>
            <h3 class="brand-text">Delivery</h3></a></li>
        <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
      </ul>
    </div>
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class="{{ $isTab('1') ? 'active' : 'nav-item' }}"><a href="/"><i class="ft-home"></i><span class="menu-title" data-i18n="">Inicio</span></a>
        </li>

        <li class="has-sub nav-item {{ $isTab('2') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Negocio</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('2', '1') ? 'active' : '' }}"><a class="menu-item" href="/empleados">Empleados</a></li>
                <li class="{{ $isSelected('2', '2') ? 'active' : '' }}"><a class="menu-item" href="/ventas">Ventas</a></li>
                <li class="{{ $isSelected('2', '3') ? 'active' : '' }}"><a class="menu-item" href="/pagos">Pagos</a></li>
            </ul>
        </li>

        <li class="has-sub nav-item {{ $isTab('3') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Menú</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('3', '1') ? 'active' : '' }}"><a class="menu-item" href="/categorias">Categorías</a></li>
                <li class="{{ $isSelected('3', '2') ? 'active' : '' }}"><a class="menu-item" href="/productos">Productos</a></li>
            </ul>
        </li>

        <li class="has-sub nav-item {{ $isTab('4') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Pedidos</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('4', '1') ? 'active' : '' }}"><a class="menu-item" href="/pedidos">Pedidos del día</a></li>
                <li class="{{ $isSelected('4', '2') ? 'active' : '' }}"><a class="menu-item" href="/pedidos-cocina">Recepción</a></li>
                <li class="{{ $isSelected('4', '3') ? 'active' : '' }}"><a class="menu-item" href="/asignar-delivery">Asignar delivery</a></li>
            </ul>
        </li>

        <li class="{{ $isTab('5') ? 'active' : 'nav-item' }}"><a href="/transporte"><i class="ft-bold"></i><span class="menu-title" data-i18n="">Transporte</span></a>
        </li>
      </ul>
    </div>
    <div class="navigation-background"></div>
  </div>
