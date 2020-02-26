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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <!-- START: Forums List -->
                        <?php 
                            $data['forum']->getUserRoles($data['User']['UserUID']);
                            $data['forum']->ifCanCreateForum();
                         ?>

                        <?php if($data['User']['LoginStatus']==true): ?>
                            <?php if($data['forum']->isMod($data['User']['UserUID'])): ?>
                                <button class="nk-btn nk-btn-lg link-effect-4 float-right" id="reply_submit">Create New Forum</button>
                            <?php endif; ?>
                        <?php endif; ?>

                        

                        <div class="nk-gap-4"></div>
                        <?php if(count($data['forum']->fet) > 0): ?>
                            <ul class="nk-forum">
                            <?php $__currentLoopData = $data['forum']->fet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php 
                                    $data['forum']->getTopicCount($forum->ForumID);
                                    $data['forum']->getTopicTitle($forum->ForumID);
                                    $data['forum']->getTopicDate($forum->ForumID);
                                    $data['forum']->getOnlineStaff();
                                 ?>
                                <?php if($forum->Locked == 0): ?>
                                    <li>
                                        <div class="nk-forum-icon">
                                            <span class="ion-ios-game-controller-b"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                            <h3><a href="/forum/topics/<?php echo e($forum->ForumID); ?>"><?php echo e($forum->ForumName); ?></a></h3>
                                            <div class="nk-forum-title-sub"><?php echo e($forum->SubText); ?></div>
                                        </div>
                                        <div class="nk-forum-count">
                                            <?php if($data['forum']->topicCount->Topics == 1): ?>
                                                <?php echo e($data['forum']->topicCount->Topics); ?> topic
                                            <?php else: ?>
                                                <?php echo e($data['forum']->topicCount->Topics); ?> topics
                                            <?php endif; ?>
                                         </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="GodLike the only game that I want to play!">
                                                <?php if($data['forum']->topicTitle): ?>
                                                    <a href="forum-single-topic.html"><?php echo e($data['forum']->topicTitle->PostTitle); ?></a>
                                                <?php else: ?>
                                                    —
                                                <?php endif; ?>
                                            </div>
                                            <div class="nk-forum-activity-date">
                                                <?php if($data['forum']->topicDate): ?>
                                                    <?php echo e(date("M d, Y", strtotime($data['forum']->topicDate->TopicDate))); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php else: ?>
                                    <li class="nk-forum-locked">
                                        <div class="nk-forum-icon">
                                            <span class="ion-help-buoy"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                            <h3><a href="#"><?php echo e($forum->ForumName); ?></a></h3>
                                            <div class="nk-forum-title-sub"><?php echo e($forum->SubText); ?></div>
                                        </div>
                                        <div class="nk-forum-count">
                                            <?php if($data['forum']->topicCount->Topics == 1): ?>
                                                <?php echo e($data['forum']->topicCount->Topics); ?> topic
                                            <?php else: ?>
                                                <?php echo e($data['forum']->topicCount->Topics); ?> topics
                                            <?php endif; ?>
                                        </div>
                                        <div class="nk-forum-activity-avatar">
                                            <img src="/resources/themes/godlike/images/avatar-2-sm.jpg" alt="Kurt Tucker">
                                        </div>
                                        <div class="nk-forum-activity">
                                            <div class="nk-forum-activity-title" title="Install on Windows 95">
                                                <?php if(!empty($data['forum']->topicTitle)): ?>
                                                    <a href="forum-single-topic.html"><?php echo e($data['forum']->topicTitle->PostTitle); ?></a>
                                                <?php else: ?>
                                                    —
                                                <?php endif; ?>
                                            </div>
                                            <div class="nk-forum-activity-date">
                                                <?php if(!empty($data['forum']->topicDate)): ?>
                                                    <?php echo e(date("M d, Y", strtotime($data['forum']->topicDate->PostDate))); ?>

                                                <?php endif; ?>
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
                        <div class="online-staff text-center">
                            <h6>Current online staff: </h6>
                            <?php if(count($data['forum']->onlineStaff) > 0): ?>
                                <?php $__currentLoopData = $data['forum']->onlineStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $data['forum']->convertDisplayName($staff->DisplayName);
                                     ?>
                                    <?php if($data['forum']->newDisplayName): ?>
                                        <span><?php echo $data['forum']->newDisplayName->DisplayName; ?></span>
                                    <?php else: ?>
                                        <span><?php echo $staff->DisplayName; ?></span>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span>There are currently no online staff.</span>
                            <?php endif; ?>
                        </div>
                        
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>