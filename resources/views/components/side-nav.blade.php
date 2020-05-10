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
            <a href="charts.html"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Negocio</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('2', '1') ? 'active' : '' }}"><a class="menu-item" href="/empleados">Empleados</a></li>
                <li class="{{ $isSelected('2', '2') ? 'active' : '' }}"><a class="menu-item" href="/empleados">Ventas</a></li>
                <li class="{{ $isSelected('2', '2') ? 'active' : '' }}"><a class="menu-item" href="/empleados">Pagos</a></li>
            </ul>
        </li>

        <li class="{{ $isTab('3') ? 'active' : 'nav-item' }}"><a href="icons.html"><i class="ft-droplet"></i><span class="menu-title" data-i18n="">Icons</span></a>
        </li>

        <li class="{{ $isTab('4') ? 'active' : 'nav-item' }}"><a href="cards.html"><i class="ft-layers"></i><span class="menu-title" data-i18n="">Cards</span></a>
        </li>
        <li class="{{ $isTab('5') ? 'active' : 'nav-item' }}"><a href="buttons.html"><i class="ft-box"></i><span class="menu-title" data-i18n="">Buttons</span></a>
        </li>

        <li class="{{ $isTab('6') ? 'active' : 'nav-item' }}"><a href="typography.html"><i class="ft-bold"></i><span class="menu-title" data-i18n="">Typography</span></a>
        </li>

        <li class="{{ $isTab('7') ? 'active' : 'nav-item' }}"><a href="tables.html"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="">Tables</span></a>
        </li>

        <li class="{{ $isTab('8') ? 'active' : 'nav-item' }}"><a href="form-elements.html"><i class="ft-layout"></i><span class="menu-title" data-i18n="">Form Elements</span></a>
        </li>

        <li class="{{ $isTab('9') ? 'active' : 'nav-item' }}"><a href="https://themeselection.com/demo/chameleon-admin-template/documentation"><i class="ft-book"></i><span class="menu-title" data-i18n="">Documentation</span></a>
        </li>

      </ul>
    </div>
    <div class="navigation-background"></div>
  </div>
