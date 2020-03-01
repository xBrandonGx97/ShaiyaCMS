<?php
	define('AJAX_CALL',true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	use Jenssegers\Blade\Blade;
	$blade = new Blade(PUBROOT.'resources/jquery/addons/ajax/site/forum/pagination',PUBROOT.'cache');
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	if ($contentType === "application/json") {
		//Receive the RAW post data.
  		$content = trim(file_get_contents("php://input"));
  		$decoded = json_decode($content, true);
  		
  		//If json_decode succeeded, the JSON is valid.
	  	if(is_array($decoded)) {
	  		if(isset($decoded['page'])) {
	  			$arr	=	[
					'view' => '',
					'id' => $decoded['id'],
				];
	  			if(file_exists(PUBROOT.'resources/jquery/addons/ajax/site/forum/pagination/pagination.blade.php')){
	  				$arr['view']  .= $blade->make('pagination',['data'=>''])->render();
	  			}
				else{
					die('View doesn\'t exist');
				}
	  			echo json_encode($arr);
			}
		}
	}