<?php
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	use \Classes\Utils\User;
	use \Classes\Utils\Pagination;

	Session::init('Default');
	require_once($_SERVER['DOCUMENT_ROOT'].'/../app/models/forum.php');
    $Forum	=	new Forum();
    User::run();
    $User	=	User::_fetch_User();

	$records_per_page	=	10;
	$page	=	'';
	$output = 	'';

	$content = trim(file_get_contents("php://input"));

  	$decoded = json_decode($content, true);
  	if(is_array($decoded)) {
  		list($topicID) = explode("~",$decoded['id']);
  		if(isset($decoded['page'])) {
  			$page	=	$decoded['page'];
        } else {
  			$page   =   1;
        }

	$prevPage   =   $page-1;
	$nextPage   =   $page+1;

	$start_from	=	($page	-	1)*$records_per_page;
	$postNum = ($page - 1) * $records_per_page;

	//var_dump($_POST);
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
			SELECT * FROM ShaiyaCMS.dbo.FORUM_POSTS
			WHERE TopicID=:topicid
			ORDER BY PostID ASC OFFSET $start_from ROWS FETCH NEXT $records_per_page ROWS ONLY
	");
  	$stmt   =   MSSQL::connect()->prepare($sql);
  	$stmt->bindValue(':topicid', $topicID, PDO::PARAM_INT);
    if ($stmt->execute()) {
    	$res    =   $stmt->fetchAll();
    	$rowCount   =   count($res);
    	#echo 'yes';
	?>
    
    <div class="container">
        <div class="row">
            <?php if($isLoggedIn): ?>
                <div class="col-md-3 order-md-2 text-right">
                    <a href="#forum-reply" class="nk-btn nk-btn-lg link-effect-4 nk-anchor">Reply</a>
                </div>
                <?php if($Forum->getTopicAuthor($topicID) === $User['DisplayName']): ?>
                    <?php 
                        $bumpedTime =   $Forum->checkBumpedTime($topicID);
                        $dateToCheck = new \Datetime($bumpedTime);
                        $twelveHoursAgo = (new \Datetime("now"))->modify("-12 hour");
                        if($dateToCheck < $twelveHoursAgo) {
                            echo 'can bump topic';
                        }
                     ?>
                <?php endif; ?>
            <?php endif; ?>
            
            <div class="col-md-9 ">
                <?php echo e(Pagination::showPages($records_per_page,$prevPage,$nextPage,$page,$topicID)); ?>

            </div>
        </div>
        <?php if($isMod): ?>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="mod-actions col-md-3 order-md-2 text-right">
                    <div class="dropdown">
                        <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                        <div class="dropdown-content text-center">
                            <a href="#" class="link-effect-4 ready pin_topic" data-pinned="<?php echo e($Forum->pinned ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="pin-text1"><?php echo e($Forum->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-r"><span class="pin-text2"><?php echo e($Forum->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span><span class="link-effect-shade"><span class="pin-text3"><?php echo e($Forum->pinned ? 'Unpin Topic' : 'Pin Topic'); ?></span></span></span></a>
                            <a href="#" class="link-effect-4 ready open_move_topic_modal" data-id="<?php echo e($topicTitle); ?>~<?php echo e($topicID); ?>~<?php echo e($forumID); ?>" data-target="#move_topic_modal" data-toggle="modal"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                            <a href="#" class="link-effect-4 ready close_topic" data-closed="<?php echo e($Forum->closed ? 'true' : 'false'); ?>" data-id="<?php echo e($topicID); ?>"><span class="link-effect-inner"><span class="link-effect-l"><span class="close-text1"><?php echo e($Forum->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-r"><span class="close-text2"><?php echo e($Forum->closed ? 'Open Topic' : 'Close Topic'); ?></span></span><span class="link-effect-shade"><span class="close-text3"><?php echo e($Forum->closed ? 'Open Topic' : 'Close Topic'); ?></span></span></span></a>
                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
            <?php if(count($Forum->data) > 0): ?>
            <ul class="nk-forum nk-forum-topic">
                <?php 
                    //$postNum    =   1;
                    //$postNum    +=   10;
                 ?>
                <?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $postNum++;
                        //$postNum+=1;
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
                     ?>
                    <li class="post<?php echo e($postID); ?>">
                        <div class="nk-forum-topic-author" style="width:150px !important;" id="post<?php echo e($postID); ?>">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                             <div class="nk-forum-topic-author-name" title="<?php echo e($postAuthor); ?>">
                                <?php echo $checkDisplayName; ?>

                                 <?php echo $checkLoginStatus; ?>

                             </div>
                            <?php if($fetchUserRoles): ?>
                                <?php $__currentLoopData = $userRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($role->DisplayName == $postAuthor): ?>
                                        <div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/<?php echo e($role->RoleName); ?>.png" style="width:125px"></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="nk-forum-topic-author-role"><span><?php echo e($userTitle); ?></span></div>
                            <div class="nk-forum-topic-author-since">
                                Member since <?php echo e(date("F d, Y", strtotime($memberSince))); ?>

                            </div>
                            <div class="nk-forum-topic-author-posts">
                                 Posts: <?php echo e($userPosts); ?>

                            </div>
                            <div class="nk-forum-topic-author-likes<?php echo e($postID); ?> author_likes">
                                Likes: <?php echo e($userLikes); ?>

                            </div>
                            <div class="nk-forum-topic-author-social">
                                <?php if($userSocials): ?>
                                    <?php $__currentLoopData = $Forum->isSocialsPrivate($postAuthor); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Privacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($Privacy->DisplaySocials==='Public'): ?>
                                            <?php $__currentLoopData = $userSocials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($social->Discord): ?>
                                                    <a href="#" class="open_discord_modal" title="<?php echo e($social->Discord); ?>"  data-id="<?php echo e($social->Discord); ?>~<?php echo e($postAuthor); ?>" data-target="#discord_modal" data-toggle="modal"><i class="fab fa-discord" id="<?php echo e($social->Discord); ?>"></i></a>
                                                <?php endif; ?>
                                                <?php if($social->Skype): ?>
                                                    <a href="skype:<?php echo e($social->Skype); ?>?chat" title="<?php echo e($social->Skype); ?>"><i class="fab fa-skype"></i></a>
                                                <?php endif; ?>
                                                <?php if($social->Steam): ?>
                                                    <a href="#" title="<?php echo e($social->Steam); ?>"><i class="fab fa-steam"></i></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="nk-forum-topic-content">
                            <span class="nk-forum-action-btn postNum float-right" data-id="<?php echo e($postID); ?>">
                                <a href="#post<?php echo e($postID); ?>">#<?php echo e($postNum); ?></a>
                            </span>
                            <p class="body-text bdy<?php echo e($postID); ?>"><?php echo $data['PostBody']; ?></p>
                            <div class="hidden-textbox txt<?php echo e($postID); ?>">

                            </div>
                        </div>
                        <div class="nk-forum-topic-footer">
                            <span class="nk-forum-topic-date"><?php echo e(date("M d, Y", strtotime($postDate))); ?></span>
                            <div class="text-center">
                                <?php if(!$Signature): ?>
                                <?php else: ?>
                                    <span class="nk-forum-topic-sig"><?php echo $Signature; ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if($isLoggedIn==true): ?>
                                
                                <?php if($isUserAuthor): ?>
                                    <span class="nk-forum-action-btn">
                                        <a href="#forum-reply2" class="nk-anchor"><span class="fa fa-reply"></span> Reply</a>
                                    </span>
                                    <span class="nk-forum-action-btn">
                                        <a href="#"><span class="fa fa-flag"></span> Report</a>
                                    </span>
                                    <span class="nk-forum-action-btn heart like-button like" data-liked="<?php echo e($checkPost ? 'true' : 'false'); ?>" data-id="<?php echo e($postID); ?>" data-uid="<?php echo e($dataBatch); ?>">
                                        <span class="nk-action-heart">
                                            <span class="num<?php echo e($postID); ?>"><?php echo e($likesAmount); ?></span>
                                            <span class="<?php echo e($iconClasses); ?>"></span>
                                            <span class="liked-icon ion-android-favorite"></span>
                                            <text class="like-text<?php echo e($postID); ?>"><?php echo e($likeAction); ?></text>
                                        </span>
                                    </span>
                                <?php else: ?>
                                    <span class="nk-forum-action-btn edit-btn" data-id="<?php echo e($postID); ?>">
                                        <a href="#"><span class="fa fa-edit edit_icon" data-clicked="true"></span> <span class="edit-txt">Edit</span></a>
                                    </span>
                                    <span class="nk-forum-action-btn action_save" style="display:none;" data-id="<?php echo e($postID); ?>">
                                        <a href="#"><span class="fa fa-save" data-clicked="true"></span> <span class="">Save</span></a>
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php 

                 ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php else: ?>
                <p>Topic not found. Please check back later.</p>
            <?php endif; ?>
            <?php 
                Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
             ?>
        <!-- END: Forums List -->
        <?php if(count($Forum->data) > 0): ?>
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
                        <input type="hidden" name="postauthor" id="postauthor" value="<?php echo e($User['DisplayName']); ?>"/>
                    </form>
                <?php else: ?>
                    Sorry! Topic is closed and isn't up for more responses.
                <?php endif; ?>
            <?php else: ?>
                <h4 class="text-center">You must be logged in to reply.</h4>
            <?php endif; ?>
            <!-- END: Reply -->
            <?php endif; ?>
        <?php
            Pagination::showPages($records_per_page,$prevPage,$nextPage,$page,$topicID);
        }
        echo $output;
        ?>

    </div>
        <?php
	}