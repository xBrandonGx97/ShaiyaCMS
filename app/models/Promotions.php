<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Classes\Utils as Utils;

class Promotions extends Model
{
    protected $table;
    public $timestamps = false;

    /* public $Code;
    public $NumOfUses;
    public $MaxUses;
    public $Points;
    public $fet; */

    public function __construct()
    {
        $this->MSSQL = new \Classes\DB\MSSQL;
        $this->Data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->User = new Utils\User($this->session);
        $this->User = $this->User->_fetch_User();
        //$this->getPromotions();
    }

    public function getPromotions()
    {
        $this->table = table('SH_PROMOS');

        $Code = isset($_POST['code']) ? $this->Data->_do('escData', trim($_POST['code'])) : false;
        $this->Code = $Code;

        $promotions = self::select()
            ->where('Code', $Code)
            ->limit(1)
            ->get();
        return $promotions;
    }

    public function validations($NumOfUses, $Code)
    {
        $this->table = table('SH_USERDATA');

        $user = self::select()
            ->where('UserUID', $this->User['UserUID'])
            ->limit(1)
            ->get();

        foreach ($user as $user) {
            $Points = $user->Point;
            $NewPoints = $user->Point + $Points;
        }

        $updatePoints = self::where('UserUID', $this->User['UserUID'])
            ->update(['Point' => $NewPoints]);

        $NewNumOfUses = $NumOfUses + 1;

        $this->table = table('SH_PROMOS');

        $updatePromos = self::where('Code', $Code)
            ->update(['Used' => 1, 'NumOfUses' => $NewNumOfUses]);

        $this->table = table('SH_PROMOS_LOGS');

        $logsIns = self::insert([
            'Code' => $Code,
            'UserUID' => $this->User['UserUID'],
            'UserID' => $this->User['UserID']
        ]);
    }
}
