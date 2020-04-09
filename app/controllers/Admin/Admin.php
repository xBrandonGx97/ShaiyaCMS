<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Admin extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->logSys = new LogSys;
    }

    public function index()
    {
        $this->user->fetchUser();

        $dataClass = new Utils\Data;

        $panels = new Utils\Panels;

        $data = [
            'user' => $this->user,
            'panels' => $panels,
            'data' => $dataClass,
        ];

        $this->view('pages/ap/index', $data);
    }

    public function accessLogs()
    {
        $accessLogs = $this->model(Models\Admin\AccessLogs::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'accessLogs' => $accessLogs,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/admin/accessLogs', $data);
    }

    public function commandLogs()
    {
        $commandLogs = $this->model(Models\Admin\CommandLogs::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'commandLogs' => $commandLogs,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/admin/commandLogs', $data);
    }
}
