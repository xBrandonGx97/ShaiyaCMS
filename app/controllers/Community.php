<?php

namespace App\Controllers;

use App\Models as Models;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as Eloquent;

class Community extends \Framework\Core\CoreController
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->select = new Utils\Select;
        $this->pagination = new Utils\Pagination;
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
        $guildRankingsModel = $this->model(Models\GuildRankings::class);

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
        $newsModel = $this->model(Models\News::class);

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
        $patchNotesModel = $this->model(Models\PatchNotes::class);

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
        $rankings = $this->model(Models\Rankings::class);

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

    // POST
    public function getPatchNotes()
    {
        $records_per_page = 1;
        $page = '';
        $output = '';

        $content = trim(file_get_contents('php://input'));

        $decoded = json_decode($content, true);

        if (is_array($decoded)) {
            if (isset($decoded['page'])) {
                $page = $decoded['page'];
            } else {
                $page = 1;
            }
            $prevPage = $page - 1;
            $nextPage = $page + 1;

            $start_from = ($page - 1) * $records_per_page;

            $query = Eloquent::table(table('PATCHNOTES'))
                    ->select('RowID', 'Title', 'Detail', 'Date')
                    ->orderBy('Date', 'DESC')
                    ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $news = Eloquent::table(table('PATCHNOTES'))
                    ->select('RowID', 'Title', 'Detail', 'Date')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('Date', 'DESC')
                    ->get();

                if ($news) {
                    $this->view('fetch/patch_notes/patchNotes', $news);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }
}
