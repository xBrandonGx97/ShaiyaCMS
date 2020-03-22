<?php
//=====MULTI-PAGE SYSTEM ======//
		$p = (!empty($_GET['p'])) ? htmlentities($_GET['p']) : 'index';
		$array_pages = array(
		/*Starting array*/
			'index' => 'page/home.php',		//You can put you new pages
			'home' => 'page/home.php',
			'error' => 'page/error.php',
			'reset' => 'page/reset.php',
			'DropList' => 'page/droplist.php',
			'page2' => 'page/page2.php',
			'login' => 'page/login.php',
			'reset'	=>	'page/reset.php',
			'member' => 'page/member.php',
			'user'	=> 'page/membre_info.php',
			'vote' => 'page/vote.php',
			'voterank' => 'page/voterank.php',
			'staff' => 'page/staff.php',
			'registration' => 'page/registration.php',
			'infos' => 'page/infos.php',
			'download' => 'page/download.php',
			'connexion' => 'page/login.php',
			'boss_record' => 'page/bossrecord.php',
			'droplist'	=>	'page/droplist.php',
			'member_info' => 'page/membre_info.php',
			'faq' => 'page/faq.php',
			'pvpranking' => 'page/pvprank.php',
			'grbranking' => 'page/grbrank.php',
			'donate'	=>	'page/dons.php',
			'webmall'  => 'page/webmall.php',
			'contact' => 'page/contact.php',
			'rules' => 'page/rules.php',
			'features' => 'page/features.php',
			'story' => 'page/story.php',
			'races'=>'page/races.php',
			'classes'=>'page/classes.php',
			'started'=>'page/started.php',
			'requirements' => 'page/requirements.php'
			
		/*ending array*/
		);

		if(!array_key_exists($p, $array_pages)) $page = 'page/home.php';
		elseif(!is_file($array_pages[$p])) $page = 'page/error.php';
		else $page = $array_pages[$p];
		?>