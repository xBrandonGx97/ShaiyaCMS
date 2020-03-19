<?php
use Classes\Utils\User;

class Errors_Controller extends CoreController
{
    public static function error301()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/301', $data);
    }

    public static function error307()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/307', $data);
    }

    public static function error400()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/400', $data);
    }

    public static function error401()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/401', $data);
    }

    public static function error403()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/403', $data);
    }

    public static function error404()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/404', $data);
    }

    public static function error405()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/405', $data);
    }

    public static function error408()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/408', $data);
    }

    public static function error500()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/500', $data);
    }

    public static function error502()
    {
        User::run();
        $User = User::_fetch_User();
        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $User
        ];
        self::view('errors/502', $data);
    }
}
