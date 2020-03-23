<?php

namespace App\Controllers;

use Classes\Utils\User;

class Forum_Controller extends \Framework\Core\CoreController
{
    public static function forum()
    {
        $forum = self::model('forum');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'forum',
            'title' => 'Forum',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'User' => $User,
        ];
        self::view('forum/forum', $data);
    }

    public static function topics($id)
    {
        $forum = self::model('forum');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'topics',
            'title' => 'Topics',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'User' => $User,
            'topicID' => $id,
        ];
        self::view('forum/topics', $data);
    }

    public static function posts($id)
    {
        $forum = self::model('forum');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'posts',
            'title' => 'Post',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'User' => $User,
            'topicID' => $id,
        ];
        self::view('forum/view_post', $data);
    }

    public static function view_topic($id)
    {
        $forum = self::model('forum');
        User::run();
        $User = User::_fetch_User();
        $UserStatus = User::get_Status($User['Status']);
        $data = ['pageData' => [
            'index' => 'view_topic',
            'title' => 'Topic',
            'zone' => 'CMS',
            'nav' => true
        ],
            'forum' => $forum,
            'User' => $User,
            'topicID' => $id,
            'UserStatus' => $UserStatus
        ];
        self::view('forum/view_topic', $data);
    }
}
