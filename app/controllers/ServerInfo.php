<?php

namespace App\Controllers;

    use Classes\Utils as Utils;

    class ServerInfo extends \Framework\Core\CoreController
    {
        public function __construct(Utils\User $user)
        {
            $this->user = $user;
        }

        public function about()
        {
            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $this->user,
            ];
            $this->view('pages/cms/serverinfo/about', $data);
        }

        public function bossrecords()
        {
            $bossRecords = $this->model('App\Models\boss_records');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'bossrecords' => $bossRecords,
                'User' => $this->user,
            ];
            $this->view('pages/cms/serverinfo/bossrecords', $data);
        }

        public function dropfinder()
        {
            $dropFinder = $this->model('App\Models\drop_finder');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'dropfinder' => $dropFinder,
                'User' => $this->user,
            ];
            $this->view('pages/cms/serverinfo/dropfinder', $data);
        }

        public function drops()
        {
            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $this->user,
            ];
            $this->view('pages/cms/serverinfo/drops', $data);
        }

        public function terms()
        {
            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $this->user,
            ];
            $this->view('pages/cms/serverinfo/terms', $data);
        }
    }
