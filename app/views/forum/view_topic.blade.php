@extends('layouts.app')
@section('content')
    @include('home.inc.page_bg')
    @include('home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
        <div class="nk-info-box bg-main-1 alert text-center" id="pin" style="display:none;font-size:24px;">
            <div class="nk-info-box-icon" style="display:inline-block !important;">
                <i class="ion-information-circled"></i>
            </div>
            <span class="alert-text">Alert</span>
        </div>
        <div class="nk-gap-4"></div>
        @php
            Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
            Display('move_topic_modal','<i class="fas fa-sync"></i>','0','2','Move Topic');
            $isLoggedIn     =   $data['User']['LoginStatus'];
            $url = checkUrl();
            $forumID    =   $data['forum']->getForumID($url[3]);
            $forumName  =   $data['forum']->getForumName($url[3],1);
            $topicTitle =   $data['forum']->getTopicTitle($url[3]);

            $onlineStaff    =   $data['forum']->getOnlineStaff();
            $cDisplayName   =   $isLoggedIn ? $data['forum']->convertDisplayName($onlineStaff) : '';
        @endphp
        <div class="nk-breadcrumbs text-center" style="opacity:0.9 !important;">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/forum/topics/{{$forumID}}">{{$forumName}}</a></li>
                <li><span>{{$topicTitle}}</span></li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="container">
            <div class="row">
                @if($isLoggedIn)
                    <div class="col-md-3 order-md-2 text-right">
                        <a href="#forum-reply" class="nk-btn nk-btn-lg link-effect-4 nk-anchor">Reply</a>
                    </div>
                @endif
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
            @php
                $topicID  =   $data['topicID'];
                $data['forum']->getPosts($topicID);
                $data['forum']->isTopicPinned($topicID,1);
                $data['forum']->isTopicClosed($topicID,1);
                $topicTitle =   $data['forum']->getTopicTitle($topicID);
                $forumID    =   $data['forum']->getForumID($topicID);

                $isMod          =   $isLoggedIn ? $data['forum']->isMod($data['User']['UserUID']) : '';

                $closed         =   $data['forum']->closed;

            @endphp
            @if($isMod)
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="mod-actions col-md-3 order-md-2 text-right">
                        <div class="dropdown">
                            <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                            <div class="dropdown-content text-center">
                                <a href="#" class="link-effect-4 ready pin_topic" data-pinned="{{$data['forum']->pinned ? 'true' : 'false'}}" data-id="{{$topicID}}"><span class="link-effect-inner"><span class="link-effect-l"><span class="pin-text1">{{$data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span><span class="link-effect-r"><span class="pin-text2">{{$data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span><span class="link-effect-shade"><span class="pin-text3">{{$data['forum']->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span></span></a>
                                <a href="#" class="link-effect-4 ready open_move_topic_modal" data-id="{{$topicTitle}}~{{$topicID}}~{{$forumID}}" data-target="#move_topic_modal" data-toggle="modal"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                                <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                                <a href="#" class="link-effect-4 ready close_topic" data-closed="{{$data['forum']->closed ? 'true' : 'false'}}" data-id="{{$topicID}}"><span class="link-effect-inner"><span class="link-effect-l"><span class="close-text">{{$data['forum']->closed ? 'Open Topic' : 'Close Topic'}}</span></span><span class="link-effect-r"><span class="close-text">{{$data['forum']->closed ? 'Open Topic' : 'Close Topic'}}</span></span><span class="link-effect-shade"><span class="close-text">{{$data['forum']->closed ? 'Open Topic' : 'Close Topic'}}</span></span></span></a>
                                <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- START: Forums List -->
            @if(count($data['forum']->data) > 0)
                <ul class="nk-forum nk-forum-topic">
                @foreach($data['forum']->data as $post)
                    @php
                        $postID =   $post->PostID;
                        $postAuthor =   $post->PostAuthor;
                        $postBody   =   $post->PostBody;
                        $postDate   =   $post->PostDate;

                        $memberSince    =   $data['forum']->memberSince($post->PostAuthor);
                        $data['forum']->userStatus($post->PostAuthor);
                        $loginStatus    =   $data['forum']->loginStatus($post->PostAuthor);
                        $userRoles  =   $data['forum']->getUserRoles($post->PostAuthor);
                        $userTitle  =   $data['forum']->getUserTitle($post->PostAuthor);
                        $userSocials    =   $data['forum']->getUserSocials($post->PostAuthor);
                        $postLikes  =   $data['forum']->getPostLikes($postID);;
                        $userLikes  =   $data['forum']->getUserLikes($post->PostAuthor);
                        $userPosts   =   $data['forum']->getUserPosts($post->PostAuthor);
                        $Signature  =   $data['forum']->getUserSignature($post->PostAuthor);
                        $displayName    =   $data['forum']->getDisplayName($post->PostAuthor);
                        $checkPost  =   $data['forum']->didUserLikePost($data['User']['UserUID'],$postID);

                        $checkDisplayName   =   $displayName ? '<a href="">'.$displayName.'</a>' : '<a href="">'.$post->PostAuthor.'</a>';
                        $checkLoginStatus   =   $loginStatus==1 ? '<i class="fa fa-circle text-success" aria-hidden="true" title="Online"></i>' : '<i class="fa fa-circle text-danger" aria-hidden="true" title="Offline"></i>';

                        $postUserUID    =   $data['forum']->displayNameToUserUID($post->PostAuthor);

                        $isUserAuthor   =   $data['User']['UserUID']!==$postUserUID || $postUserUID !== $data['User']['UserUID'];

                        // Data liked
                        $dataLiked      =   $checkPost ? 'true' : 'false';
                        $likesAmount    =   $postLikes;
                        $likeAction     =   $checkPost ? 'Unlike' : 'Like';

                        // Icon Classes
                        $iconClasses    =   $checkPost ? 'like-icon ion-android-favorite' : 'like-icon ion-android-favorite-outline';

                        // ID & author batch
                        $userID         =   $data['User']['UserUID'];
                        $dataBatch      =   implode("~",[$postID, $userID, $postUserUID, $postAuthor]);

                        $fetchUserRoles =   $data['forum']->fetchUserRoles($postAuthor);
                    @endphp
                    <li class="{{$postID}}">
                        <div class="nk-forum-topic-author" style="width:150px !important;">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            <div class="nk-forum-topic-author-name" title="{{$postAuthor}}">
                                {{--<a href="#">{{$post->PostAuthor}} <i class="fa fa-circle text-success" aria-hidden="true"></i></a>--}}
                                {!! $checkDisplayName !!}
                                {!! $checkLoginStatus !!}
                            </div>
                            {{--<div class="nk-forum-topic-author-role"><span>{{$data['forum']->userStatus}}</span></div>--}}
                            @if($fetchUserRoles)
                                @foreach ($userRoles as $role)
                                    @if($role->DisplayName == $postAuthor)
                                        <div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/{{$role->RoleName}}.png" style="width:125px"></div>
                                    @endif
                                @endforeach
                            @endif
                                 {{--<div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/{{$data['forum']->roles[0]}}.png" style="width:100px"></div>--}}
                            <div class="nk-forum-topic-author-role"><span>{{$userTitle}}</span></div>
                            <!-- <span class="username--style3 username--staff username--moderator username--admin">ENXF NET</span> -->
                            <div class="nk-forum-topic-author-since">
                                Member since {{date("F d, Y", strtotime($memberSince))}}
                            </div>
                            <div class="nk-forum-topic-author-posts">
                                Posts: {{$userPosts}}
                            </div>
                            <div class="nk-forum-topic-author-likes{{$postID}} author_likes">
                                Likes: {{$userLikes}}
                            </div>
                            <div class="nk-forum-topic-author-social">
                                @if($userSocials)
                                    @foreach($userSocials as $social)
                                        @if ($social->Social == 'Discord')
                                            <a href="#" class="open_discord_modal" title="{{$social->SocialValue}}"  data-id="{{$social->SocialValue}}~{{$postAuthor}}" data-target="#discord_modal" data-toggle="modal"><i class="fab fa-discord"></i></a>
                                        @elseif ($social->Social == 'Skype')
                                            <a href="skype:{{$social->SocialValue}}?chat" title="{{$social->SocialValue}}"><i class="fab fa-skype"></i></a>
                                        @elseif ($social->Social == 'Steam')
                                            <a href="" title="{{$social->SocialValue}}"><i class="fab fa-steam"></i></a>
                                        @endif
                                    @endforeach
                                @endif
                                {{--<a href=""><i class="fab fa-discord"></i></a>
                                <a href=""><i class="fab fa-skype"></i></a>
                                <a href=""><i class="fab fa-steam"></i></i></a>--}}
                            </div>
                        </div>
                        <div class="nk-forum-topic-content">
                            <p>{!!$postBody!!}</p>

                            {{--<div class="nk-forum-topic-attachments">
                                <h4 class="h5">Attachments</h4>
                                <a href="#">godlike-free.zip</a>
                                <br>
                                (14.86 MiB) Downloaded 185 times
                            </div>--}}
                        </div>
                        <div class="nk-forum-topic-footer">
                            <span class="nk-forum-topic-date">{{date("M d, Y", strtotime($postDate))}}</span>
                            @if (!$Signature)
                            @else
                                <div class="text-center">
                                    <span class="nk-forum-topic-sig">{!!$Signature!!}</span>
                                </div>
                            @endif

                            @if ($isLoggedIn==true)
                                @if($isUserAuthor)
                                    <span class="nk-forum-action-btn">
                                        <a href="#forum-reply" class="nk-anchor"><span class="fa fa-reply"></span> Reply</a>
                                    </span>
                                    <span class="nk-forum-action-btn">
                                        <a href="#"><span class="fa fa-flag"></span> Spam</a>
                                    </span>
                                    <span class="nk-forum-action-btn heart like-button like" data-liked="{{$dataLiked}}" data-id="{{$postID}}" data-uid="{{$dataBatch}}">
                                        <span class="nk-action-heart">
                                            <span class="num{{$postID}}">{{$likesAmount}}</span>
                                            <span class="{{$iconClasses}}"></span>
                                            <span class="liked-icon ion-android-favorite"></span>
                                            <text class="like-text{{$postID}}">{{$likeAction}}</text>
                                        </span>
                                    </span>
                                @endif
                            @else
                                {{--<span class="nk-forum-action-btn">
                                    <span class="nk-action-heart">
                                        <span class="num">{{$postLikes}}</span>
                                        <span class="like-icon ion-android-favorite-outline"></span>
                                        <span class="liked-icon ion-android-favorite"></span>
                                    </span>
                                </span>--}}
                            @endif
                        </div>
                    </li>
                    {{--<div style="border-top: 1px solid #181818;display: block;"></div>--}}
                @endforeach
                </ul>
                @else
                    {{--<p>No Posts found. Please check back later.</p>--}}
                    <p>Topic not found. Please check back later.</p>
            @endif
            <!-- END: Forums List -->
            @if(count($data['forum']->data) > 0)
                <div id="forum-reply"></div>
                <div class="nk-gap-4"></div>
                @if ($isLoggedIn==true)
                    @if($closed==false)
                        <!-- START: Reply -->
                        <h3 class="h4">Reply</h3>
                        <p id="response"></p>
                        <form method="post">
                            <div class="nk-gap-1"></div>
                            <textarea class="nk-summernote" name="content" id="content"></textarea>
                            <div class="nk-gap-1"></div>
                            <button class="nk-btn nk-btn-lg link-effect-4" id="reply_submit">Reply</button>
                            <input type="hidden" name="topicid" id="topicid" value="{{$topicID}}"/>
                            <input type="hidden" name="postauthor" id="postauthor" value="{{$data['User']['DisplayName']}}"/>
                        </form>
                    @else
                        Sorry! Topic is closed and isn't up for more responses.
                    @endif
                @else
                    <h4 class="text-center">You must be logged in to reply.</h4>
                @endif
                <!-- END: Reply -->
            @endif
            <div class="online-staff text-center">
                <h6>Current online staff: </h6>
                @if($onlineStaff!==false)
                    @if ($cDisplayName)
                        <span>{!!$cDisplayName!!}</span>
                    @else
                        <span>{!!$onlineStaff!!}</span>
                    @endif
                @else
                    <span>There are currently no online staff.</span>
                @endif
            </div>
        </div>
    @php Separator(120); @endphp
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
        });
    </script>
@endsection