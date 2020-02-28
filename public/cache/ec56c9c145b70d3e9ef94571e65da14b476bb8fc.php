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
        <div class="nk-gap-4"></div>
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><span>Forum</span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <!-- START: Forums List -->
                        <?php 
                            $data['forum']->getUserRoles($data['User']['UserUID']);
                            $data['forum']->ifCanCreateForum();
                            Display('create_forum_modal','<i class="fas fa-folder-plus"></i>','0','2','Create Forum');

                            $isLoggedIn     =   $data['User']['LoginStatus'];

                            $isMod          =   $isLoggedIn ? $data['forum']->isMod($data['User']['UserUID']) : '';
                            $data['forum']->getOnlineStaff();
                            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($data['forum']->getOnlineStaff()) : '';
                         ?>

                        <?php if($isLoggedIn==true): ?>
                            <?php if($isMod): ?>
                                <button class="nk-btn nk-btn-lg link-effect-4 float-right open_create_forum_modal" data-target="#create_forum_modal" data-toggle="modal" id="reply_submit">Create New Forum</button>
                            <?php endif; ?>
                        <?php endif; ?>

                        

                        <div class="nk-gap-4"></div>
                        <?php if(count($data['forum']->fet) > 0): ?>
                            <ul class="nk-forum">
                            <?php $__currentLoopData = $data['forum']->fet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    //$data['forum']->getOnlineStaff();
                                    $ForumID        =   $forum->ForumID;
                                    $ForumName      =   $forum->ForumName;
                                    $SubText        =   $forum->SubText;
                                    $Locked         =   $forum->Locked;
                                    $topicCount     =   $data['forum']->getTopicCount($forum->ForumID);
                                    $topicTitle     =   $data['forum']->getTopicTitle($forum->ForumID);
                                    $topicDate      =   $data['forum']->getTopicDate($forum->ForumID);

                                    $checkTopicCount =  $topicCount==1 ? $topicCount.' topic' : $topicCount.' topics';
                                    $checkTopicTitle =  $topicTitle ? '<a href="forum-single-topic.html">'.$topicTitle.'</a>' : '—';
                                    $checkTopicDate  =  $topicDate ? date("M d, Y", strtotime($topicDate)) : '';
                                 ?>
                                <?php if($Locked == 0): ?>
                                    <li>
                                        <div class="nk-forum-icon">
                                            <span class="ion-ios-game-controller-b"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                            <h3><a href="/forum/topics/<?php echo e($ForumID); ?>"><?php echo e($ForumName); ?></a></h3>
                                            <div class="nk-forum-title-sub"><?php echo e($SubText); ?></div>
                                        </div>
                                        <div class="nk-forum-count">
                                            <?php echo e($checkTopicCount); ?>

                                         </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="GodLike the only game that I want to play!">
                                                <?php echo $checkTopicTitle; ?>

                                            </div>
                                            <div class="nk-forum-activity-date">
                                                <?php echo e($checkTopicDate); ?>

                                            </div>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <li class="nk-forum-locked">
                                        <div class="nk-forum-icon">
                                            <span class="ion-help-buoy"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                             <h3><a href="/forum/topics/<?php echo e($ForumID); ?>"><?php echo e($ForumName); ?></a></h3>
                                            <div class="nk-forum-title-sub"><?php echo e($SubText); ?></div>
                                        </div>
                                        <div class="nk-forum-count">
                                            <?php echo e($checkTopicCount); ?>

                                        </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="Kurt Tucker">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="Install on Windows 95">
                                                <?php echo $checkTopicTitle; ?>

                                            </div>
                                            <div class="nk-forum-activity-date">
                                                <?php echo e($checkTopicDate); ?>

                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p>No Forums found. Please check back later.</p>
                        <?php endif; ?>
                        <div class="nk-gap-2"></div>
                        
                        
                        <!-- END: Forums List -->
                    </div>
                    <div class="col-lg-3">
                        <!--
                            START: Sidebar

                            Additional Classes:
                                .nk-sidebar-left
                                .nk-sidebar-right
                                .nk-sidebar-sticky
                        -->
                        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
                            <div class="nk-gap-4"></div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Staff Online</h4>
                                <div>
                                    <!-- content -->
                                    <?php if(count($data['forum']->onlineStaff) > 0): ?>
                                        <?php $__currentLoopData = $data['forum']->onlineStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data['forum']->convertDisplayName($staff->DisplayName)): ?>
                                                <span><?php echo $data['forum']->convertDisplayName($staff->DisplayName); ?></span><br>
                                            <?php else: ?>
                                                <span><?php echo $staff->DisplayName; ?></span><br>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span>There are currently no online staff.</span>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Members Online</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Latest Posts</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                            <div class="nk-widget nk-box-1 bg-dark-1">
                                <h4 class="nk-widget-title">Forum Statistics</h4>
                                <div>
                                    <!-- content -->
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
    <?php  Separator(120);  ?>
    </div>
    <script>
        $(document).ready(function(){
          $(document).on('click', '.open_create_forum_modal', function (e) {
                e.preventDefault();

                $('#create_forum_modal #dynamic-content').html('');
                $('#create_forum_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_create.php",
                    type: 'POST',
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#move_topic_modal #dynamic-content').html('');
                    $('#create_forum_modal #dynamic-content').html(data);
                    $('#create_forum_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#create_forum_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#create_forum_modal #modal-loader').hide();
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>