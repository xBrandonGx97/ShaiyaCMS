@php
  Display('register_form_modal','<i class="fas fa-user-plus"></i>','0','2','Registration Form');
  Display('login_form_modal','<i class="fas fa-sign-in-alt"></i>','0','2','Login Form');
@endphp
<nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
  <div class="container">
    <div class="nk-nav-table">
      <a href="/" class="nk-nav-logo">
        <img src="/resources/themes/core/images/logos/logo.png" alt="" width="150">
      </a>
      <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
        <li class="active  ">
          <a href="/">{{__("home")}}</a>
		</li>
        <li class="  ">
          <a href="/community/downloads">{{__("dwnl")}}</a>
        </li>
        <li class="  nk-drop-item">
          <a href="#">{{__("srvinfo")}}</a>
          <ul class="dropdown">
            <li class="  ">
              <a href="/serverinfo/about">{{__("about")}}</a>
            </li>
            <li class="  ">
              <a href="/serverinfo/bossrecords">{{__("boss_rcrds")}}</a>
            </li>
            <li class="  ">
              <a href="/serverinfo/dropfinder">{{__("drp_finder")}}</a>
            </li>
            <li class="  ">
              <a href="/serverinfo/drops">{{__("drp_lst")}}</a>
            </li>
            <li class="  ">
              <a href="/serverinfo/terms">{{__("trms")}}</a>
            </li>
          </ul>
        </li>
        <li class="  nk-drop-item">
          <a href="#">{{__("community")}}</a>
          <ul class="dropdown">
            <li class="  ">
              <a href="/community/discord">{{__("dscord")}}</a>
            </li>
            <li class="  ">
              <a href="/community/guildrankings">{{__("gld_rnkigns")}}</a>
            </li>
            <li class="  ">
              <a href="/community/news">{{__("news")}}</a>
            </li>
            <li class="  ">
              <a href="/community/patchnotes">{{__("ptch_nts")}}</a>
            </li>
            <li class="  ">
              <a href="/community/pvprankings">{{__("pvp_rnkings")}}</a>
            </li>
            <li class="  ">
              <a href="/community/staffteam">{{__("stff_tm")}}</a>
            </li>
          </ul>
        </li>
        @auth
          <li class="logUsers">
            <a href="/user/users">Users</a>
          </li>
        @endauth
      </ul>
      <ul class="nk-nav nk-nav-right nk-nav-icons">
        <li class="single-icon hidden-lg-up">
          <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
            <span class="nk-icon-burger">
              <span class="nk-t-1"></span>
              <span class="nk-t-2"></span>
              <span class="nk-t-3"></span>
            </span>
          </a>
        </li>
        @guest
          <li class="single-icon">
            <a href="#" class="nk-sign-toggle no-link-effect">
              <span class="nk-icon-toggle">
                <span class="nk-icon-toggle-front">
                  <span class="far fa-user"></span>
                </span>
                <span class="nk-icon-toggle-back">
                  <span class="nk-icon-close"></span>
                </span>
              </span>
            </a>
          </li>
        @else
          <li class="  nk-drop-item logNav">
            <a href="#">
              <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown">
                @php
                  $DisplayName  = $data['user']->DisplayName;
                  $UserUID  = $data['user']->UserUID;
                @endphp
              <li class="  ">
                <a href="/user/{{$UserUID}}">{{$DisplayName}}</a>
              <div style="border-bottom: 1px solid white;"</div>
              @if (in_array($data['user']->Status, $data['user']->is_staff))
                <li class="  ">
                <a href="/admin" target="_blank">Staff Panel</a>
              @endif
              <li class="  ">
                <a href="/user/profile">Profile</a>
              <li class="  ">
                <a href="/user/settings#general">Settings</a>
              <li class="logout">
                <a href="/auth/logout">Logout</a>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
