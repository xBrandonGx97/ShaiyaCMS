<nav class="pcoded-navbar navbar-dark brand-dark">
  <div class="navbar-wrapper">
    <div class="navbar-brand header-logo">
      <a href="/admin" class="b-brand">
        <img src="/resources/themes/core/images/logos/icon.png" width="70px" alt="ShaiyaCMS Admin Panel">
        {{-- <span class="b-title">Admin Panel</span> --}}
      </a>
      <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
    </div>
    <div class="navbar-content scroll-div">
      <ul class="nav pcoded-inner-navbar">
        <li class="nav-item pcoded-menu-caption">
          <label>Navigation</label>
        </li>
        <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
          <a href="/admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
        </li>
        @auth
          @if($data['user']->isADM())
            @include('partials.ap.nav.admin')
          @endif
          @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
            @include('partials.ap.nav.account')
            @include('partials.ap.nav.player')
            @include('partials.ap.nav.misc')
            @include('partials.ap.nav.sExtended')
          @endif
          @if($data['user']->isGS())
            @include('partials.ap.nav.gs')
          @endif
        @endauth
    </div>
  </div>
</nav>
