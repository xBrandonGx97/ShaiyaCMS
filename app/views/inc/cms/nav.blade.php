<?php
	use Classes\Base\Langs;
?>
@if ($data['pageData']['nav'] === true)
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
            <a href="/forum">Forum</a>
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
                <a href="/serverinfo/drops">{{__("drp_lst")}}</a>
              </li>
              <li class="  ">
                <a href="/serverinfo/dropfinder">{{__("drp_finder")}}</a>
              </li>
              <li class="  ">
                <a href="/serverinfo/bossrecords">{{__("boss_rcrds")}}</a>
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
                <a href="/community/news">{{__("news")}}</a>
              </li>
              <li class="  ">
                <a href="/community/patchnotes">{{__("ptch_nts")}}</a>
              </li>
              <li class="  ">
                <a href="/community/pvprankings">{{__("pvp_rnkings")}}</a>
              </li>
              <li class="  ">
                <a href="/community/guildrankings">{{__("gld_rnkigns")}}</a>
              </li>
              <li class="  ">
                <a href="/community/staffteam">{{__("stff_tm")}}</a>
              </li>
              <li class="  ">
                <a href="/community/guilds">{{__("glds")}}</a>
              </li>
            </ul>
          </li>
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
          @if (!isset($_SESSION['User']['UserUID']))
            @if ($_SESSION['Settings']['LOGIN_TYPE']=='Modal')
              <li class="  nk-drop-item">
                <a href="#">
                  <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown">
                  <li class="  ">
                    <a href="#" class="open_login_form_modal" title="Login" data-id="" data-target="#login_form_modal" data-toggle="modal">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                  </li>
                  <li class="  ">
                    <a href="#" class="open_register_form_modal" title="Register" data-id="" data-target="#register_form_modal" data-toggle="modal">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            @if ($_SESSION['Settings']['LOGIN_TYPE']=='Default')
              <li class="single-icon">
                <a href="#" class="nk-sign-toggle no-link-effect">
                  <span class="nk-icon-toggle">
                    <span class="nk-icon-toggle-front">
                      <span class="fas fa-user"></span>
                    </span>
                    <span class="nk-icon-toggle-back">
                      <span class="nk-icon-close"></span>
                    </span>
                  </span>
                </a>
              </li>
            @endif
            @else
              @if ($_SESSION['Settings']['LOGIN_TYPE']=='Modal')
                <li class="  nk-drop-item">
                <a href="#">
                  <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown">
                  @if ($data['User']['LoginStatus']==true)
                    @php
                      $DisplayName  = $data['User']['DisplayName'];
                    @endphp
                  <li class="  ">
                    <a href="/user/account">{{$DisplayName}}</a>
                  <div style="border-bottom: 1px solid white;"</div>
                  @if (in_array($data['User']['Status'], $data['User']['is_staff']))
                   <li class="  ">
                    <a href="/user/account">Staff Panel</a>
                  @endif
                  <li class="  ">
                    <a href="/user/profile">Profile</a>
                  <li class="  ">
                    <a href="/user/donate">Donate</a>
                  <li class="  ">
                    <a href="/user/vote">Vote for DP</a>
                  <li class="  ">
                    <a href="/user/pvprewards">PvP Rewards</a>
                  <li class="  ">
                    <a href="/user/support">Support</a>
                  <li class="  ">
                    <a href="/user/settings">Settings</a>
                  <li class="  ">
                    <a href="/user/promotions">Promotions</a>
                  <li class="  ">
                    <a href="/user/logout">Logout</a>
                  </li>
                  @endif
                </ul>
              </li>
              @endif
              @if ($_SESSION['Settings']['LOGIN_TYPE']=='Default')
              @endif
          @endif
        </ul>
      </div>
    </div>
  </nav>

@elseif ($data['pageData']['nav'] === false)
  <h2>nav is false :)</h2>
@endif
