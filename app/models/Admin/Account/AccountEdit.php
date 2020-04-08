<?php

namespace App\Models\Admin\Account;

use Classes\Sys\LogSys;

class AccountEdit
{
    public function __construct()
    {
        $this->logSys = new LogSys;
    }
}
