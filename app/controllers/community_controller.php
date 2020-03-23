<?php

namespace App\Controllers;

    use Classes\Utils\User;
    use Classes\DB\MSSQL;
    use Classes\Utils\Session;

    class Community_Controller extends \Framework\Core\CoreController
    {
        public static function discord()
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

            self::view('pages/cms/community/discord', $data);
        }

        public static function downloads()
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
            self::view('pages/cms/community/downloads', $data);
        }

        public static function guildrankings()
        {
            $guildRankingsModel = self::model('guild_rankings');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'guildrankings' => $guildRankingsModel->getGuildRankings(),
                'User' => $User,
            ];
            self::view('pages/cms/community/guildrankings', $data);
        }

        public static function news()
        {
            //Session::put('color2', 'red');
            //Session::forget('color2');
            //Session::flush();
            //var_dump($_SESSION);
            /* $users = MSSQL::query()
                    ->select('UserID,Status')
                    ->from('WEB_PRESENCE')
                    ->where('UserID', ':user')
                    ->where('Status', ':status', 'AND')
                    ->where('PIN', ':pin', 'AND')
                    ->bind(':user', 'Brandon')
                    ->bind(':status', 16)
                    ->bind(':pin', 1222)
                    ->get();
            var_dump($users); */

            /* $users = MSSQL::query()
                ->table('NEWS')
                ->delete()
                ->where('Title', 'testTitle');
            var_dump($users); */

            // what about binds??

            //var_dump($users);
            /* $users = MSSQL::query()
                    ->insert('NEWS')
                    ->columns('Title', 'Detail', 'UserID')
                    ->values('test123', 'test145', 'B')
                    ->save();
            var_dump($users); */

            /* $arr = [
                'Title' => 'test123',
                'Detail' => 'test145',
                'UserID' => 'Bx'
            ];
            $users = MSSQL::query()->table('NEWS')->insert($arr);
            var_dump($users); */

            $newsModel = self::model('news');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'news' => $newsModel->getNews(),
                'User' => $User,
            ];
            self::view('pages/cms/community/news', $data);
        }

        public static function patchnotes()
        {
            $patchNotesModel = self::model('patch_notes');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'patchnotes' => $patchNotesModel->getPatchNotes(),
                'User' => $User,
            ];
            self::view('pages/cms/community/patchnotes', $data);
        }

        public static function pvprankings()
        {
            $rankings = self::model('rankings');
            User::run();
            $User = User::_fetch_User();
            $data = ['pageData' => [
                'index' => 'rankings',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $User,
                'Rankings' => $rankings
            ];
            self::view('pages/cms/community/pvprankings', $data);
        }

        public static function staffteam()
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
            self::view('pages/cms/community/staffteam', $data);
        }
    }
