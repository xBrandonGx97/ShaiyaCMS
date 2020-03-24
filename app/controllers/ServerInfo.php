<?php

namespace App\Controllers;

    use Classes\Utils as Utils;

    class ServerInfo extends \Framework\Core\CoreController
    {
        public function __construct(Utils\User $user)
        {
            $this->user = $user;
            $this->select = new Utils\Select;
        }

        public function about()
        {
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/serverinfo/about', $data);
        }

        public function bossrecords()
        {
            $bossRecords = $this->model('App\Models\BossRecords');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'bossrecords' => $bossRecords,
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/serverinfo/bossrecords', $data);
        }

        public function dropfinder()
        {
            $dropFinder = $this->model('App\Models\DropFinder');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'dropfinder' => $dropFinder,
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/serverinfo/dropfinder', $data);
        }

        public function drops()
        {
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/serverinfo/drops', $data);
        }

        public function terms()
        {
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/serverinfo/terms', $data);
        }
    }
