<?php
    // DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'Velo001');
    define('DB_PASS', 'RQIZGv7HyOgN09A3');
    define('DB_NAME', 'ShaiyaCMS');
    
    // App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    // URL Root
    define('URLROOT', 'http://mvc_base.local');
	// Base Dir
    define( 'BASEDIR', '/' );
    // Framework Root
	define('FWROOT', $_SERVER['DOCUMENT_ROOT'].'/../framework/');
	// Public Root
	define('PUBROOT', $_SERVER['DOCUMENT_ROOT'].'/../public/');

    // Defaut language English
	$getLang	= (isset($_GET['lang']) ) ? $_SESSION['lang']	=	$_GET['lang'] : '';
	$headerLang	=	(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ) ? $parts=explode(';',$_SERVER['HTTP_ACCEPT_LANGUAGE']) : '';
	$lang = 'en';

	if($getLang){
		$lang=$getLang;
		define('LANG', $lang);
	}elseif(isset($_SESSION['lang'])){
		define('LANG', $_SESSION['lang']);
	}else{
		$langs=explode(',',$headerLang[0]);
		$lang=$langs[1];
		define('LANG', $lang);
	}
	function getLang($lang){
		switch($lang){
			case 'en': echo 'English'; break;
			case 'es': echo 'Spanish'; break;
			case 'pt': echo 'Portugese'; break;
			case 'fr': echo 'French'; break;
			case 'tr': echo 'Turkish'; break;
			case 'nl': echo 'Dutch'; break;
			case 'de': echo 'German'; break;
			case 'it': echo 'Italian'; break;
			case 'fil': echo 'Filipino';
		}
	}
	require_once APPROOT.'/libraries/HTMLPurifier/HTMLPurifier.auto.php';