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
        <div class="container">
            <?php 
                Display('new_topic_modal','<i class="fas fa-plus"></i>','0','2','Create New Topic');
                $url = checkUrl();
             ?>
            <?php if($data['User']['LoginStatus']==true): ?>
                <button class="nk-btn nk-btn-lg link-effect-4 float-right open_new_topic_modal" id="reply_submit" data-id="<?php echo e($url[2]); ?>~<?php echo e($data['User']['DisplayName']); ?>" data-target="#new_topic_modal" data-toggle="modal">Create New Topic</button>
            <?php endif; ?>
            <div class="nk-gap-4"></div>
            <?php 
                $topicID  =   $data['topicID'];
                $data['forum']->getTopics($topicID);
                $data['forum']->getPinnedTopics($topicID);
             ?>
            <!-- START: Forums List -->
            <?php if(count($data['forum']->fetch) > 0): ?>
                <ul class="nk-forum">
                    <?php $__currentLoopData = $data['forum']->fetch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $data['forum']->getPostCount($topic->TopicID);
                            $data['forum']->getPostTitle($topic->TopicID);
                            $data['forum']->getPostBody($topic->TopicID);
                            $data['forum']->getPostDate($topic->TopicID);
                         ?>
                        <li>
                            <div class="nk-forum-icon">
                                <span class="ion-pin"></span>
                            </div>
                            <div class="nk-forum-title">
                                <h3><a href="/forum/topics/view_topic/<?php echo e($topic->TopicID); ?>"><?php echo e($topic->PostTitle); ?></a></h3>
                                <div class="nk-forum-title-sub">Started by <a href="#"><?php echo e($topic->PostAuthor); ?></a> on <?php echo e(date("M d, Y", strtotime($topic->PostDate))); ?></div>
                            </div>
                            <div class="nk-forum-count">
                                <?php if($data['forum']->postCount->Posts == 1): ?>
                                    <?php echo e($data['forum']->postCount->Posts); ?> post
                                <?php else: ?>
                                    <?php echo e($data['forum']->postCount->Posts); ?> posts
                                <?php endif; ?>
                            </div>
                            <div class="nk-forum-activity-avatar">
                                <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            </div>
                            <div class="nk-forum-activity">
                                <div class="nk-forum-activity-title" title="<?php echo e($data['forum']->postTitle->PostTitle); ?>">
                                    <?php if(!empty($data['forum']->postTitle)): ?>
                                        <a href="forum-single-topic.html"><?php echo e($data['forum']->postBody->PostBody); ?></a>
                                    <?php else: ?>
                                        —

                                    <?php endif; ?>
                                </div>
                                <div class="nk-forum-activity-date">
                                    <?php if(!empty($data['forum']->postDate)): ?>
                                        <?php echo e(date("M d, Y", strtotime($data['forum']->postDate->PostDate))); ?>

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
                        $data['forum']->getPostCount($topic->TopicID);
                        $data['forum']->getPostTitle($topic->TopicID);
                        $data['forum']->getPostBody($topic->TopicID);
                        $data['forum']->getPostDate($topic->TopicID);
                     ?>
                    <li <?php echo e($topic->Closed==1 ? 'class=nk-forum-locked' : ''); ?>>
                        <div class="nk-forum-icon">
                            <span class="<?php echo e($topic->Closed==1 ? 'ion-locked' : 'ion-ios-game-controller-b'); ?>"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="/forum/topics/view_topic/<?php echo e($topic->TopicID); ?>"><?php echo e($topic->PostTitle); ?></a></h3>
                            <div class="nk-forum-title-sub">Started by <a href="#"><?php echo e($topic->TopicAuthor); ?></a> on <?php echo e(date("M d, Y", strtotime($topic->TopicDate))); ?></div>
                        </div>
                        <div class="nk-forum-count">
                            <?php if($data['forum']->postCount->Posts == 1): ?>
                                <?php echo e($data['forum']->postCount->Posts); ?> post
                            <?php else: ?>
                                <?php echo e($data['forum']->postCount->Posts); ?> posts
                            <?php endif; ?>
                        </div>
                        <div class="nk-forum-activity-avatar">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                        </div>
                        <div class="nk-forum-activity">
                            <div class="nk-forum-activity-title" title="<?php echo e($data['forum']->postTitle->PostTitle); ?>">
                                <?php if(!empty($data['forum']->postTitle)): ?>
                                    <a href="forum-single-topic.html"><?php echo e($data['forum']->postBody->PostBody); ?></a>
                                <?php else: ?>
                                    —

                                <?php endif; ?>
                            </div>
                            <div class="nk-forum-activity-date">
                                <?php if(!empty($data['forum']->postDate)): ?>
                                    <?php echo e(date("M d, Y", strtotime($data['forum']->postDate->PostDate))); ?>

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