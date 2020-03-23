<?php

namespace App\Controllers;

    use Classes\Utils\User;

    class ServerInfo_Controller extends \Framework\Core\CoreController
    {
        public static function about()
        {
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $User,
            ];
            self::view('pages/cms/serverinfo/about', $data);
        }

        public static function bossrecords()
        {
            $bossRecords = self::model('boss_records');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'bossrecords' => $bossRecords,
                'User' => $User,
            ];
            self::view('pages/cms/serverinfo/bossrecords', $data);
        }

        public static function dropfinder()
        {
            $dropFinder = self::model('drop_finder');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'dropfinder' => $dropFinder,
                'User' => $User,
            ];
            self::view('pages/cms/serverinfo/dropfinder', $data);
        }

        public static function drops()
        {
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $User,
            ];
            self::view('pages/cms/serverinfo/drops', $data);
        }

        public static function terms()
        {
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $User,
            ];
            self::view('pages/cms/serverinfo/terms', $data);
        }
    }
