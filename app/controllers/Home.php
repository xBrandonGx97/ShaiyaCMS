<?php

    namespace App\Controllers;

    use Classes\Utils as Utils;

    class Home extends \Framework\Core\CoreController
    {
        public function __construct(Utils\User $user)
        {
            $this->user = $user;
        }

        public function index()
        {
            $newsModel = $this->model('App\Models\News');
            $serverInfo = $this->model('App\Models\ServerInfo');

            $this->user->run();
            $this->user->_fetch_User();

            $widget = new Utils\Widget();
            $widget = $widget->display();

            $data = ['pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true,
            ],
                'User' => $this->user,
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
