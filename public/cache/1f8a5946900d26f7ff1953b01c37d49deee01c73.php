<?php
  Display('register_form_modal','<i class="fas fa-user-plus"></i>','0','2','Registration Form');
  Display('login_form_modal','<i class="fas fa-sign-in-alt"></i>','0','2','Login Form');
?>
<nav id="nav" class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
  <div class="container">
    <div class="nk-nav-table">
      <a href="/" class="nk-nav-logo">
        <img src="/resources/themes/core/images/logos/logo.png" alt="" width="150">
      </a>
      <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
        <li id="item" class="  ">
          <a href="/"><?php echo e(__("home")); ?></a>
		</li>
        <li id="item" class="  ">
          <a href="/community/downloads"><?php echo e(__("downloads")); ?></a>
        </li>
        <li class="  nk-drop-item">
          <a href="#"><?php echo e(__("serverInfo")); ?></a>
          <ul class="dropdown">
            <li id="item" class="  ">
              <a href="/serverinfo/about"><?php echo e(__("about")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/serverinfo/bossrecords"><?php echo e(__("bossRecords")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/serverinfo/dropfinder"><?php echo e(__("dropFinder")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/serverinfo/drops"><?php echo e(__("dropList")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/serverinfo/terms"><?php echo e(__("terms")); ?></a>
            </li>
          </ul>
        </li>
        <li class="  nk-drop-item">
          <a href="#"><?php echo e(__("community")); ?></a>
          <ul class="dropdown">
            <li id="item" class="  ">
              <a href="/community/discord"><?php echo e(__("discord")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/community/guildrankings"><?php echo e(__("guildRankings")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/community/news"><?php echo e(__("news")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/community/patchnotes"><?php echo e(__("patchNotes")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/community/pvprankings"><?php echo e(__("pvpRankings")); ?></a>
            </li>
            <li id="item" class="  ">
              <a href="/community/staffteam"><?php echo e(__("staffTeam")); ?></a>
            </li>
          </ul>
        </li>
        <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
          <li class="logUsers">
            <a href="/user/users">Users</a>
          </li>
        <?php endif; ?>
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
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
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
        <?php else: ?>
          <li class="  nk-drop-item logNav">
            <a href="#">
              <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown">
                <?php
                  $DisplayName  = $data['user']->DisplayName;
                  $UserUID  = $data['user']->UserUID;
                ?>
              <li class="  ">
                <a href="/user/<?php echo e($UserUID); ?>"><?php echo e($DisplayName); ?></a>
              <div style="border-bottom: 1px solid white;"</div>
              <?php if(in_array($data['user']->Status, $data['user']->is_staff)): ?>
                <li class="  ">
                <a href="/admin" target="_blank"><?php echo e(__("staffPanel")); ?></a>
              <?php endif; ?>
              <li class="  ">
                <a href="/user/profile">Profile</a>
              <li class="  ">
                <a href="/user/settings#general">Settings</a>
              <li class="logout">
                <a href="/auth/logout"><?php echo e(__("logout")); ?></a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/nav.blade.php ENDPATH**/ ?>