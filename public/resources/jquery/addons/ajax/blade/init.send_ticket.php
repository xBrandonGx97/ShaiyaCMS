<?php
	define('AJAX_CALL',true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	use Jenssegers\Blade\Blade;
    $blade = new Blade(PUBROOT.'resources/jquery/addons/ajax/site/support',PUBROOT.'cache');
	if(file_exists(PUBROOT.'resources/jquery/addons/ajax/site/support/send_ticket.blade.php')){echo $blade->make('send_ticket',['data'=>''])->render(); }
	else{die('View doesn\'t exist');}