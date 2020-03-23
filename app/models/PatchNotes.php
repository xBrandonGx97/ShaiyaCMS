<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;

class PatchNotes
{
    public function __construct()
    {
        $this->MSSQL = new \Classes\DB\MSSQL;
    }

    public function getPatchNotes()
    {
        $patchnotes = Eloquent::table(table('PATCHNOTES'))
             ->select()
             ->orderBy('Date', 'DESC')
             ->get();
        return $patchnotes;
    }
}
