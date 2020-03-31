<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;

class Admin extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
    }

    public function index()
    {
        $this->user->fetchUser();

        $dataClass = new Utils\Data;

        $panelInstance = new Utils\Panels;

        $panels = [
            'newlyRegistered' => $panelInstance->getNewlyRegistered(),
            'totalAccounts' => $panelInstance->getTotalAccounts(),
            'onlineLast24' => $panelInstance->getOnlineLast1(),
            'onlineCurrent' => $panelInstance->getOnlineCurrent(),
            'actionLogs' => $panelInstance->actionLogs(),
            'gmLogs' => $panelInstance->gmLogs(),
            'newUsers' => $panelInstance->newUsers()
        ];

        $data = [
            'user' => $this->user,
            'panels' => $panels,
            'data' => $dataClass,
        ];

        $this->view('pages/ap/index', $data);
    }

    public function accessLogs()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/admin/accessLogs', $data);
    }

    public function commandLogs()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/admin/commandLogs', $data);
    }
}
