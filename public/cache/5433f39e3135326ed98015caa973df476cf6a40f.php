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
        <?php echo $__env->make('inc.cms.signForms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="nk-gap-4"></div>
        <?php 
            $url = checkUrl();
            $forumName  =   $data['forum']->getForumName($url[2]);
         ?>
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><span><?php echo e($forumName); ?></span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="container">
            <?php 
                Display('new_topic_modal','<i class="fas fa-plus"></i>','0','2','Create New Topic');

                $isLoggedIn     =   $data['User']['LoginStatus'];

                $topicID  =   $data['topicID'];
                $data['forum']->getTopics($topicID);
                $data['forum']->getPinnedTopics($topicID);

                $onlineStaff    =   $data['forum']->getOnlineStaff();
                $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($onlineStaff) : '';
             ?>
            <?php if($isLoggedIn==true): ?>
                <button class="nk-btn nk-btn-lg link-effect-4 float-right open_new_topic_modal" id="reply_submit" data-id="<?php echo e($url[2]); ?>~<?php echo e($data['User']['DisplayName']); ?>" data-target="#new_topic_modal" data-toggle="modal">Create New Topic</button>
            <?php endif; ?>
            <div class="nk-gap-4"></div>
            <!-- START: Forums List -->
            <?php if(count($data['forum']->fetch) > 0): ?>
                <ul class="nk-forum">
                    <?php $__currentLoopData = $data['forum']->fetch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $postCount  =   $data['forum']->getPostCount($topic->TopicID);
                            $postTitle  =   $data['forum']->getPostTitle($topic->TopicID);
                            $postBody   =   $data['forum']->getPostBody($topic->TopicID);
                            $postDate   =   $data['forum']->getPostDate($topic->TopicID);

                            $topicID        =   $topic->TopicID;
                            $postTitle      =   $topic->PostTitle;
                            $topicAuthor    =   $topic->PostAuthor;
                            $topicDate      =   $topic->PostDate;
                         ?>
                        <li>
                            <div class="nk-forum-icon">
                                <span class="ion-pin"></span>
                            </div>
                            <div class="nk-forum-title">
                                <h3><a href="/forum/topics/view_topic/<?php echo e($topicID); ?>"><?php echo e($postTitle); ?></a></h3>
                                <div class="nk-forum-title-sub">Started by <a href="#"><?php echo e($topicAuthor); ?></a> on <?php echo e(date("M d, Y", strtotime($topicDate))); ?></div>
                            </div>
                            <div class="nk-forum-count">
                                <?php if($postCount == 1): ?>
                                    <?php echo e($postCount); ?> post
                                <?php else: ?>
                                    <?php echo e($postCount); ?> posts
                                <?php endif; ?>
                            </div>
                            <div class="nk-forum-activity-avatar">
                                <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            </div>
                            <div class="nk-forum-activity">
                                <div class="nk-forum-activity-title" title="<?php echo e($postTitle); ?>">
                                    <?php if(!empty($postTitle)): ?>
                                        <a href="forum-single-topic.html"><?php echo e($postBody); ?></a>
                                    <?php else: ?>
                                        —

                                    <?php endif; ?>
                                </div>
                                <div class="nk-forum-activity-date">
                                    <?php if(!empty($postDate)): ?>
                                        <?php echo e(date("M d, Y", strtotime($postDate))); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
            <div class="nk-gap-2"></div>
            <?php if(count($data['forum']->row) > 0): ?>
                <ul class="nk-forum">
                <?php $__currentLoopData = $data['forum']->row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        // Fetch Data
                        $postCount  =   $data['forum']->getPostCount($topic->TopicID);
                        $postTitle  =   $data['forum']->getPostTitle($topic->TopicID);
                        $postBody   =   $data['forum']->getPostBody($topic->TopicID);
                        $postDate   =   $data['forum']->getPostDate($topic->TopicID);

                        // Display Data
                        $newTitle   =   \Classes\Utils\Data::$purifier->purify($postTitle);

                        $Closed         =   $topic->Closed==1;
                        $closedCheck    =   $Closed? 'class=nk-forum-locked' : '';
                        $closedAction   =   $Closed ? 'ion-locked' : 'ion-ios-game-controller-b';
                        $topicID        =   $topic->TopicID;
                        $postTitle      =   $topic->PostTitle;
                        $topicAuthor    =   $topic->TopicAuthor;
                        $topicDate      =   $topic->TopicDate;
                     ?>
                    <li <?php echo e($closedCheck); ?>>
                        <div class="nk-forum-icon">
                            <span class="<?php echo e($closedAction); ?>"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="/forum/topics/view_topic/<?php echo e($topicID); ?>"><?php echo $newTitle; ?></a></h3>
                            <div class="nk-forum-title-sub">Started by <a href="#"><?php echo e($topicAuthor); ?></a> on <?php echo e(date("M d, Y", strtotime($topicDate))); ?></div>
                        </div>
                        <div class="nk-forum-count">
                            <?php if($postCount == 1): ?>
                                <?php echo e($postCount); ?> post
                            <?php else: ?>
                                <?php echo e($postCount); ?> posts
                            <?php endif; ?>
                        </div>
                        <div class="nk-forum-activity-avatar">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                        </div>
                        <div class="nk-forum-activity">
                            <div class="nk-forum-activity-title" title="<?php echo e($postTitle); ?>">
                                <?php if(!empty($postTitle)): ?>
                                    <a href="forum-single-topic.html"><?php echo e($postBody); ?></a>
                                <?php else: ?>
                                    —

                                <?php endif; ?>
                            </div>
                            <div class="nk-forum-activity-date">
                                <?php if(!empty($postDate)): ?>
                                    <?php echo e(date("M d, Y", strtotime($postDate))); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                
            <?php endif; ?>
            <?php if(!count($data['forum']->row) > 0 && !count($data['forum']->fetch) > 0): ?>
                <p>No Topics found. Please check back later.</p>
            <?php endif; ?>
            <div class="nk-gap-2"></div>
            <div class="online-staff text-center">
                <h6>Current online staff: </h6>
                <?php if($onlineStaff!==false): ?>
                    <?php if($cDisplayName): ?>
                        <span><?php echo $cDisplayName; ?></span>
                    <?php else: ?>
                        <span><?php echo $onlineStaff; ?></span>
                    <?php endif; ?>
                <?php else: ?>
                    <span>There are currently no online staff.</span>
                <?php endif; ?>
            </div>
            
            <!-- END: Forums List -->
        </div>
    <?php  Separator(120);  ?>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.open_new_topic_modal', function (e) {
                e.preventDefault();

                var uid = $(this).data("id");

                $('#new_topic_modal #dynamic-content').html('');
                $('#new_topic_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_new_topic.php",
                    type: 'POST',
                    data: "id="+uid,
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#new_topic_modal #dynamic-content').html('');
                    $('#new_topic_modal #dynamic-content').html(data);
                    $('#new_topic_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#new_topic_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#new_topic_modal #modal-loader').hide();
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>