<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;

class PatchNotes
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getPatchNotes()
    {
        $patchNotes = Eloquent::table(table('patchNotes'))
            ->select()
            ->orderBy('Date', 'DESC')
            ->get();
        return $patchNotes;
    }
}
