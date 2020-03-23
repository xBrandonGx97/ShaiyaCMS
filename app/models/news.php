<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table;

    public function __construct()
    {
        //$this->table = table('NEWS');

        $this->MSSQL = new \Classes\DB\MSSQL;
    }

    public function getNews()
    {
        //$test = news::first();
        //var_dump($test);

        $news = self::select('UserID', 'Title', 'Detail')
            ->orderBy('Date', 'DESC')
            ->get();
        return $news;

        /* $news = self::all();
        return $news; */

        /* $news = Eloquent::table(table('NEWS'))
             ->select()
             ->orderBy('Date', 'DESC')
             ->get();
        return $news; */
    }
}
