<?php

namespace App\Controllers;

use Classes\Utils as Utils;

class Errors extends \Framework\Core\CoreController
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->select = new Utils\Select;
    }

    public function error301()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/301', $data);
    }

    public function error307()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/307', $data);
    }

    public function error400()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/400', $data);
    }

    public function error401()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/401', $data);
    }

    public function error403()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/403', $data);
    }

    public function error404()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/404', $data);
    }

    public function error405()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/405', $data);
    }

    public function error408()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/408', $data);
    }

    public function error500()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/500', $data);
    }

    public function error502()
    {
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'rankings',
            'zone' => 'CMS',
            'nav' => true
        ],
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('errors/502', $data);
    }
}
