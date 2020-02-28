<?php
#	echo 'Page: '.dirname(__FILE__).'<br>';
#	use Classes\Settings\Settings;
#	use Classes\Utils\Browser;
#	use Classes\Utils\User;
#	$Settings   =   new Settings();
#	$Settings->run();
	Classes\Settings\Settings::run();
	Classes\Utils\Data::_do('load_purifier');
	#Classes\Base\Langs::LoadLangs();
#	\Classes\Utils\Browser::run();
#	\Classes\Utils\User::run();
	#echo '<pre>';
#		var_dump(\Core\Route::$Routes);
	#echo '</pre>';