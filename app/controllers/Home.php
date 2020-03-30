<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as Eloquent;

class Home extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->select = new Utils\Select;
        $this->pagination = new Utils\Pagination;
    }

    public function index()
    {
        $newsModel = $this->model(Models\News::class);
        $serverInfo = $this->model(Models\ServerInfo::class);

        $this->user->fetchUser();

        $widget = new Utils\Widget();
        $widget = $widget->display();

        $data = [
            'user' => $this->user,
            'news' => $newsModel->getNews(),
            'serverinfo' => $serverInfo,
            'widget' => $widget,
            'select' => $this->select
        ];

        $this->view('pages/cms/home/index', $data);
    }

    // POST
    public function news()
    {
        $records_per_page = 5;
        $page = '';

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

            $query = Eloquent::table(table('news'))
                ->select('RowID', 'UserID', 'Title', 'Detail', 'Date')
                ->orderBy('Date', 'DESC')
                ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $news = Eloquent::table(table('news'))
                ->select('RowID', 'UserID', 'Title', 'Detail', 'Date')
                ->offset($start_from)
                ->limit($records_per_page)
                ->orderBy('Date', 'DESC')
                ->get();

                if ($news) {
                    $this->view('partials/cms/news', $news);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }

    public function serverTime()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);
            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $arr = [
                    'newtime' => '',
                    'currentTime' => date('F d,Y h:i:s A', time())
                ];
                if (isset($decoded['time'])) {
                    echo json_encode($arr);
                }
            }
        }
    }
}
