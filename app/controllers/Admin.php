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

        $panelInstance = new Utils\Panels;

        $panels = [
            'newlyRegistered' => $panelInstance->getNewlyRegistered(),
            'totalAccounts' => $panelInstance->getTotalAccounts(),
            'onlineLast24' => $panelInstance->getOnlineLast1(),
            'onlineCurrent' => $panelInstance->getOnlineCurrent(),
        ];

        $data = [
            'user' => $this->user,
            'panels' => $panels
        ];

        $this->view('pages/ap/index', $data);
    }
}
