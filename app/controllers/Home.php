<?php

    namespace App\Controllers;

    use Classes\Utils as Utils;

    class Home extends \Framework\Core\CoreController
    {
        public function index()
        {
            $newsModel = $this->model('App\Models\news');
            $serverInfo = $this->model('App\Models\server_info');

            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $widget = new Utils\Widget();
            $widget = $widget->display();

            $data = ['pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true,
            ],
                'User' => $user,
                'news' => $newsModel->getNews(),
                'serverinfo' => $serverInfo,
                'widget' => $widget,
            ];

            //	$User=new User();
            //	$User->_Props();
            $this->view('pages/cms/home/index', $data);
            //Browser::run();
        }
    }
