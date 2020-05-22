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

        <li class="has-sub nav-item {{ $isTab('1') ? 'open' : '' }}">
            <a href="javascript::void(0)"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Empresas</span></a>
            <ul class="menu-content">
                <li class="{{ $isSelected('1', '1') ? 'active' : '' }}"><a class="menu-item" href="/admin/empresas">Mis empresas</a></li>
            </ul>
        </li>
      </ul>
    </div>
    <div class="navigation-background"></div>
  </div>
