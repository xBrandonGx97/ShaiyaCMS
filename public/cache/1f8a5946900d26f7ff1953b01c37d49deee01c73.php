<?php
  use Classes\Base\Langs;
?>
<?php if($data['pageData']['nav'] === true): ?>
  <?php
    Display('register_form_modal','<i class="fas fa-user-plus"></i>','0','2','Registration Form');
    Display('login_form_modal','<i class="fas fa-sign-in-alt"></i>','0','2','Login Form');
  ?>
  <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
    <div class="container">
      <div class="nk-nav-table">
        <a href="/" class="nk-nav-logo">
          <img src="/resources/themes/core/images/logos/logo.png" alt="" width="150">
        </a>
        <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
          <li class="active  ">
            <a href="/"><?php echo e(__("home")); ?></a>
		  </li>
          <li class="  ">
            <a href="/forum">Forum</a>
          </li>
          <li class="  ">
            <a href="/community/downloads"><?php echo e(__("dwnl")); ?></a>
          </li>
          <li class="  nk-drop-item">
            <a href="#"><?php echo e(__("srvinfo")); ?></a>
            <ul class="dropdown">
              <li class="  ">
                <a href="/serverinfo/about"><?php echo e(__("about")); ?></a>
              </li>
              <li class="  ">
                <a href="/serverinfo/drops"><?php echo e(__("drp_lst")); ?></a>
              </li>
              <li class="  ">
                <a href="/serverinfo/dropfinder"><?php echo e(__("drp_finder")); ?></a>
              </li>
              <li class="  ">
                <a href="/serverinfo/bossrecords"><?php echo e(__("boss_rcrds")); ?></a>
              </li>
              <li class="  ">
                <a href="/serverinfo/terms"><?php echo e(__("trms")); ?></a>
              </li>
            </ul>
          </li>
          <li class="  nk-drop-item">
            <a href="#"><?php echo e(__("community")); ?></a>
            <ul class="dropdown">
              <li class="  ">
                <a href="/community/discord"><?php echo e(__("dscord")); ?></a>
              </li>
              <li class="  ">
                <a href="/community/news"><?php echo e(__("news")); ?></a>
              </li>
              <li class="  ">
                <a href="/community/patchnotes"><?php echo e(__("ptch_nts")); ?></a>
              </li>
              <li class="  ">
                <a href="/community/pvprankings"><?php echo e(__("pvp_rnkings")); ?></a>
              </li>
              <li class="  ">
                <a href="/community/guildrankings"><?php echo e(__("gld_rnkigns")); ?></a>
              </li>
              <li class="  ">
                <a href="/community/staffteam"><?php echo e(__("stff_tm")); ?></a>
              </li>
            </ul>
          </li>
          <?php if($data['User']['LoginStatus']===true): ?>
            <li class="  ">
              <a href="/user/users">Users</a>
            </li>
            <li class="  nk-drop-item">
              <a href="/user/friends">
                <i class="fas fa-bell"></i>
              </a>
              <ul class="dropdown">
                friend 1: <button>add</button>
              </ul>
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
            <li class="  nk-drop-item">
              <a href="#">
                <i class="fas fa-user"></i>
              </a>
              <ul class="dropdown">
                  <?php
                    $DisplayName  = $data['User']['DisplayName'];
                    $UserUID  = $data['User']['UserUID'];
                  ?>
                <li class="  ">
                  <a href="/user/<?php echo e($UserUID); ?>"><?php echo e($DisplayName); ?></a>
                <div style="border-bottom: 1px solid white;"</div>
                <?php if(in_array($data['User']['Status'], $data['User']['is_staff'])): ?>
                  <li class="  ">
                  <a href="/user/account">Staff Panel</a>
                <?php endif; ?>
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
                  <a href="/user/settings#general">Settings</a>
                <li class="  ">
                  <a href="/user/promotions">Promotions</a>
                <li class="logout">
                  <a href="/auth/logout">Logout</a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

<?php elseif($data['pageData']['nav'] === false): ?>
  <!-- Nav is disabled -->
<?php endif; ?>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/nav.blade.php ENDPATH**/ ?>