<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('home.inc.page_bg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.inc.page_border', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('inc.cms.topNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('inc.cms.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <?php echo $__env->make('inc.cms.rightNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('inc.cms.mobileNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="nk-main">
        <div class="nk-info-box bg-main-1 alert text-center" id="pin" style="display:none;font-size:24px;">
            <div class="nk-info-box-icon" style="display:inline-block !important;">
                <i class="ion-information-circled"></i>
            </div>
            <span class="alert-text">Alert</span>
        </div>
        <div class="nk-gap-4"></div>
        <?php 
            $isLoggedIn     =   $data['User']['LoginStatus'];
            $url = checkUrl();
            $forumID    =   $data['forum']->getForumID($url[3]);
            $forumName  =   $data['forum']->getForumName($url[3],1);
            $topicTitle =   $data['forum']->getTopicTitle($url[3]);

            $onlineStaff    =   $data['forum']->getOnlineStaff();
            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($onlineStaff) : '';

            $topicID  =   $data['topicID'];
         ?>
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/forum/topics/<?php echo e($forumID); ?>"><?php echo e($forumName); ?></a></li>
                <li><span><?php echo \Classes\Utils\Data::$purifier->purify($topicTitle); ?></span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <?php 
            // leave here
         ?>
        <div class="table-responsive" id="pagination_data" data-id="<?php echo e($topicID); ?>">

        </div>
            
        </div>
    <?php  Separator(120);  ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>