<?php
use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table = 'NEWS';

    public function __construct()
    {
        $this->MSSQL = new Classes\DB\MSSQL;
    }

    public function getNews()
    {
        //$test = news::first();
        //var_dump($test);
        $news = Eloquent::table(table('NEWS'))
             ->select()
             ->orderBy('Date', 'DESC')
             ->get();
        return $news;
    }
}
