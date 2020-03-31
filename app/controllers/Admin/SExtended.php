<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class SExtended extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
            $this->logSys = new LogSys;
    }

    public function sendNotice()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/SExtended/sendNotice', $data);
    }

    public function sendPlayerNotice()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/SExtended/sendPlayerNotice', $data);
    }
}
