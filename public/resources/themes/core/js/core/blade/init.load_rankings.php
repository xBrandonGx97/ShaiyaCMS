<?php
	define('AJAX_CALL',true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	use Jenssegers\Blade\Blade;
    $blade = new Blade(PUBROOT.'resources/themes/core/js/fetch/PvPRankings',PUBROOT.'cache');
	if(file_exists(PUBROOT.'resources/themes/core/js/fetch/PvPRankings/loadRankings.blade.php')){echo $blade->make('loadRankings',['data'=>''])->render(); }
	else{die('View doesn\'t exist');}