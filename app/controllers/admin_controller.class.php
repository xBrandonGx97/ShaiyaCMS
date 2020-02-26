<?php
#	use Classes\Utils\Browser;
	use Classes\Utils\User;

	Class Admin_Controller extends CoreController {
		public static function index(){
			User::run();
			$User			=	User::_fetch_User();

			$data=['pageData'=>[
				'index' => 'index',
				'title' => 'Home',
				'zone' => 'AP',
				'nav' => true,
			],
				'User' => $User,
			];

			self::view('ap/index',$data);
		}
	}
?>