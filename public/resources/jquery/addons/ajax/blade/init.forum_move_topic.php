<?php
	define('AJAX_CALL',true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	use Jenssegers\Blade\Blade;
    $blade = new Blade(PUBROOT.'resources/jquery/addons/ajax/site/forum/topic',PUBROOT.'cache');
	if(file_exists(PUBROOT.'resources/jquery/addons/ajax/site/forum/topic/move_topic_view.blade.php')){echo $blade->make('move_topic_view',['data'=>''])->render(); }
	else{die('View doesn\'t exist');}