<?php

namespace App\Controllers;

    use Classes\Utils as Utils;

    class Community extends \Framework\Core\CoreController
    {
        public function __construct(Utils\User $user)
        {
            $this->user = $user;
        }

        public function discord()
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

            $this->view('pages/cms/community/discord', $data);
        }

        public function downloads()
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
            $this->view('pages/cms/community/downloads', $data);
        }

        public function guildrankings()
        {
            $guildRankingsModel = $this->model('App\Models\guild_rankings');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'guildrankings' => $guildRankingsModel->getGuildRankings(),
                'User' => $this->user,
            ];
            $this->view('pages/cms/community/guildrankings', $data);
        }

        public function news()
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

            $newsModel = $this->model('App\Models\news');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'news' => $newsModel->getNews(),
                'User' => $this->user,
            ];
            $this->view('pages/cms/community/news', $data);
        }

        public function patchnotes()
        {
            $patchNotesModel = $this->model('App\Models\patch_notes');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'patchnotes' => $patchNotesModel->getPatchNotes(),
                'User' => $this->user,
            ];
            $this->view('pages/cms/community/patchnotes', $data);
        }

        public function pvprankings()
        {
            $rankings = $this->model('App\Models\rankings');

            $this->user->run();
            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'rankings',
                'zone' => 'CMS',
                'nav' => true
            ],
                'User' => $this->user,
                'Rankings' => $rankings
            ];
            $this->view('pages/cms/community/pvprankings', $data);
        }

        public function staffteam()
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
            $this->view('pages/cms/community/staffteam', $data);
        }
    }
