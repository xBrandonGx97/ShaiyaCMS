<?php

    namespace App\Controllers;

    use Illuminate\Database\Capsule\Manager as Eloquent;
    use Classes\Utils as Utils;

    class Home extends \Framework\Core\CoreController
    {
        public $recordsPerPage;
        public $startFrom;
        public $prevPage;
        public $nextPage;

        public function __construct(Utils\User $user)
        {
            $this->user = $user;
            $this->select = new Utils\Select;
        }

        public function index()
        {
            $newsModel = $this->model('App\Models\News');
            $serverInfo = $this->model('App\Models\ServerInfo');

            // remove run and make it run on construct
            $this->user->_fetch_User();

            $widget = new Utils\Widget();
            $widget = $widget->display();

            $data = ['pageData' => [
                'index' => 'home',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true,
            ],
                'user' => $this->user,
                'news' => $newsModel->getNews(),
                'serverinfo' => $serverInfo,
                'widget' => $widget,
                'select' => $this->select
            ];

            //	$User=new User();
            //	$User->_Props();
            $this->view('pages/cms/home/index', $data);
            //Browser::run();
        }

        // POST
        public function news()
        {
            $this->records_per_page = 5;
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
                $this->prevPage = $page - 1;
                $this->nextPage = $page + 1;

                $this->start_from = ($page - 1) * $this->records_per_page;
                $RankNum = ($page - 1) * $this->records_per_page;

                try {
                    $news = Eloquent::table(table('NEWS'))
                    ->select('RowID', 'UserID', 'Title', 'Detail', 'Date')
                    ->offset($this->start_from)
                    ->limit($this->records_per_page)
                    ->orderBy('Date', 'DESC')
                    ->get();

                    if ($news) {
                        $this->view('partials/cms/news', $news);
                    }
                } catch (\Exception $e) {
                    // query failed
                }
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
