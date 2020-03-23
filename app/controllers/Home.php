<?php

    namespace App\Controllers;

    //	use Classes\Utils\Browser;
    use Classes\Utils\Auth;
    use Classes\Utils\User;
    use Classes\Utils\Widget;

    class Home extends \Framework\Core\CoreController
    {
        public static function index()
        {
            $newsModel = self::model('App\Models\news');
            $serverInfo = self::model('App\Models\server_info');

            User::run();
            //$User			=	User::_fetch_User(User::$UserID);
            $Auth = [
                'check' => Auth::check()
            ];

            $User = User::_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true,
            ],
                'Auth' => $Auth,
                'User' => $User,
                'news' => $newsModel->getNews(),
                'serverinfo' => $serverInfo,
                'widget' => Widget::display(),
            ];

            //	$User=new User();
            //	$User->_Props();
            self::view('pages/cms/home/index', $data);
            //Browser::run();
        }
    }
