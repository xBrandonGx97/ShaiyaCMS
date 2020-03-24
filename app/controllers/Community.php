<?php

namespace App\Controllers;

    use Classes\Utils as Utils;

    class Community extends \Framework\Core\CoreController
    {
        public function __construct(Utils\User $user)
        {
            $this->user = $user;
            $this->select = new Utils\Select;
        }

        public function discord()
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

            $this->view('pages/cms/community/discord', $data);
        }

        public function downloads()
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
            $this->view('pages/cms/community/downloads', $data);
        }

        public function guildrankings()
        {
            $guildRankingsModel = $this->model('App\Models\GuildRankings');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'index',
                'zone' => 'CMS',
                'nav' => true
            ],
                'guildrankings' => $guildRankingsModel->getGuildRankings(),
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/community/guildrankings', $data);
        }

        public function news()
        {
            $newsModel = $this->model('App\Models\News');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'news',
                'zone' => 'CMS',
                'nav' => true
            ],
                'news' => $newsModel->getNews(),
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/community/news', $data);
        }

        public function patchnotes()
        {
            $patchNotesModel = $this->model('App\Models\PatchNotes');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'patchNotes',
                'zone' => 'CMS',
                'nav' => true
            ],
                'patchnotes' => $patchNotesModel->getPatchNotes(),
                'user' => $this->user,
                'select' => $this->select
            ];
            $this->view('pages/cms/community/patchnotes', $data);
        }

        public function pvprankings()
        {
            $rankings = $this->model('App\Models\Rankings');

            $this->user->_fetch_User();

            $data = ['pageData' => [
                'index' => 'rankings',
                'zone' => 'CMS',
                'nav' => true
            ],
                'user' => $this->user,
                'select' => $this->select,
                'Rankings' => $rankings
            ];
            $this->view('pages/cms/community/pvprankings', $data);
        }

        public function staffteam()
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
            $this->view('pages/cms/community/staffteam', $data);
        }
    }
