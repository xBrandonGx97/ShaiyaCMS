<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class MobList
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
    }
}
