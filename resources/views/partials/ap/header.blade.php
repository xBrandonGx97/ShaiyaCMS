<header class="navbar pcoded-header navbar-expand-lg navbar-light">
  <div class="m-header">
    <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
    <a href="#" class="b-brand">
      <div class="b-bg">
        <i class="feather icon-trending-up"></i>
      </div>
      <span class="b-title">Admin Panel</span>
    </a>
  </div>
  <a class="mobile-menu" id="mobile-header" href="javascript:">
    <i class="feather icon-more-horizontal"></i>
  </a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li>
        <a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()">
          <i class="feather icon-maximize"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="dropdown-toggle" href="{{isset($_GET['lang']) ? '?lang='.LANG : '?lang=en'}}" data-toggle="dropdown">{{lang(LANG)}}</a>
        <ul class="dropdown-menu">
          @php
            /* $is_admin = ($user['permissions'] == 'admin' ? true : false); */
          @endphp
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=en'}}">English</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=fr'}}">French</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=tr'}}">Turkish</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=es'}}">Spanish</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=pt'}}">Portugese</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=it'}}">Italian</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=nl'}}">Dutch</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=de'}}">German</a></li>
          <li><a class="dropdown-item" href="{{$_GET['lang']='?lang=fil'}}">Filipino</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <div class="main-search">
          <div class="input-group">
            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
            <a href="javascript:" class="input-group-append search-close">
              <i class="feather icon-x input-group-text"></i>
            </a>
            <span class="input-group-append search-btn btn btn-primary">
              <i class="feather icon-search input-group-text"></i>
            </span>
          </div>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li>
        <div class="dropdown drp-user">
          <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon feather icon-user"></i>
          </a>
          @auth
          <div class="dropdown-menu dropdown-menu-right profile-notification">
            <div class="pro-head">
              <span>{{$data['user']->DisplayName}} - {!!$data['user']->getStatusColor($data['user']->Status)!!}</span>
              <a href="/admin/auth/logout" class="dud-logout" title="Logout">
                <i class="feather icon-log-out"></i>
              </a>
            </div>
            <ul class="pro-body">
              <li><a href="/admin/auth/logout" class="dropdown-item"><i class="feather icon-log-out"></i> Logout</a></li>
            </ul>
          @endauth
          </div>
        </div>
      </li>
    </ul>
  </div>
</header>
