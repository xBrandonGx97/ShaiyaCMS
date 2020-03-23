<?php

namespace App\Controllers;

use Classes\Utils\Browser;
use Classes\Utils\User;

class User extends \Framework\Core\CoreController
{
    /* Get Methods */

    public static function donate()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate', $data);
    }

    public static function donate_complete()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate_complete', $data);
    }

    public static function donate_process()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/donate_process', $data);
    }

    public static function friends()
    {
        $Friends = self::model('Friends');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'friends',
            'title' => 'Friends',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'Friends' => $Friends
        ];
        self::view('pages/cms/user/friends', $data);
    }

    public static function messages()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/messages', $data);
    }

    public static function profile()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/profile', $data);
    }

    public static function promotions()
    {
        $promotions = self::model('Promotions');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'promotions' => $promotions,
        ];
        self::view('pages/cms/user/promotions', $data);
    }

    public static function pvprewards()
    {
        $rewards = self::model('PvPRewards');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'Browser' => Browser::run(),
            'rewards' => $rewards,
        ];
        self::view('pages/cms/user/pvprewards', $data);
    }

    public static function referers()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/referers', $data);
    }

    public static function settings()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/settings', $data);
    }

    public static function support()
    {
        $support = self::model('Support');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'support' => $support,
        ];
        self::view('pages/cms/user/support', $data);
    }

    public static function user($id)
    {
        $userModel = self::model('User');
        $Friends = self::model('Friends');
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'userModel' => $userModel,
            'userID' => $id,
            'Friends' => $Friends
        ];
        self::view('pages/cms/user/user', $data);
    }

    public static function users()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
        ];
        self::view('pages/cms/user/users', $data);
    }

    public static function vote()
    {
        $vote = self::model('Vote');
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User,
            'vote' => $vote
        ];
        self::view('pages/cms/user/vote', $data);
    }

    /* Post Methods */
}
