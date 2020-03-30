<?php

namespace App\Controllers;

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
}
