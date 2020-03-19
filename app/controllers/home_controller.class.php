<?php
//	use Classes\Utils\Browser;
    use Classes\Utils\User;

    class Home_Controller extends CoreController
    {
        public static function index()
        {
            $newsModel = self::model('news');
            $serverInfo = self::model('server_info');

            User::run();
            //$User			=	User::_fetch_User(User::$UserID);
            $User = User::_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true,
            ],
                'User' => $User,
                'news' => $newsModel->getNews(),
                'serverinfo' => $serverInfo
            ];

            //	$User=new User();
            //	$User->_Props();
            self::view('pages/cms/home/index', $data);
            //Browser::run();
        }
    }
