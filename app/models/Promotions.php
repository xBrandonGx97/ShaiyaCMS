<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Classes\Utils as Utils;

class Promotions extends Model
{
    protected $table;
    public $timestamps = false;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->user->fetchUser();
        //$this->getPromotions();
    }

    public function getPromotions()
    {
        $this->table = table('SH_PROMOS');

        $Code = isset($_POST['code']) ? $this->data->do('escData', trim($_POST['code'])) : false;
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
            ->where('UserUID', $this->user->UserUID)
            ->limit(1)
            ->get();

        foreach ($user as $user) {
            $Points = $user->Point;
            $NewPoints = $user->Point + $Points;
        }

        $updatePoints = self::where('UserUID', $this->user->UserUID)
            ->update(['Point' => $NewPoints]);

        $NewNumOfUses = $NumOfUses + 1;

        $this->table = table('SH_PROMOS');

        $updatePromos = self::where('Code', $Code)
            ->update(['Used' => 1, 'NumOfUses' => $NewNumOfUses]);

        $this->table = table('SH_PROMOS_LOGS');

        $logsIns = self::insert([
            'Code' => $Code,
            'UserUID' => $this->user->UserUID,
            'UserID' => $this->user->UserID
        ]);
    }
}
