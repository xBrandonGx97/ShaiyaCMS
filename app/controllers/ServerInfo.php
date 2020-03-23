<?php

namespace App\Controllers;

    use Classes\Utils as Utils;

    class ServerInfo extends \Framework\Core\CoreController
    {
        public function about()
        {
            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $user,
            ];
            $this->view('pages/cms/serverinfo/about', $data);
        }

        public function bossrecords()
        {
            $bossRecords = $this->model('App\Models\boss_records');

            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'bossrecords' => $bossRecords,
                'User' => $user,
            ];
            $this->view('pages/cms/serverinfo/bossrecords', $data);
        }

        public function dropfinder()
        {
            $dropFinder = $this->model('App\Models\drop_finder');

            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'dropfinder' => $dropFinder,
                'User' => $user,
            ];
            $this->view('pages/cms/serverinfo/dropfinder', $data);
        }

        public function drops()
        {
            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $user,
            ];
            $this->view('pages/cms/serverinfo/drops', $data);
        }

        public function terms()
        {
            $user = new Utils\User();
            $user->run();
            $user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $user,
            ];
            $this->view('pages/cms/serverinfo/terms', $data);
        }
    }
