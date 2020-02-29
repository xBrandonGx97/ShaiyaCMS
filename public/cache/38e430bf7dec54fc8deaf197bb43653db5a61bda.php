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
            Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
            Display('move_topic_modal','<i class="fas fa-sync"></i>','0','2','Move Topic');
            $isLoggedIn     =   $data['User']['LoginStatus'];
            $url = checkUrl();
            $forumID    =   $data['forum']->getForumID($url[3]);
            $forumName  =   $data['forum']->getForumName($url[3],1);
            $topicTitle =   $data['forum']->getTopicTitle($url[3]);

            $onlineStaff    =   $data['forum']->getOnlineStaff();
            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($onlineStaff) : '';
         ?>
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/forum/topics/<?php echo e($forumID); ?>"><?php echo e($forumName); ?></a></li>
                <li><span><?php echo e($topicTitle); ?></span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="container">
            <div class="row">
                <?php if($isLoggedIn): ?>
                    <div class="col-md-3 order-md-2 text-right">
                        <a href="#forum-reply" class="nk-btn nk-btn-lg link-effect-4 nk-anchor">Reply</a>
                    </div>
                <?php endif; ?>
                <?php
                        #$data['forum']->fetchAjax();
                ?>
                <div class="table-responsive" id="pagination_data" data-id="1">

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
                $topicTitle =   $data['forum']->getTopicTitle($topicID);
                $forumID    =   $data['forum']->getForumID($topicID);

                $isMod          =   $isLoggedIn ? $data['forum']->isMod($data['User']['UserUID']) : '';

                $closed         =   $data['forum']->closed;

             ?>
            <?php if($isMod): ?>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="mod-actions col-md-3 order-md-2 text-right">
                        <div class="dropdown">
                            <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                            <div class="dropdown-content text-center">
                                <a href="#" class="link-effect-4 ready pin_topic" data-pinned="<?php echo e($data['forum']->pinned ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="pin-text1"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-r"><span class="pin-text2"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-shade"><span class="pin-text3"><?php echo e($data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span></span></a>
                                <a href="#" class="link-effect-4 ready open_move_topic_modal" data-id="<?php echo e($topicTitle); ?>~<?php echo e($topicID); ?>~<?php echo e($forumID); ?>" data-target="#move_topic_modal" data-toggle="modal"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                                <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                                <a href="#" class="link-effect-4 ready close_topic" data-closed="<?php echo e($data['forum']->closed ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-r"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-shade"><span class="close-text"><?php echo e($data['forum']->closed ? 'Open Topic' : 'Close Topic'); ?></span></span></span></a>
                                <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- START: Forums List -->
            
            <!-- END: Forums List -->
            <?php if(count($data['forum']->data) > 0): ?>
                <div id="forum-reply"></div>
                <div class="nk-gap-4"></div>
                <?php if($isLoggedIn==true): ?>
                    <?php if($closed==false): ?>
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
        </div>
    <?php  Separator(120);  ?>
    </div>
    <script>
        $(document).ready(function(){
            const records_per_page = 3;
            let page = 1;
            load_data(1);
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
                        $(".alert-text").text('Topic has been unpinned successfully.');
                    } else {
                        curTrgt.data("pinned", true);
                        $(".pin-text1").text("Unpin Topic");
                        $(".pin-text2").text("Unpin Topic");
                        $(".pin-text3").text("Unpin Topic");
                        $(".alert-text").text('Topic has been pinned successfully.');
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
                        $(".alert-text").text('Topic has been opened successfully.');
                    } else {
                        curTrgt.data("closed", true);
                        $(".close-text").text("Open Topic");
                        $(".alert-text").text('Topic has been closed successfully.');
                    }
                })
                .catch(err => {
                    // Do something for an error here
                })
            })
            $(".edit-btn").click(e => {
                e.preventDefault();

                const curTrgt = $(e.currentTarget);
                const isClicked = $('.fa-edit').data('clicked');
                let postID  =   curTrgt.data('id');
                if(isClicked===true){
                    $('.fa-edit').data("clicked", false);
                    $(".bdy" + postID).hide();
                    var scriptTag = "<script src='/resources/themes/Godlike/js/godlike-init.js'></" + "script>";
                    $(".txt" + postID).show();
                    $(".txt" + postID).html(scriptTag + '<textarea class="nk-summernote" name="content" id="content"></textarea>');
                    $(".edit_icon").replaceWith("<span class=\"fa fa-times edit_icon\" data-clicked=\"true\"></span>");
                    $(".edit-txt").text("Close");
                    $(".action_save").show();
                } else {
                    $('.fa-edit').data("clicked", true);
                    $(".bdy" + postID).show();
                    $(".txt" + postID).hide();
                    $(".edit_icon").replaceWith("<span class=\"fa fa-edit edit_icon\" data-clicked=\"true\"></span>");
                    $(".edit-txt").text("Edit");
                    $(".action_save").hide();
                }
                console.log(isClicked);
                //$(".body-text").show();
            })
            $(".action_save").click(e => {
                e.preventDefault();

                alert("woo");

                const curTrgt = $(e.currentTarget);
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>