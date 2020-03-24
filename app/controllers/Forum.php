<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;

class Forum extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->select = new Utils\Select;
    }

    public static function forum()
    {
        $forum = self::model(Models\Forum::class);

        $this->user->fetchUser();

        $data = ['pageData' => [
            'index' => 'forum',
            'title' => 'Forum',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'user' => $this->user,
            'select' => $this->select
        ];
        self::view('forum/forum', $data);
    }

    public static function topics($id)
    {
        $forum = self::model(Models\Forum::class);

        $this->user->fetchUser();
        $data = ['pageData' => [
            'index' => 'topics',
            'title' => 'Topics',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'user' => $this->user,
            'select' => $this->select,
            'topicID' => $id,
        ];
        self::view('forum/topics', $data);
    }

    public static function posts($id)
    {
        $forum = self::model(Models\Forum::class);

        $this->user->fetchUser();

        $data = ['pageData' => [
            'index' => 'posts',
            'title' => 'Post',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'user' => $this->user,
            'select' => $this->select,
            'topicID' => $id,
        ];
        self::view('forum/view_post', $data);
    }

    public static function viewTopic($id)
    {
        $forum = self::model(Models\Forum::class);

        $this->user->fetchUser();

        $UserStatus = $this->user->get_Status($this->user->Status);
        $data = ['pageData' => [
            'index' => 'view_topic',
            'title' => 'Topic',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'user' => $this->user,
            'select' => $this->select,
            'topicID' => $id,
            'UserStatus' => $UserStatus
        ];
        self::view('forum/view_topic', $data);
    }
}
