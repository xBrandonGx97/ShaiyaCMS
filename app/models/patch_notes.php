<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;

class patch_notes
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
