<?php

namespace App\Controllers;

use Classes\Utils as Utils;

class User extends \Framework\Core\CoreController
{
    /* Get Methods */

    public function donate()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/donate', $data);
    }

    public function donate_complete()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/donate_complete', $data);
    }

    public function donate_process()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/donate_process', $data);
    }

    public function friends()
    {
        $Friends = $this->model('App\Models\Friends');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'friends',
            'title' => 'Friends',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'Friends' => $Friends
        ];
        $this->view('pages/cms/user/friends', $data);
    }

    public function messages()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/messages', $data);
    }

    public function profile()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/profile', $data);
    }

    public function promotions()
    {
        $promotions = $this->model('App\Models\Promotions');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'promotions' => $promotions,
        ];
        $this->view('pages/cms/user/promotions', $data);
    }

    public function pvprewards()
    {
        $rewards = $this->model('App\Models\PvPRewards');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $Browser = new Utils\Browser;
        $Browser = $Browser->run();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'Browser' => $Browser,
            'rewards' => $rewards,
        ];
        $this->view('pages/cms/user/pvprewards', $data);
    }

    public function referers()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/referers', $data);
    }

    public function settings()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/settings', $data);
    }

    public function support()
    {
        $support = $this->model('App\Models\Support');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'support' => $support,
        ];
        $this->view('pages/cms/user/support', $data);
    }

    public function user($id)
    {
        $userModel = $this->model('App\Models\User');
        $Friends = $this->model('App\Models\Friends');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'userModel' => $userModel,
            'userID' => $id,
            'Friends' => $Friends
        ];
        $this->view('pages/cms/user/user', $data);
    }

    public function users()
    {
        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
        ];
        $this->view('pages/cms/user/users', $data);
    }

    public function vote()
    {
        $vote = $this->model('App\Models\Vote');

        $user = new Utils\User();
        $user->run();
        $user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'CMS',
            'nav' => true
        ],
            'User' => $user,
            'vote' => $vote
        ];
        $this->view('pages/cms/user/vote', $data);
    }

    /* Post Methods */
}
