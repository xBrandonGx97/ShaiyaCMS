<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as Eloquent;

class Community extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->select = new Utils\Select;
        $this->pagination = new Utils\Pagination;
    }

    public function discord()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];

        $this->view('pages/cms/community/discord', $data);
    }

    public function downloads()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/community/downloads', $data);
    }

    public function guildrankings()
    {
        $guildRankingsModel = $this->model(Models\GuildRankings::class);

        $this->user->fetchUser();

        $data = [
            'guildrankings' => $guildRankingsModel->getGuildRankings(),
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/community/guildrankings', $data);
    }

    public function news()
    {
        $newsModel = $this->model(Models\News::class);

        $this->user->fetchUser();

        $data = [
            'news' => $newsModel->getNews(),
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/community/news', $data);
    }

    public function patchnotes()
    {
        $patchNotesModel = $this->model(Models\PatchNotes::class);

        $this->user->fetchUser();

        $data = [
            'patchnotes' => $patchNotesModel->getPatchNotes(),
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/community/patchnotes', $data);
    }

    public function pvprankings()
    {
        $rankings = $this->model(Models\Rankings::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select,
            'Rankings' => $rankings
        ];
        $this->view('pages/cms/community/pvprankings', $data);
    }

    public function staffteam()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/community/staffteam', $data);
    }

    // POST

    // Patch Notes
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

            $query = Eloquent::table(table('patchNotes'))
                    ->select('RowID', 'Title', 'Detail', 'Date')
                    ->orderBy('Date', 'DESC')
                    ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $news = Eloquent::table(table('patchNotes'))
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

    // Rankings
    public function rankings()
    {
        $records_per_page = 15;
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
            $RankNum = ($page - 1) * $records_per_page;

            $query = Eloquent::table(table('SH_CHARDATA'))
                    ->select('CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->orderBy('K1', 'DESC')
                    ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $rankings = Eloquent::table(table('SH_CHARDATA'))
                    ->select('CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('CharName', 'ASC')
                    ->get();

                if ($rankings) {
                    $arr = [
                        'rankings' => $rankings,
                        'rankNum' => $RankNum,
                    ];
                    $this->view('fetch/rankings/rankings', $arr);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }
}
