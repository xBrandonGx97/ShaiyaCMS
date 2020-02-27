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
        <div class="alert alert-dark text-center" id="pin" style="display:none;font-size:24px;" role="alert">
            Alert
        </div>
        <div class="nk-gap-4"></div>
        <?php 
            Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
            Display('move_topic_modal','<i class="fas fa-user-plus"></i>','0','2','Move Topic');
         ?>

        <div class="container">
            <div class="row">
                <div class="col-md-3 order-md-2 text-right">
                    <a href="#forum-reply" class="nk-btn nk-btn-lg link-effect-4 nk-anchor">Reply</a>
                </div>
                <div class="col-md-9 ">
                    <div class="nk-pagination nk-pagination-left">
                        <a href="#" class="nk-pagination-prev disabled">
                            <span class="nk-icon-arrow-left"></span>
                        </a>
                        <nav>
                            <a class="nk-pagination-current-white" href="#">1</a>
                        </nav>
                        <a href="#" class="nk-pagination-next">
                            <span class="nk-icon-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php 
                $topicID  =   $data['topicID'];
                $data['forum']->getPosts($topicID);
                $data['forum']->isTopicPinned($topicID,1);
                $data['forum']->isTopicClosed($topicID,1);
                $url = checkUrl();
                $data['forum']->getTopicTitle($url[3]);

             ?>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="mod-actions col-md-3 order-md-2 text-right">
                    <div class="dropdown">
                        <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                        <div class="dropdown-content text-center">
                            <a href="#" class="link-effect-4 ready pin_topic" data-pinned="<?php echo e($data['forum']->pinned ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="pin-text1"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-r"><span class="pin-text2"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-shade"><span class="pin-text3"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span></span></a>
                            <a href="#" class="link-effect-4 ready open_move_topic_modal" data-id="<?php echo e($data['forum']->topicTitle->PostTitle); ?>" data-target="#move_topic_modal" data-toggle="modal"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready close_topic" data-closed="<?php echo e($data['forum']->closed ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-r"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-shade"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- START: Forums List -->
            <?php if(count($data['forum']->data) > 0): ?>
                <ul class="nk-forum nk-forum-topic">
                <?php $__currentLoopData = $data['forum']->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $data['forum']->memberSince($post->PostAuthor);
                        $data['forum']->userStatus($post->PostAuthor);
                        $data['forum']->loginStatus($post->PostAuthor);
                        $data['forum']->getUserRoles($post->PostAuthor);
                        $data['forum']->getUserTitle($post->PostAuthor);
                        $data['forum']->getUserSocials($post->PostAuthor);
                        $data['forum']->getUserLikes($post->PostAuthor);
                        $data['forum']->getPostLikes($post->PostID);
                        $data['forum']->getUserPosts($post->PostAuthor);
                        $data['forum']->getUserSignature($post->PostAuthor);
                        $data['forum']->getDisplayName($post->PostAuthor);
                        $data['forum']->didUserLikePost($data['User']['UserUID'],$post->PostID);
                     ?>
                    <li class="<?php echo e($post->PostID); ?>">
                        <div class="nk-forum-topic-author" style="width:150px !important;">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            <div class="nk-forum-topic-author-name" title="<?php echo e($post->PostAuthor); ?>">
                                
                                <?php if($data['forum']->displayName): ?>
                                    <a href=""><?php echo $data['forum']->displayName->DisplayName; ?></a>
                                <?php else: ?>
                                    <a href=""><?php echo e($post->PostAuthor); ?></a>
                                <?php endif; ?>
                                <?php if($data['forum']->loginStatus == 1): ?>
                                    <i class="fa fa-circle text-success" aria-hidden="true" title="Online"></i>
                                <?php else: ?>
                                    <i class="fa fa-circle text-danger" aria-hidden="true" title="Offline"></i>
                                <?php endif; ?>
                            </div>
                            
                            <?php if($data['forum']->fetchUserRoles($post->PostAuthor)): ?>
                                <?php $__currentLoopData = $data['forum']->userRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role->DisplayName == $post->PostAuthor): ?>
                                        <div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/<?php echo e($role->RoleName); ?>.png" style="width:125px"></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                                 
                            <div class="nk-forum-topic-author-role"><span><?php echo e($data['forum']->UserTitle); ?></span></div>
                            <!-- <span class="username--style3 username--staff username--moderator username--admin">ENXF NET</span> -->
                            <div class="nk-forum-topic-author-since">
                                Member since <?php echo e(date("F d, Y", strtotime($data['forum']->memberSince->JoinDate))); ?>

                            </div>
                            <div class="nk-forum-topic-author-posts">
                                Posts: <?php echo e($data['forum']->posts->Posts); ?>

                            </div>
                            <div class="nk-forum-topic-author-likes<?php echo e($post->PostID); ?> author_likes">
                                Likes: <?php echo e($data['forum']->likes->Likes); ?>

                            </div>
                            <div class="nk-forum-topic-author-social">
                                <?php $__currentLoopData = $data['forum']->socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($social->Social == 'Discord'): ?>
                                        <a href="#" class="open_discord_modal" title="<?php echo e($social->SocialValue); ?>"  data-id="<?php echo e($social->SocialValue); ?>~<?php echo e($post->PostAuthor); ?>" data-target="#discord_modal" data-toggle="modal"><i class="fab fa-discord"></i></a>
                                    <?php elseif($social->Social == 'Skype'): ?>
                                        <a href="skype:<?php echo e($social->SocialValue); ?>?chat" title="<?php echo e($social->SocialValue); ?>"><i class="fab fa-skype"></i></a>
                                    <?php elseif($social->Social == 'Steam'): ?>
                                        <a href="" title="<?php echo e($social->SocialValue); ?>"><i class="fab fa-steam"></i></a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </div>
                        </div>
                        <div class="nk-forum-topic-content">
                            <p><?php echo $post->PostBody; ?></p>

                            
                        </div>
                        <div class="nk-forum-topic-footer">
                            <span class="nk-forum-topic-date"><?php echo e(date("M d, Y", strtotime($post->PostDate))); ?></span>
                            <?php if(!$data['forum']->signature): ?>
                            <?php else: ?>
                                <div class="text-center">
                                    <span class="nk-forum-topic-sig"><?php echo $data['forum']->signature->Signature; ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if($data['User']['LoginStatus']==true): ?>
                                <span class="nk-forum-action-btn">
                                    <a href="#forum-reply" class="nk-anchor"><span class="fa fa-reply"></span> Reply</a>
                                </span>
                                <span class="nk-forum-action-btn">
                                    <a href="#"><span class="fa fa-flag"></span> Spam</a>
                                </span>
                                <?php 
                                    $data['forum']->displayNameToUserUID($post->PostAuthor);
                                    $postUserUID    =   $data['forum']->convertedName->UserUID;
                                 ?>
                                <?php if($data['User']['UserUID']!==$postUserUID || $postUserUID !== $data['User']['UserUID']): ?>
                                    <span class="nk-forum-action-btn heart like-button like" data-liked="<?php echo e($data['forum']->checkPost ? 'true' : 'false'); ?>" data-id="<?php echo e($post->PostID); ?>" data-uid="<?php echo e($post->PostID); ?>~<?php echo e($data['User']['UserUID']); ?>~<?php echo e($postUserUID); ?>~<?php echo e($post->PostAuthor); ?>">
                                        <span class="nk-action-heart">
                                            <span class="num<?php echo e($post->PostID); ?>"><?php echo e($data['forum']->postLikes->Likes); ?></span>
                                            <span class="<?php echo e($data['forum']->checkPost ? 'like-icon ion-android-favorite' : 'like-icon ion-android-favorite-outline'); ?>"></span>
                                            <span class="liked-icon ion-android-favorite"></span>
                                            <text class="like-text<?php echo e($post->PostID); ?>"><?php echo e($data['forum']->checkPost ? 'Unlike' : 'Like'); ?></text>
                                        </span>
                                    </span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="nk-forum-action-btn">
                                    <span class="nk-action-heart">
                                        <span class="num"><?php echo e($data['forum']->postLikes->Likes); ?></span>
                                        <span class="like-icon ion-android-favorite-outline"></span>
                                        <span class="liked-icon ion-android-favorite"></span>
                                    </span>
                                </span>
                            <?php endif; ?>
                        </div>
                    </li>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <?php else: ?>
                    
                    <p>Topic not found. Please check back later.</p>
            <?php endif; ?>
            <!-- END: Forums List -->
            <?php if(count($data['forum']->data) > 0): ?>
                <div id="forum-reply"></div>
                <div class="nk-gap-4"></div>
                <?php if($data['User']['LoginStatus']==true): ?>
                    <?php if($data['forum']->closed==false): ?>
                        <!-- START: Reply -->
                        <h3 class="h4">Reply</h3>
                        <p id="response"></p>
                        <form method="post">
                            <div class="nk-gap-1"></div>
                            <textarea class="nk-summernote" name="content" id="content"></textarea>
                            <div class="nk-gap-1"></div>
                            <button class="nk-btn nk-btn-lg link-effect-4" id="reply_submit">Reply</button>
                            <input type="hidden" name="topicid" id="topicid" value="<?php echo e($topicID); ?>"/>
                            <input type="hidden" name="postauthor" id="postauthor" value="<?php echo e($data['User']['DisplayName']); ?>"/>
                        </form>
                    <?php else: ?>
                        Sorry! Topic is closed and isn't up for more responses.
                    <?php endif; ?>
                <?php else: ?>
                    <h4 class="text-center">You must be logged in to reply.</h4>
                <?php endif; ?>
                <!-- END: Reply -->
            <?php endif; ?>
        </div>
    <?php  Separator(120);  ?>
    </div>
    <script>
        $(document).ready(function(){
            $("button#reply_submit").click(function(e){
                e.preventDefault();

                var content            = $("#content").val();
                var topicid            = $("#topicid").val();
                var postauthor         = $("#postauthor").val();

                $.ajax(
                    {
                        url: '/resources/jquery/addons/ajax/site/forum/reply.submit.php',
                        method: 'POST',
                        data: {
                            sent: 1,
                            topicid: topicid,
                            postbody: content,
                            postauthor: postauthor
                        },
                        success: function(response) {
                            $("#response").html(response);
                        },
                        dataType: 'text'
                    }
                )
            });
            $(".like-button").click(e => {
                e.preventDefault();

                const curTrgt = $(e.currentTarget);
                const isLiked = curTrgt.data('liked');
                let postID  =   curTrgt.data('id');
                //console.log(typeof(isLiked));

                // Replace ./data.json with your JSON feed
                fetch('/resources/jquery/addons/ajax/site/forum/post.like.php', {
                    method: 'post',
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        postID,
                        likedUser: $("#likedUser").val(),
                        uid:       curTrgt.data("uid"),
                        action:    isLiked ? "unlike" : "like"
                    })
                })
                .then(r => r.json())
                /*.then(response => {
                    return response.json()
                })*/
                .then(data => {
                    // Work with JSON data here
                    //console.log(data)
                    $('li.' + postID).prepend(data.errors);
                    //console.log("counter:"+data.newCount);
                    $(".num" + postID).text(data.newCount);
                    $(".nk-forum-topic-author-likes" + postID).text("Likes: " + data.newCount);
                    if (data.liked === 'true') {
                        curTrgt.data("liked", true);
                        $(".like-text" + postID).text("Unlike");
                    } else {
                        curTrgt.data("liked", false);
                        $(".like-text" + postID).text("Like");
                    }
                })
                .catch(err => {
                    // Do something for an error here
                })
            })
            $(document).on('click', '.open_discord_modal', function (e) {
                e.preventDefault();

                var uid = $(this).data("id");

                $('#discord_modal #dynamic-content').html('');
                $('#discord_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_social_discord.php",
                    type: 'POST',
                    data: "id="+uid,
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#discord_modal #dynamic-content').html('');
                    $('#discord_modal #dynamic-content').html(data);
                    $('#discord_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#discord_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#discord_modal #modal-loader').hide();
                });
            });
            $(document).on('click', '.open_move_topic_modal', function (e) {
                e.preventDefault();

                var uid = $(this).data("id");

                $('#move_topic_modal #dynamic-content').html('');
                $('#move_topic_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_move_topic.php",
                    type: 'POST',
                    data: "id="+uid,
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#move_topic_modal #dynamic-content').html('');
                    $('#move_topic_modal #dynamic-content').html(data);
                    $('#move_topic_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#move_topic_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#move_topic_modal #modal-loader').hide();
                });
            });
            $(".pin_topic").click(e => {
                e.preventDefault();

                const curTrgt = $(e.currentTarget);
                const isPinned = curTrgt.data('pinned');

                // Replace ./data.json with your JSON feed
                fetch('/resources/jquery/addons/ajax/site/forum/topic/pin.topic.php', {
                    method: 'post',
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        topicID: curTrgt.data('id'),
                        action:    isPinned ? "unpin" : "pin"
                    })
                })
                .then(r => r.json())
                /*.then(response => {
                    return response.json()
                })*/
                .then(data => {
                    // Work with JSON data here
                    console.log(data)
                    $(".alert").show();
                    if (data.pinned === 'false') {
                        curTrgt.data("pinned", false);
                        $(".pin-text1").text("Pin Topic");
                        $(".pin-text2").text("Pin Topic");
                        $(".pin-text3").text("Pin Topic");
                        $(".alert").text('Topic has been unpinned successfully.');
                    } else {
                        curTrgt.data("pinned", true);
                        $(".pin-text1").text("Unpin Topic");
                        $(".pin-text2").text("Unpin Topic");
                        $(".pin-text3").text("Unpin Topic");
                        $(".alert").text('Topic has been pinned successfully.');
                    }
                })
                .catch(err => {
                    // Do something for an error here
                })
            })
            $(".close_topic").click(e => {
                e.preventDefault();

                const curTrgt = $(e.currentTarget);
                const isClosed = curTrgt.data('closed');

                // Replace ./data.json with your JSON feed
                fetch('/resources/jquery/addons/ajax/site/forum/topic/close.topic.php', {
                    method: 'post',
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        topicID: curTrgt.data('id'),
                        action:    isClosed ? "open" : "closed"
                    })
                })
                .then(r => r.json())
                /*.then(response => {
                    return response.json()
                })*/
                .then(data => {
                    // Work with JSON data here
                    console.log(data)
                    $(".alert").show();
                    if (data.closed === 'false') {
                        curTrgt.data("closed", false);
                        $(".close-text").text("Close Topic");
                        $(".alert").text('Topic has been opened successfully.');
                    } else {
                        curTrgt.data("closed", true);
                        $(".close-text").text("Open Topic");
                        $(".alert").text('Topic has been closed successfully.');
                    }
                })
                .catch(err => {
                    // Do something for an error here
                })
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>