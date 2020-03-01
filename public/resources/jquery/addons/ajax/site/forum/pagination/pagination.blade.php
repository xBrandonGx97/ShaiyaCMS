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

	if(isset($_POST['page'])) {
		$page	=	$_POST['page'];
	} else {
		$page	=	1;
	}

	$prevPage   =   $page-1;
	$nextPage   =   $page+1;
	$start_from	=	($page	-	1)*$records_per_page;


	Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
    Display('move_topic_modal','<i class="fas fa-sync"></i>','0','2','Move Topic');
	$isLoggedIn     =   $User['LoginStatus'];

    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if ($contentType === "application/json") {
    	//Receive the RAW post data.
  		$content = trim(file_get_contents("php://input"));
  		$decoded = json_decode($content, true);

  		//If json_decode succeeded, the JSON is valid.
        if(is_array($decoded)) {
        	if(isset($decoded['page'])) {
        		list($topicID) = explode("~",$decoded["id"]);
        		$arr	=	[
					'view' => '',
                    'getPosts' => $Forum->getPosts($topicID),
                    'isTopicPinned' => $Forum->isTopicPinned($topicID,1),
                    'isTopicClosed' => $Forum->isTopicClosed($topicID,1),
                    'topicTitle' => $Forum->getTopicTitle($topicID),
                    'forumID' => $Forum->getForumID($topicID),
                    'isMod' => $isLoggedIn ? $Forum->isMod($User['UserUID']) : '',
                    'closed' => $Forum->closed,
				];
        		$sql=("
                        SELECT * FROM ShaiyaCMS.dbo.FORUM_POSTS ORDER BY PostID ASC OFFSET $start_from ROWS FETCH NEXT $records_per_page ROWS ONLY
                ");
                $stmt   =   MSSQL::connect()->prepare($sql);
                if ($stmt->execute()) {
                ?>
                <script src="/resources/themes/Godlike/js/godlike-init.js"></script>
                <div class="container">

                </div>
                <?php }
        		echo json_encode($arr);
			}
		}
	} ?>