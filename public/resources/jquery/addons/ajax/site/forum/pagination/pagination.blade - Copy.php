<?php
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	use \Classes\Utils\User;
	use \Classes\Utils\Pagination;

	Session::init('Default');
	require_once($_SERVER['DOCUMENT_ROOT'].'/../app/models/forum.php');
    $Forum	=	new Forum();
    list($topicID) = explode("~",$_POST["id"]);
    User::run();
    $User	=	User::_fetch_User();

	$records_per_page	=	10;
	$page	=	'';
	$output = 	'';

	if(isset($_POST['page'])) {
		$page	=	$_POST['page'];
	} else {
		$page	=	1;
	}

	$prevPage   =   $page-1;
	$nextPage   =   $page+1;

	$start_from	=	($page	-	1)*$records_per_page;

	//var_dump($_POST);
    Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
    Display('move_topic_modal','<i class="fas fa-sync"></i>','0','2','Move Topic');
	$isLoggedIn     =   $User['LoginStatus'];

	$Forum->getPosts($topicID);
	$Forum->isTopicPinned($topicID,1);
    $Forum->isTopicClosed($topicID,1);

	$topicTitle =   $Forum->getTopicTitle($topicID);
    $forumID    =   $Forum->getForumID($topicID);

	$isMod          =   $isLoggedIn ? $Forum->isMod($User['UserUID']) : '';

	$closed         =   $Forum->closed;

	#echo 'start from: '.$start_from;

	$sql=("
			SELECT * FROM ShaiyaCMS.dbo.FORUM_POSTS ORDER BY PostID ASC OFFSET $start_from ROWS FETCH NEXT $records_per_page ROWS ONLY
	");
  	$stmt   =   MSSQL::connect()->prepare($sql);
    if ($stmt->execute()) {
    	#echo 'yes';
	?>
    <script src="/resources/themes/Godlike/js/godlike-init.js"></script>
    <div class="container">
        <div class="row">
            @if($isLoggedIn)
                <div class="col-md-3 order-md-2 text-right">
                    <a href="#forum-reply" class="nk-btn nk-btn-lg link-effect-4 nk-anchor">Reply</a>
                </div>
            @endif
            <div class="table-responsive" id="pagination_data" data-id="1">

            </div>
            <div class="col-md-9 ">
                {{Pagination::showPages($records_per_page,$prevPage,$nextPage,$page)}}
            </div>
        </div>
        @if($isMod)
            <div class="row">
                <div class="col-md-9"></div>
                <div class="mod-actions col-md-3 order-md-2 text-right">
                    <div class="dropdown">
                        <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                        <div class="dropdown-content text-center">
                            <a href="#" class="link-effect-4 ready pin_topic" data-pinned="{{$Forum->pinned ? 'true' : 'false'}}" data-id="{{$topicID}}"><span class="link-effect-inner"><span class="link-effect-l"><span class="pin-text1">{{$Forum->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span><span class="link-effect-r"><span class="pin-text2">{{$Forum->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span><span class="link-effect-shade"><span class="pin-text3">{{$Forum->pinned ? 'Unpin Topic' : 'Pin Topic'}}</span></span></span></a>
                            <a href="#" class="link-effect-4 ready open_move_topic_modal" data-id="{{$topicTitle}}~{{$topicID}}~{{$forumID}}" data-target="#move_topic_modal" data-toggle="modal"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready close_topic" data-closed="{{$Forum->closed ? 'true' : 'false'}}" data-id="{{$topicID}}"><span class="link-effect-inner"><span class="link-effect-l"><span class="close-text">{{$Forum->closed ? 'Open Topic' : 'Close Topic'}}</span></span><span class="link-effect-r"><span class="close-text">{{$Forum->closed ? 'Open Topic' : 'Close Topic'}}</span></span><span class="link-effect-shade"><span class="close-text">{{$Forum->closed ? 'Open Topic' : 'Close Topic'}}</span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(count($Forum->data) > 0)
            <ul class="nk-forum nk-forum-topic">
                @while($data=$stmt->fetch())
                    @php
                        $postID 	=   $data['PostID'];
                        $postAuthor =   $data['PostAuthor'];
                        $postDate   =   $data['PostDate'];

                        $memberSince    =   $Forum->memberSince($postAuthor);
                        $loginStatus    =   $Forum->loginStatus($postAuthor);
                        $userRoles  	=   $Forum->getUserRoles($postAuthor);
                        $userTitle 	 	=   $Forum->getUserTitle($postAuthor);
                        $userSocials    =   $Forum->getUserSocials($postAuthor);
                        $postLikes  	=   $Forum->getPostLikes($postID);;
                        $userLikes  	=   $Forum->getUserLikes($postAuthor);
                        $userPosts   	=   $Forum->getUserPosts($postAuthor);
                        $Signature  	=   $Forum->getUserSignature($postAuthor);
                        $displayName    =   $Forum->getDisplayName($postAuthor);
                        $checkPost  	=   $Forum->didUserLikePost($User['UserUID'],$postID);

                        $checkDisplayName   =   $displayName ? '<a href="">'.$displayName.'</a>' : '<a href="">'.$postAuthor.'</a>';
                        $checkLoginStatus   =   $loginStatus==1 ? '<i class="fa fa-circle text-success" aria-hidden="true" title="Online"></i>' : '<i class="fa fa-circle text-danger" aria-hidden="true" title="Offline"></i>';

                        $postUserUID    =   $Forum->displayNameToUserUID($postAuthor);
                        $isUserAuthor   =   $User['UserUID']!==$postUserUID || $postUserUID !== $User['UserUID'];

                        // Data liked
                        $dataLiked      =   $checkPost ? 'true' : 'false';
                        $likesAmount    =   $postLikes;
                        $likeAction     =   $checkPost ? 'Unlike' : 'Like';

                        // Icon Classes
                        $iconClasses    =   $checkPost ? 'like-icon ion-android-favorite' : 'like-icon ion-android-favorite-outline';

                        // ID & author batch
                        $userID         =   $User['UserUID'];
                        $dataBatch      =   implode("~",[$postID, $userID, $postUserUID, $postAuthor]);

                        $fetchUserRoles =   $Forum->fetchUserRoles($postAuthor);
                    @endphp
                    <li>
                        <div class="nk-forum-topic-author" style="width:150px !important;">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                             <div class="nk-forum-topic-author-name" title="{{$postAuthor}}">
                                {!! $checkDisplayName !!}
                                 {!! $checkLoginStatus !!}
                             </div>
                            @if($fetchUserRoles)
                                @foreach ($userRoles as $role)
                                    @if($role->DisplayName == $postAuthor)
                                        <div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/{{$role->RoleName}}.png" style="width:125px"></div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="nk-forum-topic-author-role"><span>{{$userTitle}}</span></div>
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
                            </div>
                        </div>
                        <div class="nk-forum-topic-content">
                            <p class="body-text bdy{{$postID}}">{{$data['PostBody']}}</p>
                            <div class="hidden-textbox txt{{$postID}}">

                            </div>
                        </div>
                        <div class="nk-forum-topic-footer">
                            <span class="nk-forum-topic-date">{{date("M d, Y", strtotime($postDate))}}</span>
                            <div class="text-center">
                                @if (!$Signature)
                                @else
                                    <span class="nk-forum-topic-sig">{!!$Signature!!}</span>
                                @endif
                            </div>
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
                                @else
                                    <span class="nk-forum-action-btn edit-btn" data-id="{{$postID}}">
                                        <a href="#"><span class="fa fa-edit edit_icon" data-clicked="true"></span> <span class="edit-txt">Edit</span></a>
                                    </span>
                                    <span class="nk-forum-action-btn action_save" style="display:none;" data-id="{{$postID}}">
                                        <a href="#"><span class="fa fa-save" data-clicked="true"></span> <span class="">Save</span></a>
                                    </span>
                                @endif
                            @endif
                        </div>
                    </li>
                @endwhile
            </ul>
        @else
            <p>Topic not found. Please check back later.</p>
        @endif
        <!-- END: Forums List -->
        @if(count($Forum->data) > 0)
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
                        <input type="hidden" name="postauthor" id="postauthor" value="{{$User['DisplayName']}}"/>
                    </form>
                @else
                    Sorry! Topic is closed and isn't up for more responses.
                @endif
            @else
                <h4 class="text-center">You must be logged in to reply.</h4>
            @endif
            <!-- END: Reply -->
            @endif
        <?php
            Pagination::showPages($records_per_page,$prevPage,$nextPage,$page);
        }
        echo $output;
        ?>
<script>
	$(".pagination_link").click(function () {
		const page = $(this).attr("id");
		load_data(page);
	});
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
	})
</script>